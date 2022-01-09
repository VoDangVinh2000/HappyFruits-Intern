// Copyright (c) 2015, Fujana Solutions - Moritz Maleck. All rights reserved.
// For licensing, see LICENSE.md

CKEDITOR.plugins.add( 'imageuploader', {
    init: function( editor ) {
        editor.config.filebrowserUploadUrl = base_url + 'tai-anh';
        editor.config.filebrowserBrowseUrl = base_url + 'quan-ly-anh';
    }
});