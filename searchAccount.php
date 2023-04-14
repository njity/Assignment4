<?php
    include "db.php";
    include "verify.php";

    verify($_POST);

    $id = $_POST["id"];

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