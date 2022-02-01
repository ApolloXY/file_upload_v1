<?php

function deleteAll($dir, $t, $remove = false) {
   $current_time = time();
   $structure = glob(rtrim($dir, "/").'/*');
   if (is_array($structure)) {
     foreach($structure as $file) {
       $file_creation_time = filemtime($file);
       $difference = $current_time - $file_creation_time;
       if (is_dir($file))
         deleteAll($file, $t, true);
       else if(is_file($file)) {
         if ($difference >= $t) {
           unlink($file);
         }
       }
     }
   }
   if($remove && count(glob(rtrim($dir, "/").'/*')) == 0){
     rmdir($dir);
   }
 }

 deleteAll("files/", "20");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP File Upload</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
   <input type="file" id="file" name="file" />
   <input type="button" value="Upload" id="but_upload">




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
          console.log(response)
          },
       });
    }
});
});
</script>
</html>
