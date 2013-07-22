
CKEDITOR.editorConfig = function( config ) {
    config.language = 'zh-cn'; 
    config.width = 600; 
    config.height = 300; 
    config.font_names='MS Serif;'+ config.font_names;
    config.toolbar =
        [
                { name: 'basicstyles', items : [ 'Bold','Italic','Strike','-'] },           
                { name: 'styles', items : [ 'Font','FontSize' ] },
                { name: 'colors', items : [ 'TextColor'] },
                { name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
                { name: 'insert', items :[ 'Image'] },
                { name: 'tools', items : [ 'Maximize','-'] },
                { name: 'document', items : [ 'Source' ] },
                '/'
        ];
};



