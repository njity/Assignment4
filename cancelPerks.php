<!DOCTYPE html>
<html>
    <head>
        <title>HTH Perk Cancellation</title>  
        <link rel="stylesheet" href="hth.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include "db.php";
            
            $id = $_POST["id"];


            $query = "SELECT * FROM reservation WHERE stayId = '$id'";

            $result = $con->query($query);

            if (!$result) {
                die("Error executing query: ($con->errno) $con->error<br>SQL = $query");
            }

            if ($result->num_rows == 0) {
                echo "
                <script>
                    alert(\"No reservation found. Please input the correct values.\");
                    window.location.replace(\"requestPerks.php\");
                </script>";
            } else {
                echo "
                <script>
                    if (!confirm(\"Are you sure you want to cancel this perk?\")) {
                        window.location.replace(\"requestPerks.php\");
                    }
                </script>";

                $row = $result->fetch_assoc();

                $poID = $row["id"];

                $query = "DELETE FROM perks WHERE poID = '$poID'";

                $result = $con->query($query);

                if (!$result) {
                    die("Error executing query: ($con->errno) $con->error<br>SQL = $query");
                }

                echo "
                <script>
                    alert(\"Perks Have Been Cancelled.\");
                    window.location.replace(\"login.php\");
                </script>";
            }

            
        }
    ?>

    <body>
        <section class="form">
            <h1>Cancel Perks</h1>
            
            <form action="cancelPerks.php" method="POST" id="cancelPerksForm">

                <div>
                    <input type="text" id="id" name="id" placeholder="Reservation ID" required>
                    <span class="required" title="Required Field"></span>
                </div>
                

                <div>
                    <button type="submit" id="submit">Submit</button>
                </div>
            </form>
        </section>
    </body>
</html>