<!DOCTYPE html>
<html>
    <head>
        <title>HTH Reservation</title>  
        <link rel="stylesheet" href="hth.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <script src="reservation.js"></script>
    </head>

    <ul>
        <li><a href="home.html">Home</a></li>
        <li><a href="searchAccount.php">Search Account</a></li>
        <li><a href="verifyOwner.php">Book Reservation</a></li>
        <li><a href="requestPerks.php">Request Perks</a></li>
        <li><a href="updatePerks.php">Update Perks</a></li>
        <li><a href="cancelRes.php">Cancel Reservation</a></li>
        <li><a href="cancelPerks.php">Create New Accounts</a></li>
    </ul>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include "db.php";

            session_start();
            
            $checkIn = $_POST["checkIn"];
            $checkOut = $_POST["checkOut"];
            $address = $_POST["address"];
            $phone = $_POST["phone"];
            $pet = $_POST["pet"];

            $id = $_SESSION["poID"];

            $unique = false;
            $num = 4;

            while (!$unique) {
                $num = rand(1, 999999);

                $query = "SELECT * FROM reservation WHERE stayId = '$num'";
                
                $result = $con->query($query);

                if (!$result) {
                    die("Error executing query: ($con->errno) $con->error<br>SQL = $query");
                }
    
                if ($result->num_rows == 0) {
                    $unique = true;
                }
            }



            $query = "INSERT INTO reservation
                VALUES ('$pet', '$address', '$phone', '$checkIn', '$checkOut', '$id', '$num')
            ";

            $result = $con->query($query);

            if (!$result) {
                die("Error executing query: ($con->errno) $con->error<br>SQL = $query");
            } else {
                echo "
                <script>
                    alert(\"Reservation Has Been Booked\");
                    window.location.replace(\"login.php\");
                </script>";
            }

            
        }
    ?>

    <body>
        <section class="form">
            <h1>Reservation Form</h1>
            
            <form action="reservation.php" method="POST" id="reservationForm">
                <div>
                    <input type="date" id="checkOut" name="checkIn" placeholder="Check In Date">
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="date" id="checkOut" name="checkOut" placeholder="Check Out Date" required>
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="text" id="address" name="address" placeholder="Address" required>
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="text" id="phone" name="phone" placeholder="Phone Number" required>
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="text" id="pet" name="pet" placeholder="Pet Name / Pet Type" required>
                    <span class="required" title="Required Field"></span>
                </div>
                

                <div>
                    <button type="submit" id="submit">Submit</button>
                </div>
            </form>
        </section>
    </body>




</html>