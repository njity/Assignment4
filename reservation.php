<!DOCTYPE html>
<html>
    <head>
        <title>HTH Reservation</title>  
        <link rel="stylesheet" href="hth.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>

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
                        firstName = '$fName',
                        lastName = '$lName',
                        id = '$id'
            ";

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
            <h1>Reservation Form</h1>
            
            <form action="reservation.php" method="POST" id="loginForm">
                <div>
                    <input type="date" id="checkOut" name="checkIn" placeholder="Check In Date">
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="date" id="checkOut" name="checkOut" placeholder="Check Out Date">
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="text" id="id" name="id" placeholder="Pet Owner ID" >
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="text" id="address" name="address" placeholder="Address">
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="text" id="phone" name="phone" placeholder="Phone Number">
                    <span class="required" title="Required Field"></span>
                </div>

                

                <div>
                    <button type="submit" id="submit">Submit</button>
                </div>
            </form>
        </section>
    </body>




</html>