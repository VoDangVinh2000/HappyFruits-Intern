/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.extraPlugins = 'imageuploader';
    // Define changes to default configuration here:
    config.contentsCss = '/pixeladmin/assets/plugins/ckeditor/fonts.css';
    //the next line add the new font to the combobox in CKEditor
    config.font_names = 'Playfair Display;Roboto;American Typewriter;American Typewriter Bold;UTM;VPSHANO;Clicker Script;UVNBaiSau_R;' + config.font_names;
    config.height = 500;
};
