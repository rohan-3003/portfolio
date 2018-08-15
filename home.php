<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/home_design.css">
    <body>
      <form method="post" action="result.php">
      <?php
        $jsonUrlQue = "json/questions.json";
        $jsonQue = file_get_contents($jsonUrlQue);
        $jsonQueObj = json_decode($jsonQue);
        for($i=0;$i<count($jsonQueObj->question);$i++){
       ?>
       <div class="row que_set">
         Q<?php
          echo ($i+1)."  ".$jsonQueObj->question[$i]->ques;
        ?></br>
        <div class="options">
          <input type="radio" class="option" name="options<?php echo ($i+1) ?>" value="<?php echo $jsonQueObj->question[$i]->one ?>"><?php echo $jsonQueObj->question[$i]->one ?></br>
          <input type="radio" class="option" name="options<?php echo ($i+1) ?>" value="<?php echo $jsonQueObj->question[$i]->two ?>"><?php echo $jsonQueObj->question[$i]->two ?></br>
          <input type="radio" class="option" name="options<?php echo ($i+1) ?>" value="<?php echo $jsonQueObj->question[$i]->three ?>"><?php echo $jsonQueObj->question[$i]->three ?></br>
          <input type="radio" class="option" name="options<?php echo ($i+1) ?>" value="<?php echo $jsonQueObj->question[$i]->four ?>"><?php echo $jsonQueObj->question[$i]->four ?>
        </div>
       </div>
     <?php } ?>
     <div id="submit">
       <input type="submit" id="submit_button">
    </div>
   </form>
    </body>
  </head>
</html>
