<html>
<body>

<?php

//create connection to myDB
$servername = "localhost";
$username = "root";
$password = "root";
$DBname="myDB";
// Create connection
$conn = new mysqli($servername, $username, $password, $DBname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";


//Create table of user profiles
// photo address will be saved
// Rating is for later use; here it's saved as a varchar,
// therefore we need to save the rating as a string before we save it
// Javascript commands related: toPrecision()
/*
PersonalProfile{
  //must have
  MemberId(PID); primary key auto incre
  Name: first name; last name
  PaypalEmail;
  Contact Phone;
  Contact Email;
  Photo;
  Rating (Trainer);

  // nice to have
  Hobbies;
  AboutMe;
  Area:
}
*/
$sql = "CREATE TABLE UserProfile (
ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
FirstName VARCHAR(50) NOT NULL,
LastName VARCHAR(50) NOT NULL,
PaypalEmail VARCHAR(255),
Phone VARCHAR(50),
PhotoAddress VARCHAR(255),
Rating VARCHAR(50)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table UserProfile created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

//insert into the table UserProfile
$sql = "INSERT INTO UserProfile (FirstName, LastName, PaypalEmail, phone, PhotoAddress, Rating)
    VALUES ('Mike', 'Chrome', 'apple@example.com','3232343423','/photo/p1.jpg', '0.0')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}




//Create table of regular events: REvent
/*
RegularEvent{
  REventID; primary key auto incre
  Time:  4 columns: YY MM DD HH;
  EventStatus: 0: open 1:scheduled 2: closed
  Location;
  EventType(What sport);
  MaxPeople;
  CurrentPeople;
  Professional level: professional entry-level medium semi-professional value: 0, 1, 2, 3

//nice to have option:
hrs
}
*/
$sql = "CREATE TABLE REvent (
ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
TimeYY INT NOT NULL,
TimeMM INT NOT NULL,
TimeDD INT NOT NULL,
TimeHH INT NOT NULL,
Status INT NOT NULL,
Location VARCHAR(50) NOT NULL,
Type VARCHAR(50) NOT NULL,
MaxPeople INT NOT NULL,
CurrentPeople INT NOT NULL,
Professional_level INT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table REvent created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

//insert into REvent
$sql = "INSERT INTO REvent (TimeYY, TimeMM, TimeDD, TimeHH, Status, Location,
        Type, MaxPeople, CurrentPeople, Professional_level)
    VALUES (2016, 05, 15, 16, 0, 'SF', 'football', 10, 1, 1)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


//Create table of training events: TEvent
/*
TrainingEvent{

must have
   TEventID; primary key auto incre
    Time:  4 columns: YY MM DD HH;
   EventStatus: 0: open request 1:trainer waiting for payment  2: payment accepted, scheduled 3: finished
   Location;
   EventType(What sport)
}

*/
$sql = "CREATE TABLE TEvent (
ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
TimeYY INT NOT NULL,
TimeMM INT NOT NULL,
TimeDD INT NOT NULL,
TimeHH INT NOT NULL,
Status INT NOT NULL,
Location VARCHAR(50) NOT NULL,
Type VARCHAR(50) NOT NULL,
Professional_level INT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table TEvent created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "INSERT INTO TEvent(TimeYY, TimeMM, TimeDD, TimeHH, Status, Location,
        Type, Professional_level)
    VALUES (2016, 05, 17, 13, 0, 'SF', 'football', 1)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

//Create mapping table for user ID and regular event ID
//Status indicates the status of the event, same value as Status in corresponding row in REvent
/*
MappingForReg{
   MappingID; primary key auto incre
   userID;
   RegularEventID;
}
*/
$sql = "CREATE TABLE RMapping (
ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
UserID INT NOT NULL,
EventID INT NOT NULL,
Status INT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table RMapping created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

//insert into RMapping
$sql = "INSERT INTO RMapping (UserID, EventID, Status)
    VALUES (0, 0, 0)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//Create mapping table for user ID and training event ID
//Status indicates the status of the event, same value as Status in corresponding row in TEvent

/*
MappingForTr{
   MappingID; primary key auto incre
   userID;
   TrainingEventID;
   TrainerID;
}
*/
$sql = "CREATE TABLE TMapping (
ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
UserID INT NOT NULL,
EventID INT NOT NULL,
TrainerID INT NOT NULL,
Status INT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table TMapping created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

//insert into TMapping
$sql = "INSERT INTO TMapping (UserID, EventID, TrainerID, Status)
    VALUES (0, 0, 1, 0)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// General Format for multiple insertion
/*
    //Insert Multiple
    $sql = "INSERT INTO Table (Days, Hours, Cities, ATypes)
    VALUES ('3','15','SM','Football');";
    $sql .= "INSERT INTO Table (Days, Hours, Cities, ATypes)
    VALUES ('4', '14', 'SF','Tennis');";
    $sql .= "INSERT INTO Table (Days, Hours, Cities, ATypes)
    VALUES ('5', '16', 'SC','Basketball')";

    if ($conn->multi_query($sql) === TRUE) {
        echo "New records created successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
*/

// General Format for prepare and blind
// can be used for template of multiple single operation
/*
// prepare and bind
$stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $firstname, $lastname, $email);

// set parameters and execute
$firstname = "John";
$lastname = "Doe";
$email = "john@example.com";
$stmt->execute();

$firstname = "Mary";
$lastname = "Moe";
$email = "mary@example.com";
$stmt->execute();

$firstname = "Julie";
$lastname = "Dooley";
$email = "julie@example.com";
$stmt->execute();

echo "New records created successfully";

$stmt->close();
*/

// General Format for deleting data and updating data in table
/*
//DELEAT DATA
for($i=$last_id; $i>10; $i--){
  $sql = "DELETE FROM MyGuests WHERE id=$i";

  if ($conn->query($sql) === TRUE) {
      echo "Record deleted successfully";
  } else {
      echo "Error deleting record: " . $conn->error;
  }
}

//UPDATE DATA
$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
*/

//General Format for SELECT and DISPLAY from table
//please refer to w3a.php for a more detailed example about how to retrieve data
//from database and display it in our webpage
/*
$result = $conn->query("SELECT ID, Days, Hours, Cities, ATypes FROM Event");
echo "so far good <br>";
$row_cnt = $result->num_rows;

printf("Result set has %d rows.\n", $row_cnt);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<br> ID: ". $row["ID"]. "<br>";
     }
} else {
     echo "0 results";
}
*/

/*
if ($result->num_rows > 0) {
     echo "<table><tr><th>ID</th><th>Name</th></tr>";
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<tr><td>" . $row["id"]. "</td><td>" . $row["firstname"]. " " . $row["lastname"]. "</td></tr>";
     }
     echo "</table>";
} else {
     echo "0 results";
}
*/
$conn->close();
?>

</body>
</html>
