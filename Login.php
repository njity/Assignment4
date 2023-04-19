<!DOCTYPE html>
<html>
    <head>
        <title>HTH Login</title>  
        <link rel="stylesheet" href="hth.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <script src="login.js"></script>
    </head>

    <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include "db.php";

            session_destroy();

            $fName = $_POST["firstName"];
            $lName = $_POST["lastName"];
            $id = $_POST["id"];
            $pass = $_POST["password"];

            $ec = isset($_POST["emailConfirm"]);
            $email = $ec ? $_POST["email"] : "";

            $eq = $ec ? " AND email = '$email' " : "";

            $query = "SELECT *
                      FROM receptionist
                      WHERE
                        firstName = '$fName' AND
                        lastName = '$lName' AND
                        id = '$id' AND
                        password = '$pass'
                        $eq
            ";

            $result = $con->query($query);

            if (!$result) {
                die("Error executing query: ($con->errno) $con->error<br>SQL = $query");
            }

            if ($result->num_rows == 0) {
                echo "
                <script>
                    alert(\"Receptionist Account Not Found\");
                    window.location.replace(\"login.php\");
                </script>";
            } else {
                session_start();

                $_SESSION["rFN"] = $fName;
                $_SESSION["rLN"] = $lName;
                $_SESSION["rID"] = $id;
                $_SESSION["rPASS"] = $id;
                
                if ($ec) {
                    $_SESSION["rEMAIL"] = $email;
                }

                switch ($_POST["transaction"]) {
                    case "search":
                        header("Location: searchAccount.php");
                        break;
                    case "bookStay":
                        header("Location: verifyOwner.php");
                        break;
                    case "cancelStay":
                        header("Location: cancelRes.php");
                        break;
                    case "request":
                        header("Location: requestPerks.php");
                        break;
                    case "cancelPerks":
                        header("Location: cancelPerks.php");
                        break;
                    case "changePerks":
                        header("Location: updatePerks.php");
                        break;
                    case "createAccount":
                        header("Location: createNewAccount.php");
                        break;
                }
            }
            
            
        }
        
    ?>


    <body>
        <section class="form">
            <h1>Happy Tails Hotel</h1>
            
            <form action="login.php" method="POST" id="loginForm">

                <div>
                    <input type="text" id="firstName" name="firstName" placeholder="First Name">
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="text" id="lastName" name="lastName" placeholder="Last Name">
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="password" id="password" name="password" placeholder="Password" >
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="text" id="id" name="id" placeholder="ID Number">
                    <span class="required" title="Required Field"></span>
                </div>

                <div>
                    <input type="text" id="phone" name="phone" placeholder="Phone Number">
                    <span class="required" title="Required Field"></span>
                </div>
                
                <div>
                    <input type="text" id="email" name="email" placeholder="Email Address" >
                    <span id="emailreq" title="Required Field"></span>
                </div>

                <div>
                    <input type="checkbox" id="emailConfirm" name="emailConfirm">
                    <label for="emailConfirm">Send Email Confirmation:</label>
                </div>

                <div class="transaction">
                    <select name="transaction" id="transaction" required >
                        
                        <option id ="default" value="default" disabled selected>Select Transation</option>
                        <option value="search">Search Account</option>
                        <option value="bookStay">Book a Stay</option>
                        <option value="cancelStay">Cancel a Stay</option>
                        <option value="request">Request Perks</option>
                        <option value="cancelPerks">Cancel Perks</option>
                        <option value="changePerks">Change Perks</option>
                        <option value="createAccount">Create a New Account</option>
                    </select>
                    <span class="required" title="Required Field"></span>

                </div>

                <div>
                    <button type="submit" id="submit">Submit</button>
                    <button type="button" id="reset">Reset</button>
                </div>
                
                
                
            </form>
        </section>
        


    </body>


</html>