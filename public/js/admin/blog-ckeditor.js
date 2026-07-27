/**
 * CKEditor setup for admin blog full_description field.
 * Normalizes Word / Google Docs paste and exposes Heading 1–6 in the format dropdown.
 */
(function (global) {
  'use strict';

  function initBlogCKEditor(elementId) {
    if (typeof CKEDITOR === 'undefined') {
      console.error('CKEditor is not loaded');
      return null;
    }

    return CKEDITOR.replace(elementId, {
      format_tags: 'p;h1;h2;h3;h4;h5;h6;pre',
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
