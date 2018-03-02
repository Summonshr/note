var hold = '';
jQuery(document).on('copy', function(e){ 
    hold = window.getSelection().toString();
});
