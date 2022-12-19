/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';

    config.contentsCss = 'unifont/eenaduu-webfont.css';
//    config.language = 'es';
    config.font_names = 'EenaduU;EenaduUH;EenaduWeb;' //+ config.font_names;
//    config.extraPlugins = 'pramukhime';
    config.extraPlugins = 'uploadimage';
    config.extraPlugins = 'uploadwidget';
};
