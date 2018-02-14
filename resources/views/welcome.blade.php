<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Summernote</title>
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
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
</style>
</head>
<body >
  <textarea id="summernote">{{cache(request()->route('name'),'<p>Let\'s just start.</p>')}}
  </textarea>
  <script defer>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Just start writing',
            tabsize: 2,
            height: 500,
            callbacks: {
                onChange: function() {
                    var val = $('.note-editable').html();
                    setTimeout(function(){
                        $.post("{{url()->current()}}", {text: val})
                    }, 1000)
                }
            }
        });
    });
  </script>
</body>
</html>