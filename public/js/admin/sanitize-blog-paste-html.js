/**
 * Normalize HTML pasted from Microsoft Word / Google Docs for the blog editor.
 * Pure function: HTML string in → HTML string out.
 *
 * Pipeline:
 * 1. preCleanRawHtml
 * 2. unwrapFontTags
 * 3. unwrapDocsGuidWrappers
 * 4. promoteWordHeadings   (<p mso…> → <hN>)
 * 5. normalizeHeadingOutline
 * 6. cleanAllElements
 */
(function (global) {
  'use strict';

  var BLOCK_SELECTOR = 'p, h1, h2, h3, h4, h5, h6, ol, ul, table, blockquote, pre';

  function clamp(n, min, max) {
    return Math.min(max, Math.max(min, n));
  }

  function parseHeadingLevel(tagName) {
    var m = /^h([1-6])$/i.exec(tagName);
    return m ? Number(m[1]) : null;
  }

  function hasMeaningfulText(el) {
    var text = (el.textContent || '').replace(/\u00a0/g, ' ').trim();
    return text.length > 0;
  }

  function preCleanRawHtml(html) {
    var out = html;
    out = out.replace(/<!--\[if[\s\S]*?<!\[endif\]-->/gi, '');
    out = out.replace(/<\/?(?:o|v|w|m):[^>]*>/gi, '');
    out = out.replace(/<xml[\s\S]*?<\/xml>/gi, '');
    out = out.replace(/<style[\s\S]*?<\/style>/gi, '');
    out = out.replace(/<meta[^>]*>/gi, '');
    out = out.replace(/<link[^>]*>/gi, '');
    return out;
  }

  function unwrapFontTags(root) {
    var fonts = Array.from(root.querySelectorAll('font'));
    for (var i = 0; i < fonts.length; i++) {
      var font = fonts[i];
      var parent = font.parentNode;
      if (!parent) continue;
      while (font.firstChild) parent.insertBefore(font.firstChild, font);
      parent.removeChild(font);
    }
  }

  function unwrapDocsGuidWrappers(root) {
    var wrappers = Array.from(root.querySelectorAll('b[id^="docs-internal-guid-"]'));
    for (var i = 0; i < wrappers.length; i++) {
      var wrap = wrappers[i];
      var parent = wrap.parentNode;
      if (!parent) continue;
      while (wrap.firstChild) parent.insertBefore(wrap.firstChild, wrap);
      parent.removeChild(wrap);
    }
  }

  function detectWordHeadingLevel(el) {
    var style = (el.getAttribute('style') || '').toLowerCase();
    var className = el.getAttribute('class') || '';

    var outline = /mso-outline-level\s*:\s*([1-6])/.exec(style);
    if (outline) return Number(outline[1]);

    var styleName =
      /mso-style-name\s*:\s*['"]?\s*(heading\s*([1-6])(?:\s*char)?|title(?:\s*char)?)/i.exec(style);
    if (styleName) {
      if (/title/i.test(styleName[1])) return 1;
      if (styleName[2]) return Number(styleName[2]);
    }

    var classMatch =
      /\b(?:MsoHeading([1-6])|MsoTitle|Heading\s*([1-6])|Heading([1-6]))\b/i.exec(className);
    if (classMatch) {
      if (/MsoTitle/i.test(classMatch[0])) return 1;
      var n = classMatch[1] || classMatch[2] || classMatch[3];
      if (n) return Number(n);
    }

    return null;
  }

  function promoteWordHeadings(root) {
    var paragraphs = Array.from(root.querySelectorAll('p'));
    for (var i = 0; i < paragraphs.length; i++) {
      var p = paragraphs[i];
      var level = detectWordHeadingLevel(p);
      if (!level) continue;
      var h = p.ownerDocument.createElement('h' + level);
      while (p.firstChild) h.appendChild(p.firstChild);
      if (p.parentNode) p.parentNode.replaceChild(h, p);
    }
  }

  function getFirstMeaningfulBlock(root) {
    var blocks = Array.from(root.querySelectorAll(BLOCK_SELECTOR));
    for (var i = 0; i < blocks.length; i++) {
      if (hasMeaningfulText(blocks[i])) return blocks[i];
    }
    return null;
  }

  function getFirstHeading(root) {
    var headings = Array.from(root.querySelectorAll('h1,h2,h3,h4,h5,h6'));
    for (var i = 0; i < headings.length; i++) {
      var el = headings[i];
      if (!hasMeaningfulText(el)) continue;
      var level = parseHeadingLevel(el.tagName);
      if (level) return { el: el, level: level };
    }
    return null;
  }

  function countHeadings(root) {
    return Array.from(root.querySelectorAll('h1,h2,h3,h4,h5,h6')).filter(hasMeaningfulText).length;
  }

  function normalizeHeadingOutline(root) {
    var firstBlock = getFirstMeaningfulBlock(root);
    var firstHeading = getFirstHeading(root);
    if (!firstBlock || !firstHeading) return;

    var startsWithHeading = parseHeadingLevel(firstBlock.tagName) != null;

    // Mid-article lone deep heading paste (e.g. only H5) — leave alone
    if (startsWithHeading && firstHeading.level >= 4 && countHeadings(root) === 1) {
      return;
    }

    var targetStart = startsWithHeading ? 1 : 2;
    if (firstHeading.level <= targetStart) return;

    var offset = firstHeading.level - targetStart;
    var headings = Array.from(root.querySelectorAll('h1,h2,h3,h4,h5,h6'));
    for (var i = 0; i < headings.length; i++) {
      var el = headings[i];
      var level = parseHeadingLevel(el.tagName);
      if (!level) continue;
      var newLevel = clamp(level - offset, 1, 6);
      if (newLevel === level) continue;
      var h = el.ownerDocument.createElement('h' + newLevel);
      while (el.firstChild) h.appendChild(el.firstChild);
      if (el.parentNode) el.parentNode.replaceChild(h, el);
    }
  }

  function cleanStyleAttribute(style) {
    var kept = [];
    var parts = style.split(';');
    for (var i = 0; i < parts.length; i++) {
      var trimmed = parts[i].trim();
      if (!trimmed) continue;
      var lower = trimmed.toLowerCase();
      // Drop Word/Docs noise and size/color that break front typography
      if (lower.indexOf('mso-') === 0) continue;
      if (lower.indexOf('page-') === 0) continue;
      if (lower.indexOf('color') === 0) continue;
      if (lower.indexOf('font-size') === 0) continue;
      if (lower.indexOf('font-family') === 0) continue;
      if (lower.indexOf('line-height') === 0) continue;
      if (lower.indexOf('background') !== -1) continue;
      if (
        lower.indexOf('margin') === 0 ||
        lower.indexOf('padding') === 0 ||
        lower.indexOf('text-align') === 0 ||
        lower.indexOf('font-weight') === 0 ||
        lower.indexOf('font-style') === 0 ||
        lower.indexOf('text-decoration') === 0
      ) {
        kept.push(trimmed);
      }
    }
    return kept.length ? kept.join('; ') : null;
  }

  function cleanClassAttribute(className) {
    var kept = className
      .split(/\s+/)
      .filter(Boolean)
      .filter(function (c) {
        if (/^Mso/i.test(c)) return false;
        if (/^c\d+$/i.test(c)) return false;
        if (/^docs-/i.test(c)) return false;
        return true;
      });
    return kept.length ? kept.join(' ') : null;
  }

  function cleanAllElements(root) {
    var all = Array.from(root.querySelectorAll('*'));
    for (var i = 0; i < all.length; i++) {
      var el = all[i];
      if (el.hasAttribute('style')) {
        var cleaned = cleanStyleAttribute(el.getAttribute('style') || '');
        if (cleaned) el.setAttribute('style', cleaned);
        else el.removeAttribute('style');
      }
      if (el.hasAttribute('class')) {
        var cleanedClass = cleanClassAttribute(el.getAttribute('class') || '');
        if (cleanedClass) el.setAttribute('class', cleanedClass);
        else el.removeAttribute('class');
      }
      var attrs = Array.from(el.attributes);
      for (var j = 0; j < attrs.length; j++) {
        var name = attrs[j].name.toLowerCase();
        if (name.indexOf('mso-') === 0 || name.indexOf('data-mce-') === 0 || name === 'lang') {
          el.removeAttribute(attrs[j].name);
        }
      }
    }
  }

  function parseHtmlFragment(html) {
    var doc = new DOMParser().parseFromString('<div id="__paste_root__">' + html + '</div>', 'text/html');
    var root = doc.getElementById('__paste_root__');
    return { doc: doc, root: root };
  }

  function sanitizeBlogPasteHtml(html) {
    if (!html || !html.trim()) return html;

    try {
      var cleaned = preCleanRawHtml(html);
      var parsed = parseHtmlFragment(cleaned);
      var root = parsed.root;
      if (!root) return html;

      unwrapFontTags(root);
      unwrapDocsGuidWrappers(root);
      promoteWordHeadings(root);
      normalizeHeadingOutline(root);
      cleanAllElements(root);

      return root.innerHTML;
    } catch (e) {
      return html;
    }
  }

  global.sanitizeBlogPasteHtml = sanitizeBlogPasteHtml;
})(typeof window !== 'undefined' ? window : this);
