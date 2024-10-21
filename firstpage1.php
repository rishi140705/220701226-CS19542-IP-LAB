<!DOCTYPE html>
<html>
    <head>
        <title>firstpage</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            .body{
                background-color: #f0f0f0;
            }
            .content{
                display:flex;
                font-size:medium;
            }
            .left_section{
                width: 50%;
            }
            .right_section{
                width: 50%;
            }
            .right_section img{
                display: flex;
                width:100%;
                max-width: 500px;
                border-radius: 10px;
                align-items: right_section;
                margin-left: 50px;
            }
            .flight{
                font-size: 16px;

            }
            .flight_box{
                padding: 10px;
                border: 1px solid black;
                border-radius: 25px;
                width:350px;
                font-size:16px;
                margin-right: 50px;
                margin-left: 50px;

            }
            .submit{
                font-size: large;
                background-color: #d74c4c;
                color:white;
                border-width: 0px;
                padding-left:50px;
                padding-right: 50px;
                padding-top: 15px;
                padding-bottom: 15px;
                margin-left: 45%;
            }
            .box{
                width: 100%;
                display: flex;
                flex-direction: row;
                margin-top: 50px;
                margin-bottom: 50px;
            }
            .box1{
                background-color: #d74c4c;
                display: flex;
                padding: 15px;
                justify-content: center;
                text-align: right;
                color: white;
            }
            .select{
                width:100%;
                height: 100px;
                display:flex;
                justify-content: space-between;
            }
            .note{
                margin-left: 15px;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body class="body">
        <div class="box1">
        <header><nav><h2>HOME</h2>
        </nav>
        </header>
        </div>
        <div class="box">
        <div class="left_section">
        <div class="note"><h2>Notes:</h2></div>
        <div class="content">
            <ul>
                <li>The Passenger Carring Things (or) Bags Should not be more than 75KG </li><br>
                <li>If it is more Than 75KG You Should Pay Excess Amount for 1KG it is $100</li><br>
                <li>The Passenger Should be There in the Airport Before 1 Hour</li><br>
                <li>You Should Clear All The Verification Process </li><br>
                <li>All Other Information Will be Given By the Flight Coordinators About Your Safety Measure</li><br>
                <li>Selected Food will Be Distributed At Perticular Time</li>
            </ul>
        </div>
        </div>
        <div class="right_section">
            <img src="f.jpg" alt=" flight image">
        </div>
        </div>
        <div class="s_airport"><h2>Select Airport for Flight</h2></div>
        
        <div class="select">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "airline";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT airport_id, airport_name, location FROM airports";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<form method='post' action='display_airport_details.php'>";
                echo "<label class='fs-5' for='departure_airport'>Departure Airport:</label>";
                echo "<select name='departure_airport' id='departure_airport' class='flight_box'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['airport_id'] . "'>" . $row['airport_name'] . " - " . $row['location'] . "</option>";
                }
                echo "</select>";
                $result->data_seek(0);
                echo "<label class='fs-5'for='arrival_airport'>Arrival Airport:</label>";
                echo "<select name='arrival_airport' id='arrival_airport' class='flight_box'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['airport_id'] . "'>" . $row['airport_name'] . " - " . $row['location'] . "</option>";
                }
                echo "</select><br><br>";
                echo "<input type='submit' value='Search Flight' class='submit'>";
                echo "</form>";
            } else {
                echo "No airports available.";
            }
            $conn->close();
            ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>        
    </body>
</html>