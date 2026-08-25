/**
 * CKEditor setup for admin blog full_description field.
 * Normalizes Word / Google Docs paste and exposes Heading 1–6 in the format dropdown.
 */
(function (global) {
  'use strict';

  /**
   * @param {string} elementId
   * @param {{ contentsCss?: string }} [options]
   */
  function initBlogCKEditor(elementId, options) {
    options = options || {};

    if (typeof CKEDITOR === 'undefined') {
      console.error('CKEditor is not loaded');
      return null;
    }

    if (typeof global.sanitizeBlogPasteHtml !== 'function') {
      console.warn('sanitizeBlogPasteHtml is not loaded — Word/Docs paste normalization disabled');
    }

    if (CKEDITOR.instances[elementId]) {
      try {
        CKEDITOR.instances[elementId].destroy(true);
      } catch (e) {}
    }

    var contentCssList = [CKEDITOR.getUrl('contents.css')];
    if (options.contentsCss) {
      contentCssList.push(options.contentsCss);
    }

    return CKEDITOR.replace(elementId, {
      height: 420,
      format_tags: 'p;h1;h2;h3;h4;h5;h6;pre',
      format_p: { element: 'p', name: 'Paragraph' },
      format_h1: { element: 'h1', name: 'Heading 1' },
      format_h2: { element: 'h2', name: 'Heading 2' },
      format_h3: { element: 'h3', name: 'Heading 3' },
      format_h4: { element: 'h4', name: 'Heading 4' },
      format_h5: { element: 'h5', name: 'Heading 5' },
      format_h6: { element: 'h6', name: 'Heading 6' },
      format_pre: { element: 'pre', name: 'Preformatted' },
      allowedContent: true,
      forcePasteAsPlainText: false,
      enterMode: CKEDITOR.ENTER_P,
      shiftEnterMode: CKEDITOR.ENTER_BR,
      contentsCss: contentCssList,
      on: {
        paste: function (evt) {
          var html = evt.data.dataValue;
          if (
            html &&
            typeof html === 'string' &&
            html.trim() &&
            typeof global.sanitizeBlogPasteHtml === 'function'
          ) {
            evt.data.dataValue = global.sanitizeBlogPasteHtml(html);
          }
        },
      },
    });
  }

  global.initBlogCKEditor = initBlogCKEditor;
})(typeof window !== 'undefined' ? window : this);
