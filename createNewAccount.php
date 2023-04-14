<!DOCTYPE html>
<html>
    <head>
        <title>HTH Create New Account</title>  
        <link rel="stylesheet" href="hth.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>

    <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include "db.php";

            $fName = $_POST["firstName"];
            $lName = $_POST["lastName"];
            $id = $_POST["id"];

            $query = "SELECT *
                      FROM petOwner
                      WHERE
                        (firstName = '$fName' AND
                        lastName = '$lName') OR
                        id = '$id'
            ";

            $result = $con->query($query);

            if (!$result) {
                die("Error executing query: ($con->errno) $con->error<br>SQL = $query");
            }

            if ($result->num_rows == 0) {
                $query = "INSERT INTO petOwner VALUES ('$fName', '$lName', '$id')";
                $result = $con->query($query);
                if (!$result) {
                    die("Error executing query: ($con->errno) $con->error<br>SQL = $query");
                }
                echo "
                <script>
                    alert(\"Pet Owner Account Created\");
                    window.location.replace(\"login.php\");
                </script>";

            } else {
                echo "
                <script>
                    alert(\"Pet Owner Already Has an Account\");
                    window.location.replace(\"createNewAccount.php\");
                </script>";
            }
        }
            
            
        
    ?>


    <body>
        <section class="form">
            <h1>Happy Tails Hotel</h1>
            
            <form action="createNewAccount.php" method="POST" id="createNewAccount">

                <div>
                    <input type="text" id="firstName" name="firstName" placeholder="First Name">
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="text" id="lastName" name="lastName" placeholder="Last Name">
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="text" id="id" name="id" placeholder="ID Number">
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <button type="submit" id="submit">Submit</button>
                </div>
                
            </form>
        </section>
        


    </body>


</html>