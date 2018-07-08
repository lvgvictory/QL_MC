function ckeditor(name) {
    var editor = CKEDITOR.replace(name, {
        language: 'vi',
        filebrowserImageBrowseUrl: baseURL+"/js/ckfinder/ckfinder.html?type=Images",
        filebrowserFlashUploadUrl: baseURL+"/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash",
        filebrowserImageUploadUrl: baseURL+"/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
        filebrowserFlashUploadUrl: baseURL+"/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash",
        toolbar: [
            ['Source','-','Save','NewPage','Preview','-','Templates'],
            ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
            ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
            '/',
            ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
            ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
            ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
            ['BidiLtr', 'BidiRtl' ],
            ['Link','Unlink','Anchor'],
            ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
            '/',
            ['Styles','Format','Font','FontSize'],
            ['TextColor','BGColor'],
            ['Maximize', 'ShowBlocks','-','About']
        ]
    });
}