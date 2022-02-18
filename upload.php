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

 deleteAll("files/", "10800");
 
if(isset($_FILES['file']['name'])){
   $filename = $_FILES['file']['name'];
   $mime_type = mime_content_type($_FILES['file']['tmp_name']);
   $fileSize = $_FILES['file']['size'];

   function generateRandomString($length = 5) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
 }
 
    $folder = 'files/'. generateRandomString();
    if (!file_exists($folder)) {
      mkdir($folder, 0777, true);
    }
 
 $location = $folder."/".$filename;

   $response = 0;
      /* Upload file */
      if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
         // deleteExp($location);
//         $url = (strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))))."://" .$_SERVER['HTTP_HOST'] . dirname($_SERVER["PHP_SELF"]).'/'.str_replace(' ', '%20', $location);;

         $url = "https://" .$_SERVER['HTTP_HOST'] . dirname($_SERVER["PHP_SELF"]).'/'.str_replace(' ', '%20', $location);;
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
