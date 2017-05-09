<!DOCTYPE html>
<html>
<body>

<?php
$ID = $_POST["ID1"];
$TimeMM = $_POST["TimeMM1"];
$TimeDD = $_POST["TimeDD1"];
$TimeHH = $_POST["TimeHH1"];
$Location = $_POST["Location1"];
$Type = $_POST["Type1"];
$Professional_level = $_POST["Professional_level1"];
$CurrentPeople = $_POST["CurrentPeople1"];
$MaxPeople = $_POST["MaxPeople1"];
?>
<div>
  <p> You will join the sports party with ID <? echo $ID ?> </p>
  <p> The information of the event is followed, please check and click on the button below to confirm </p>
  <p> Type: <? echo $Type ?> </p>
  <p> Time: Month: <? echo $TimeMM ?>  Day: <? echo $TimeDD ?> Hour: <? echo $TimeHH ?></p>
  <p> City: <? echo $Location ?> </p>
  <p> Level:  <? echo $Professional_level ?> </p>
  <p> Current People: <? echo $CurrentPeople ?> </p>
  <p> Max People: <? echo $MaxPeople ?> </p>
</div>
<form action="w3c.php" method="post">
<input type="hidden" value="<? echo $ID ?>" name="ID1" >
<input type="hidden" value="<? echo $MaxPeople ?>" name="MaxPeople1" >
<input type="submit" value="Confirm" name="Confirmed" >
</form>

</body>
</html>
