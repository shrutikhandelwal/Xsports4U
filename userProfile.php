<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans" />
<link rel = "stylesheet" type="text/css" href = "menu1.css" >
</head>

<body >
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<div class="h1">
		<ul>
		  
			<li id ="home"> <a href="">Xsports4U</a></li> 
			<li class="nav"><a href="">Search</a></li> 
			<li class="nav" ><a href="">About Us</a></li> 
			<li class="nav"><a href="">Contact Us</a></li> 
			<li class="nav" style ="float:right"><a href=""> Sign In/Sign Up</a></li> 
				
		</ul>
	</div>




		<div id="UserInfo">
			<img class="profilepic" src="http://www.lcfc.com/images/common/bg_player_profile_default_big.png" alt="profilepic"/>

			<div id="userinfodiv" >
				<b>Name:  </b><br />
				<b>Age:  </b> <br />
				<b>Email id:  </b><br />
				<b>Contact info:  </b><br />
				
			</div>

		</div>
	<div id= "main">

		<?php

			$servername = "localhost";
			$username = "root";
			$password = "root";
			$dbname = "myDB";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 


			$result = $conn->query("SELECT ID,Type,Location,TimeYY,TimeMM,TimeDD,TimeHH FROM REvent WHERE ID IN (SELECT EventID FROM RMapping WHERE Status = 1 AND UserID =2);");


			if ($result->num_rows > 0) { 

		?>


		<div style="cellpadding:80; text-align:center; position: relative;  width:550px; margin-top: 47px; float:right; table{height:100px; overflow:scroll}">
			<table>
				 <th colspan=5 id="schedule">User Schedule</th>

				<?php
				echo "<tr><th>EventID</th><th>Sport Type</th><th>Location</th><th>Date</th><th>Time</th></tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["ID"]. "</td><td>". $row["Type"]. "</td><td>". " " .$row["Location"]."</td><td>". " ".$row["TimeYY"]."-".$row["TimeMM"]."-".$row["TimeDD"]."</td><td>". " ".$row["TimeHH"].":00". "</td></tr>";
					}

				} else {
					 echo "0 results";
					 }

				?>
				
			</table>				

				
		</div><br/><br/>



		<?php


		$result = $conn->query("SELECT ID,Type,Location,TimeYY,TimeMM,TimeDD,TimeHH FROM REvent WHERE ID IN (SELECT EventID FROM RMapping WHERE Status = 0 AND UserID =2);");


			if ($result->num_rows > 0) { 

		?>
		

		<div style="cellpadding:80;  width:550px; margin-left:80px; text-align:center; overfloat: auto;">
			<table border=1>
				<th colspan=5 >Subscribed Events</th>


				<?php
				echo "<tr><th>EventID</th><th>Sport Type</th><th>Location</th><th>Date</th><th>Time</th></tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["ID"]. "</td><td>". $row["Type"]. "</td><td>". " " .$row["Location"]."</td><td>". " ".$row["TimeYY"]."-".$row["TimeMM"]."-".$row["TimeDD"]."</td><td>". " ".$row["TimeHH"].":00". "</td></tr>";
					}
				?>

			</table>

				<?php
					$conn->close();
						
					 } else {
					 echo "0 results";
					 }


				?>

		</div><br/><br/>


		<!-- <div id="Ebutton">
			<button id ="EventButton"> Show Events </button>
		</div>
	</div> -->


		<div id="footer" >
			@copyright
		</div>

</body>
</html>