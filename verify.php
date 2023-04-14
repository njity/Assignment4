<?php
    
    function verify($pArray) {
        include "db.php";

        $fName = $pArray["firstName"];
        $lName = $pArray["lastName"];
        $id = $pArray["id"];
        $pass = $pArray["password"];

        $ec = isset($pArray["emailConfirm"]);
        $email = $ec ? $pArray["email"] : "";

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
                alert(\"Receptionist Not Found\");
                window.location.replace(\"login.html\");
            </script>";
        }
    }

?>