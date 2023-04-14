<!DOCTYPE html>
<html>
    <head>
        <title>HTH Verification</title>  
        <link rel="stylesheet" href="hth.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <script src="verifyOwner.js"></script>
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

            $fName = $_POST["firstName"];
            $lName = $_POST["lastName"];
            $id = $_POST["id"];

            $query = "SELECT
                        *
                      FROM petOwner
                      WHERE
                        firstName = '$fName' AND
                        lastName = '$lName' AND
                        id = '$id'
            ";

            $result = $con->query($query);

            if (!$result) {
                die("Error executing query: ($con->errno) $con->error<br>SQL = $query");
            }

            if ($result->num_rows == 0) {
                echo "
                <script>
                    alert(\"Pet Owner Not Found. Recheck data or create a new pet owner account.\");
                    window.location.replace(\"verifyOwner.php\");
                </script>";
            } else {
                session_start();
                $_SESSION["poFN"] = $fName; 
                $_SESSION["poLN"] = $lName; 
                $_SESSION["poID"] = $id; 
                header("Location: reservation.php");
            }
        }
    ?>

    <body>
        <section class="form">
            <h1>Pet Owner Verification Form</h1>
            
            <form action="verifyOwner.php" method="POST" id="verificationForm">
                <div>
                    <input type="text" id="firstName" name="firstName" placeholder="First Name">
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="text" id="lastName" name="lastName" placeholder="Last Name">
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="text" id="id" name="id" placeholder="Pet Owner ID" >
                    <span class="required" title="Required Field"></span>
                </div>

                

                <div>
                    <button type="submit" id="submit">Submit</button>
                </div>
            </form>
        </section>
    </body>




</html>