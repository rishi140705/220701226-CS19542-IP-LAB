<!DOCTYPE html>
<html>
<head>
    <title>Flight Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .bg_login{
            background-image: url("k.jpg");
        height: 100%;
        background-position: center;
        background-size: cover;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .grid-item {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer; 
            transition: transform 0.3s;
        }
        .grid-item:hover {
            transform: translateY(-5px);
            background-color: #e0e0e0;
        }
        .grid-item h3 {
            margin-top: 0;
            font-size: 1.2em;
            color: #333;
        }
        .flight-detail {
            margin-bottom: 10px;
            font-size: 1em;
        }
        .label {
            font-weight: bold;
        }
        .view-details {
            display: inline-block;
            padding: 10px 15px;
            background-color:  #d74c4c;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .view-details:hover {
            background-color:#007bff;
        }
        .box1{
                background-color: #d74c4c;
                display: flex;
                padding: 15px;
                justify-content: center;
                color: white;
        }
    </style>
</head>
<body>
<div class="box1">
<h2 class="text-center">Flight Details</h2>
</div>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airline";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['departure_airport']) && isset($_POST['arrival_airport'])) {
        $departure_airport = $_POST['departure_airport'];
        $arrival_airport = $_POST['arrival_airport'];
        $sql = "SELECT flight_number, departure_date, departure_time, available_seats
                FROM flight_details
                WHERE departure_airport = ? AND arrival_airport = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $departure_airport, $arrival_airport); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div class='grid-container'>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='grid-item'>";
                echo "<h3>Flight: " . $row['flight_number'] . "</h3>";
                echo "<div class='flight-detail'><span class='label'>Departure Date: </span>" . $row['departure_date'] . "</div>";
                echo "<div class='flight-detail'><span class='label'>Departure Time: </span>" . $row['departure_time'] . "</div>";
                echo "<div class='flight-detail'><span class='label'>Available Seats: </span>" . $row['available_seats'] . "</div>";
                echo "<a class='view-details' href='passenger.html?flight_number=" . $row['flight_number'] . "'>Book Tickets</a>";
                echo "</div>";
            }

            echo "</div>";
        } else {
            echo "No flights found for the selected airports.";
        }

        $stmt->close();
    } else {
        echo "Please select both a departure and an arrival airport.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>        
</body>
</html>
