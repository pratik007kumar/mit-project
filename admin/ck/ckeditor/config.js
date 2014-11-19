/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

//CKEDITOR.editorConfig = function( config ) {
//	// Define changes to default configuration here. For example:
//	// config.language = 'en';
//	// config.uiColor = '#AADC6E';
//};
CKEDITOR.config.baseHref = "/admin/ck/ckeditor/";

CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here.
    // For the complete reference:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config

    config.contentsCss  = 'contents.css';
    config.language= 'en';
    config.height = '400px';
    config.uiColor = '#39B3D7';

    //kcfinder per l'uoload delle immagini
    config.filebrowserBrowseUrl = 'ck/kcfinder-3.12/browse.php?type=files';
    config.filebrowserImageBrowseUrl = 'ck/kcfinder-3.12/browse.php?type=images';
    config.filebrowserFlashBrowseUrl = 'ck/kcfinder-3.12/browse.php?type=flash';
    config.filebrowserUploadUrl = 'ck/kcfinder-3.12/upload.php?type=files';
    config.filebrowserImageUploadUrl = 'ck/kcfinder-3.12/upload.php?type=images';
    config.filebrowserFlashUploadUrl = 'ck/kcfinder-3.12/upload.php?type=flash';

    // Remove some buttons, provided by the standard plugins, which we don't
    // need to have in the Standard(s) toolbar.
    config.removeButtons = 'Subscript,Superscript';
    config.disableNativeSpellChecker = false;
};


//this is work in same folder
//CKEDITOR.config.baseHref = "<?php echo SITE_URL;?>/home/ck/ckeditor/";
//
//CKEDITOR.editorConfig = function( config ) {
//    // Define changes to default configuration here.
//    // For the complete reference:
//    // http://docs.ckeditor.com/#!/api/CKEDITOR.config
//
//    config.contentsCss  = 'contents.css';
//    config.language= 'en';
//    config.height = '400px';
//    config.uiColor = '#39B3D7';
//
//    //kcfinder per l'uoload delle immagini
//    config.filebrowserBrowseUrl = 'kcfinder-3.12/browse.php?type=files';
//    config.filebrowserImageBrowseUrl = 'kcfinder-3.12/browse.php?type=images';
//    config.filebrowserFlashBrowseUrl = 'kcfinder-3.12/browse.php?type=flash';
//    config.filebrowserUploadUrl = 'kcfinder-3.12/upload.php?type=files';
//    config.filebrowserImageUploadUrl = 'kcfinder-3.12/upload.php?type=images';
//    config.filebrowserFlashUploadUrl = 'kcfinder-3.12/upload.php?type=flash';
//
//    // Remove some buttons, provided by the standard plugins, which we don't
//    // need to have in the Standard(s) toolbar.
//    config.removeButtons = 'Subscript,Superscript';
//    config.disableNativeSpellChecker = false;
//};