<!DOCTYPE html>
<html>
    <head>
        <title>HTH Perk Update</title>  
        <link rel="stylesheet" href="hth.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include "db.php";
            
           

            $perks = $_POST["perks"];
            $resID = $_POST["id"];
            $perkID = $_POST["idPerk"];
            
            $query = "SELECT * FROM reservation WHERE stayId = '$resID'";

            $result = $con->query($query);

            if (!$result) {
                die("Error executing query: ($con->errno) $con->error<br>SQL = $query");
            }

            if ($result->num_rows == 0) {
                echo "
                <script>
                    alert(\"No reservation found. Please make a reservation or input the correct values.\");
                    window.location.replace(\"updatePerks.php\");
                </script>";
            } else {
                

                $row = $result->fetch_assoc();

                $poID = $row["id"];

                $query = "SELECT * FROM perks WHERE perkID = '$perkID' AND poID = '$poID'";

                $result = $con->query($query);

                if (!$result) {
                    die("Error executing query: ($con->errno) $con->error<br>SQL = $query");
                }

                if ($result->num_rows == 0) {
                    echo "
                    <script>
                        alert(\"No matching perk ID. Perk ID is incorrect or has never been requested.\");
                    </script>";
                    header("Location: updatePerks.php");
                } else {
                    echo "
                    <script>
                        if (!confirm(\"Are you sure you want to update perks for your pet?\")) {
                            window.location.replace(\"updatePerks.php\");
                        }
                    </script>";

                    $query = "UPDATE perks SET perks = '$perks' WHERE perkID = '$perkID'";
                
                    $result = $con->query($query);
    
                    if (!$result) {
                        die("Error executing query: ($con->errno) $con->error<br>SQL = $query");
                    }
    
                    echo "
                    <script>
                        alert(\"Perks Updated.\");
                        window.location.replace(\"login.php\");
                    </script>";
                }
            }

        }
    ?>


    <body>
        <section class="form">
            <h1>Update Perks</h1>
            
            <form action="updatePerks.php" method="POST" id="updatePerks">

                <div>
                    <input type="text" id="perks" name="perks" placeholder="Updated Perk Requests">
                    <span class="required" title="Required Field"></span>
                </div>
    
                <div>
                    <input type="text" id="id" name="id" placeholder="Pet Reservation ID">
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="text" id="idPerk" name="idPerk" placeholder="Pet Perk ID">
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <button type="submit" id="submit">Submit</button>
                </div>

            </form>
        </section>
    </body>



</html>