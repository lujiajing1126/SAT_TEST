
CKEDITOR.editorConfig = function( config ) {
    config.language = 'zh-cn'; 
    config.width = 600; 
    config.height = 150; 
    config.font_names='MS Serif;'+ config.font_names;
    config.enterMode = CKEDITOR.ENTER_BR;
    config.shiftEnterMode = CKEDITOR.ENTER_P;   
    config.toolbar =
        [
                { name: 'basicstyles', items : [ 'Bold','Italic','Strike','-'] },           
                { name: 'styles', items : [ 'Font','FontSize' ] },
                { name: 'colors', items : [ 'TextColor'] },
                { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','-' ] },
                { name: 'insert', items :[ 'Image'] },
                { name: 'tools', items : [ 'Maximize','-'] },
                { name: 'document', items : [ 'Source' ] },
                '/'
        ];
};