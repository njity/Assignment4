<!DOCTYPE html>
<html>
    <head>
        <title>HTH Verification</title>  
        <link rel="stylesheet" href="hth.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
        }
    ?>

    <body>
        <section class="form">
            <h1>Pet Owner Verification Form</h1>
            
            <form action="verifyOwner.php" method="POST" id="loginForm">
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