<!DOCTYPE html>
<html>
<head>
    <title>Passenger Details</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            padding: 20px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .grid-item {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            margin: 15px;
            padding: 20px;
            width: 250px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .grid-item h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .grid-item p {
            margin: 5px 0;
            color: #555;
        }

        .grid-item span {
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Passenger Details</h2>

<div class="container">
    <?php
    // Database connection
    $servername = "localhost"; // Adjust host if necessary
    $username = "root";        // Database username
    $password = "";            // Database password
    $dbname = "airline";       // Database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch all passengers from the 'passenger' table
    $sql = "SELECT name, age, meal_option FROM passenger";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Loop through each passenger and display in a grid item
        while($row = $result->fetch_assoc()) {
            echo '<div class="grid-item">';
            echo '<h3>Passenger: ' . $row['name'] . '</h3>';
            echo '<p><span>Age:</span> ' . $row['age'] . '</p>';
            echo '<p><span>Meal Option:</span> ' . $row['meal_option'] . '</p>';
            echo '<p><span>Flight ID:</span> ' . $row['flight_id'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p style="text-align:center;">No passengers found.</p>';
    }

    // Close the database connection
    $conn->close();
    ?>
</div>

</body>
</html>
