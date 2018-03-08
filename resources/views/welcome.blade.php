<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PDFPUB.com - Summernote</title>
  <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
  <style>
  
  .note-editor.note-frame {
    border: none;
}
.panel-default > .panel-heading {
    color: #333;
    background-color: none;
    border-color: none;
}
.note-toolbar .panel-heading{
    position: fixed;
}
.pdf {
    position: fixed;
    top: 0;
    right: 0;
    z-index: 730;
    background: blue;
    color: white;
    padding: 10px;
}
input{
color:black;
}
.r-48{
    right: 48px
}
</style>
</head>
<body style="position:relative">
@if(request('mode') == 'demon')
<form class="pdf" action="{{url()->current().'/mail'}}"><input class="pdf" style="color:black;background: #ffffff;height: 40px;right: 95px;" name="mail" placeholder="email" title="Type your email and hit enter to send this note in email"/></form>
<a class="pdf r-48" href="{{url()->current()}}/image" title="Download your note in Image format">JPG</a>
@endif
<a class="pdf" href="{{url()->current()}}/pdf" title="Download your note in pdf format">PDF</a>
  <textarea id="summernote">{{request()->route('note')->content ?? "Let's start"}}
  </textarea>
  <script defer>
    var hold = null;
    var Protect = function (context) {
        var ui = $.summernote.ui;
        // create button
        var button = ui.button({
        contents: 'P',
        tooltip: 'Protect it with password',
        click: function () {
            var password = prompt('Enter password');
            if( password ){
                var email = prompt('Enter email ( In case you forget )');
                if(email){
                    $.post("{{url()->current()}}/protect", {password: password,email:email}).then(function(){
                        alert('Note is under protection.');
                    });
                    return;
                }
            }
            alert("Not protected")
        }
        });
        return button.render();   // return button as jquery object
    }

    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Just start writing',
            tabsize: 2,
            height: 500,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                [ ['protect']]
            ],
            callbacks: {
                onChange: function() {
                    var val = $('.note-editable').html();
                    hold && hold.abort();
                    hold = $.post("{{url()->current()}}", {text: val})
                }
            },
            buttons: {
                protect: Protect
            }
        });
    });
  </script>
</body>
</html>
