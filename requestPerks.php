<!DOCTYPE html>
<html>
    <head>
        <title>HTH Perk Request</title>  
        <link rel="stylesheet" href="hth.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
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
            
           

            $perks = $_POST["perks"];
            $resID = $_POST["id"];
            
            $query = "SELECT * FROM reservation WHERE stayId = '$resID'";

            $result = $con->query($query);

            if (!$result) {
                die("Error executing query: ($con->errno) $con->error<br>SQL = $query");
            }

            if ($result->num_rows == 0) {
                echo "
                <script>
                    alert(\"No reservation found. Please make a reservation or input the correct values.\");
                    window.location.replace(\"requestPerks.php\");
                </script>";
            } else {
                echo "
                <script>
                    if (!confirm(\"Are you sure you want to request perks for your pet?\")) {
                        window.location.replace(\"requestPerks.php\");
                    }
                </script>";

                $row = $result->fetch_assoc();

                $poID = $row["id"];


                $unique = false;
                $num = 4;

                while (!$unique) {
                    $num = rand(1, 999999);

                    $query = "SELECT * FROM perks WHERE perkID = '$num'";

                    $result = $con->query($query);

                    if (!$result) {
                        die("Error executing query: ($con->errno) $con->error<br>SQL = $query");
                    }
                
                    if ($result->num_rows == 0) {
                        $unique = true;
                    }
                }

                session_start();

                $recID = $_SESSION["rID"];

                $query = "INSERT INTO perks VALUES ('$perks', '$recID', '$poID',  '$num')";
                
                $result = $con->query($query);

                if (!$result) {
                    die("Error executing query: ($con->errno) $con->error<br>SQL = $query");
                }

                echo "
                <script>
                    alert(\"Perks Added. Your Perk ID is $num\");
                    window.location.replace(\"login.php\");
                </script>";
                
                
            }

        }
    ?>


    <body>
        <section class="form">
            <h1>Request Perks</h1>
            
            <form action="requestPerks.php" method="POST" id="perksForm">

                <div>
                    <input type="text" id="perks" name="perks" placeholder="Request Perks">
                    <span class="required" title="Required Field"></span>
                </div>
    
                <div>
                    <input type="text" id="id" name="id" placeholder="Pet Reservation ID">
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <button type="submit" id="submit">Submit</button>
                </div>

            </form>
        </section>
    </body>



</html>