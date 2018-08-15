<html>
  <head>
  </head>
  <body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "onlineexam";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $jsonUrlAns = "json/questions.json";
      $jsonAns = file_get_contents($jsonUrlAns);
      $jsonAnsObj = json_decode($jsonAns);
      $correctAns=0;
      $wrongAns=0;
      $notAns=0;
      for($i=0;$i<count($jsonAnsObj->question);$i++){
        $j=$i+1;
        if(!empty($_POST["options$j"]) && strcasecmp($_POST["options$j"],$jsonAnsObj->question[$i]->ans)==0){
          $correctAns++;
        }
        else if(empty($_POST["options$j"])){
          $notAns++;
        }
        else{
          $wrongAns++;
        }
      }
      $result=$correctAns*4;
      $sql="insert into result (correct,wrong,notans,result) values ('$correctAns','$wrongAns','$notAns','$result')";
      mysqli_query($conn,$sql);
      $conn->close();
      ?>
      <div>
        <span>Correct Answer = <?php echo $correctAns ?></span></br>
        <span>Wrong Answer = <?php echo $wrongAns ?></span></br>
        <span>Not Answered = <?php echo $notAns ?></span></br>
        <span>Your Score = <?php echo $result ?></span>
      </div>
  </body>
</html>
