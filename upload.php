<?php


if(isset($_FILES['file']['name'])){
   $filename = $_FILES['file']['name'];
   $mime_type = mime_content_type($_FILES['file']['tmp_name']);
   $fileSize = $_FILES['file']['size'];

   $location = "files/".$filename;


   $response = 0;
      /* Upload file */
      if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
         // deleteExp($location);
         $url = "https://" .$_SERVER['HTTP_HOST'] . "/".$location ;
         $response = array(
            'url' => $url,
            'size' => $fileSize,
            'type' => $mime_type,
            'name' => $filename,
        );
      }
      echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

}


?>
