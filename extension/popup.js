jQuery(document).ready(function(){
    jQuery(document).on('click','.save', function(){
        const key = jQuery('.key');
        const value = jQuery('.value');
        jQuery.post('https://pdfpub.com/ajax/store',{key: key.val(), value: value.html()}).then(function(){
            alert('Note has been saved at https://pdfpub.com/'+key.val());
            window.close();
        });
    });
});