<?php
include("w3.html");
?>

<?php
  if (isset($_REQUEST["confirmed"])) {
  $Month = $_REQUEST["Month"];
  $Day = $_REQUEST["Day"];
  $Hour = $_REQUEST["Hour"];
  $City = $_REQUEST["City"];
  $AType = $_REQUEST["AType"];
  $ALevel = $_REQUEST["ALevel"];

  $i=0;
//Connect to server
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "myDB";
//Insert Data
// Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }else{
    echo "Connected<br>";
  }
//SELECT and DISPLAY
  $sql = "SELECT ID, TimeMM, TimeDD, TimeHH, Location, Type, Professional_level, MaxPeople, CurrentPeople
  FROM REvent
  WHERE TimeMM=$Month AND TimeDD=$Day AND TimeHH=$Hour";
/*WHERE Days=$Day, Hours=$Hour, Cities=$City, ATypes=$AType";*/
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
       ?>
       <div class="eventResult">
       <table class="resultTable"><tr><th>ID</th><th>Month</th><th>Day</th><th>Hour</th>
         <th>City</th><th>Type</th><th>Professional_level</th><th>Max People</th><th>Current People</th></tr>
       <?php
       // output data of each row
       while($row = $result->fetch_assoc()) {
      ?>
      <tr><td><? echo $row["ID"] ?></td>
          <td><? echo $row["TimeMM"] ?></td>
          <td><? echo $row["TimeDD"] ?></td>
          <td><? echo $row["TimeHH"] ?></td>
          <td><? echo $row["Location"] ?></td>
          <td><? echo $row["Type"] ?></td>
          <td><? echo $row["Professional_level"] ?></td>
          <td><? echo $row["MaxPeople"] ?></td>
          <td><? echo $row["CurrentPeople"] ?></td>
          <td><form action="w3b.php" method="post">
          <input type="hidden" value="<? echo $row["ID"] ?>" name="ID1" >
          <input type="hidden" value="<? echo $row["TimeMM"] ?>" name="TimeMM1" >
          <input type="hidden" value="<? echo $row["TimeDD"] ?>" name="TimeDD1" >
          <input type="hidden" value="<? echo $row["TimeHH"] ?>" name="TimeHH1" >
          <input type="hidden" value="<? echo $row["Location"] ?>" name="Location1" >
          <input type="hidden" value="<? echo $row["Type"] ?>" name="Type1" >
          <input type="hidden" value="<? echo $row["Professional_level"] ?>" name="Professional_level1" >
          <input type="hidden" value="<? echo $row["CurrentPeople"] ?>" name="CurrentPeople1" >
          <input type="hidden" value="<? echo $row["MaxPeople"] ?>" name="MaxPeople1" >
          <input type="hidden" value="<? echo $i ?>" name="i1" >
          <input type="submit" value="Join" name="Joined<?echo $i?>" >
          </form>
        </tr>
       <?php $i=$i+1; } ?>
       </table>
       </div>
       <?php
  } else {
       echo "0 results";
  }
  $conn->close();
}
?>

</body>
</html>
