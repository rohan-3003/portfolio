<?php
   $info = file_get_contents('php://input');
   $file = fopen('json/questions.json','w');
   fwrite($file, $info);
   fclose($file);
?>
