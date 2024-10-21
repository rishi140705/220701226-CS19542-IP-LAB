<?php
$Name_of_the_passenger = $_GET['n1'];
$Age = $_GET['n2'];
$Selected_meal = $_GET['n3'];


$conn = new mysqli("localhost", "root", "", "airline");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("INSERT INTO passenger_details (Name_of_the_passenger, Age, Selected_meal) VALUES (?, ?, ?)");
$stmt->bind_param("sis", $Name_of_the_passenger, $Age, $Selected_meal);
if ($stmt->execute() === TRUE) {
    echo "<h2>Your Flight Ticket is Booked Successfully</h2>";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();

?>
