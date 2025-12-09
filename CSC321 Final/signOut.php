<!DOCTYPE html>
<html lang="en">
<head>
    <title>Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php 
        //Have to start session in order to destroy it and unset session variables
        session_start(); 

        //Unsets session variables
        session_unset();

        //Destroys session
        session_destroy();

        //Redirects to signIn.php file
        header("Location: signIn.php")
    ?>
</body>
</html>