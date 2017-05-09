<html>
<body>

<?php

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

/*
//Create table
$sql = "CREATE TABLE Event (
ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
Days VARCHAR(30) NOT NULL,
Hours VARCHAR(30) NOT NULL,
Cities VARCHAR(50) NOT NULL,
ATypes VARCHAR(50) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Event created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}
*/

/* $sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;

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

    $sql = "INSERT INTO MyGuests (firstname, lastname, email)
    VALUES ('John', 'Doe', 'john@example.com')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
*/

/*
    $sql = "INSERT INTO MyGuests (firstname, lastname, email)
    VALUES ('Apple', 'Chrome', 'apple@example.com')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    //Get Last ID
    $last_id = $conn->insert_id;
    echo "New record created successfully. Last inserted ID is: " . $last_id;
*/
/*
    //Insert Multiple
    $sql = "INSERT INTO Event (Days, Hours, Cities, ATypes)
    VALUES ('3','15','SM','Football');";
    $sql .= "INSERT INTO Event (Days, Hours, Cities, ATypes)
    VALUES ('4', '14', 'SF','Tennis');";
    $sql .= "INSERT INTO Event (Days, Hours, Cities, ATypes)
    VALUES ('5', '16', 'SC','Basketball')";

    if ($conn->multi_query($sql) === TRUE) {
        echo "New records created successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
*/

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

/*
$conn->query("ALTER TABLE Event DROP PRIMARY KEY");
echo "so far good <br>";
*/
//SELECT and DISPLAY
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
