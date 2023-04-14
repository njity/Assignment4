<!DOCTYPE html>
<html>
    <head>
        <title>HTH Login</title>  
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

    <body class="content">

        <?php
            include "db.php";

            session_start();

            $id = $_SESSION["rID"];

            $query = "SELECT 
                        receptionist.firstName,
                        receptionist.lastName,
                        receptionist.id,
                        receptionist.phone,
                        receptionist.email,
                        petOwner.firstName,
                        petOwner.lastName,
                        petOwner.id,
                        reservation.checkIn,
                        reservation.checkOut,
                        reservation.address,
                        reservation.phone,
                        reservation.pet,
                        reservation.stayID,
                        perks.perks,
                        perks.perkID
                    FROM receptionist 
                    JOIN perks ON perks.recID = receptionist.id AND receptionist.id = '$id' 
                    JOIN petOwner ON perks.poID = petOwner.id
                    JOIN reservation ON petOwner.id = reservation.id";

            $result = $con->query($query);

            if (!$result) {
                die("Error executing query: ($con->errno) $con->error<br>SQL = $query");
            }
        
        
        
            echo "<table> 
                    <tr> 
                        <th>Receptionist First Name</th>
                        <th>Receptionist Last Name</th>
                        <th>Receptionist ID</th>
                        <th>Receptionist Phone Number</th>
                        <th>Receptionist Email Address</th>
                        <th>Pet Owner First Name</th>
                        <th>Pet Owner Last Name</th>
                        <th>Pet Owner ID</th>
                        <th>Check In Date</th>
                        <th>Check Out Date</th>
                        <th>Pet Owner Address</th>
                        <th>Pet Owner Phone</th>
                        <th>Pet</th>
                        <th>Stay ID</th>
                        <th>Perks</th>
                        <th>Perks ID</th>
                    </tr>";
        
            while ($row = $result->fetch_row()) {

                echo "<tr>";
                for ($i = 0; $i < count($row); $i++) {
                    echo "<td> $row[$i] </td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        
        ?>  
    

    </body>


</html>



