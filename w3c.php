<?php
$ID = $_POST["ID1"];
$MaxPeople = $_POST["MaxPeople1"];
$UID = 23;
//Connect to server
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "myDB";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    echo "Connected<br>";
}


  //UPDATE the status of the event
  //Check if the event is fully registered
  $sql = "SELECT CurrentPeople, MaxPeople FROM REvent WHERE ID=$ID";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  echo $row["CurrentPeople"];
  echo $row["MaxPeople"];


  if($row["CurrentPeople"]<$row["MaxPeople"]){
      echo "You are able to register.";
      //increase count of CurrentPeople by 1
      $CurrentPeople = $row["CurrentPeople"]+1;
      $status1=0;
      $sql = "UPDATE REvent SET CurrentPeople=$CurrentPeople WHERE ID= $ID";
      if ($conn->query($sql) === TRUE) {
          echo "CurrentPeople updated successfully";
      } else {
          echo "Error updating CurrentPeople: " . $conn->error;
      }

      //if the event is full, close and schedule it by change its status to 1
      if($CurrentPeople<$row["MaxPeople"]){
        echo "Still Open";
      } else{
          $status1=1;
          $sql = "UPDATE REvent SET Status=1 WHERE ID= $ID";
          if ($conn->query($sql) === TRUE) {
              echo "Status updated successfully";
          } else {
              echo "Error updating Status: " . $conn->error;
          }
      }

      //insert into RMapping: build up rel. btw. user and event
      $sql = "INSERT INTO RMapping (UserID, EventID, Status)
          VALUES ($UID, $ID, $status1)";

      if ($conn->query($sql) === TRUE) {
          echo "New RMapping record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }

  }else{
      echo "The event has been fully joined.";
  }

/*
    if($CurrentPeople==$MaxPeople){
        $sql = "UPDATE REvent SET Status=1 WHERE ID= $ID";
        if ($conn->query($sql) === TRUE) {
            echo "Status updated successfully";
        } else {
            echo "Error updating Status: " . $conn->error;
        }
    }
*/
  $conn->close();
?>
