<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP File Upload</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
   <input type="file" id="file" name="file" />
   <input type="button" value="Upload" id="but_upload">
<br>
<progress min="0" max="100" value="0"></progress>
<p id="msg1"></p>

</body>
<script>

$(document).ready(function(){

$("#but_upload").click(function(){
console.log("uplo..")
    var fd = new FormData();
    var files = $('#file')[0].files;
    
    // Check file selected or not
    if(files.length > 0 ){
       fd.append('file',files[0]);

       $.ajax({
          url: 'upload.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            document.getElementById('msg1').innerHTML = "<a href='" + JSON.parse(response).url +"' download>File</a>";

          console.log(response);

          },
          xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        console.log(percentComplete + '%');
                        document.querySelector('progress').value = percentComplete;

                    }
                }, false);
                return xhr;
            },
       });
    }
});
});
</script>
</html>
