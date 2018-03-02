jQuery(document).ready(function(){
    jQuery(document).on('click','.save', function(){
        jQuery.post('https://pdfpub.com/ajax',{key: jQuery('.key').val(), value: jQuery('.value').html()});
    });
});