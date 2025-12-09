
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign in</title>
    <link rel="stylesheet" href="style.css">
    <?php
        require("connect.php");
        session_start();
    ?>
</head>
<body>
    <!--Navigation Bar-->
        <ul id="navBar">
            <li><a href="HomePage.php">Home</a></li>
            <li style="float:right"><a class="account" href="signIn.php">Account</a></li>
            <li style="float:right;"><a href="addGame.php">Add Game</a></li>
            <!--Search Bar-->
            <li style="float:right; border:none;">
                <form id="search" method="get" action="search.php" style="margin:0; padding:10px;">
                    <input type="text" name="searchGame" placeholder="Search for games..." required>
                    <button type="submit">Search</button>
                </form>
            </li>
        </ul>
    
    <?php 
    $error = "";
    
    //Regex
    $emailRegex = '/[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/';
    $unameRegex = '/^[a-zA-Z0-9._-]{3,15}$/';
    $passRegex = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,15}$/';

    // Initially hide logout button
    echo "<script>document.getElementById(\"logout\").style.display=\"none\";</script>";

    function SignupForm($error = "")
    {
        echo '
            <form method="post">
                <div class="error">'. $error . '</div> 
                <label for="email">Email:</label><br>
                <input type="text" id="email" name="email" required><br>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br>

                <input type="submit" value="Submit">
            </form>';
    }

    // Only show logout button if logged in
    if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
        echo '<form id="logout" action="signOut.php" method="post">
                <input type="submit" value="Sign Out">
              </form>';
    }
    // Handle form submission
    else 
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") 
        {
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["password"] = $_POST["password"];
            $_SESSION["login"] = false;

            $email = $_SESSION["email"];
            $password = $_SESSION["password"];

                if (!preg_match($emailRegex, $email)) 
                {
                    $error = "*Invalid email</span>";
                    SignupForm($error);
                    exit();
                }
                if (!preg_match($passRegex, $password)) 
                {
                    $error = "*Invalid password: Must be 8–15 characters long, include a capital letter and a number";
                    SignupForm($error);
                    exit();
                } 

                // checks if there is user in database
                $q = "SELECT * FROM user WHERE email = ?";
                $stmt = $connection->prepare($q);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                // If the user exists in database
                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();

                    //checks to see if password matches
                    if ($user['password'] === $password) 
                    {
                        $_SESSION["login"] = true;
                        $_SESSION["user_id"] = $user["id"];
                        $_SESSION["email"] = $email;

                        header("Location: HomePage.php");
                        exit();
                    } 
                    else 
                    {
                        SignupForm("*Incorrect password");
                        exit();
                    }
                }
                // if the user is not in the database, add them to the database
                $q = "INSERT INTO user (email, password) VALUES (?, ?)";
                $stmt = $connection->prepare($q);
                $stmt->bind_param("ss", $email, $password);

                if ($stmt->execute()) {
                    $_SESSION["login"] = true;
                    $_SESSION["email"] = $email;

                    header("Location: HomePage.php");
                    exit();
                } else {
                    SignupForm("*Error creating account");
                    exit();
                }
        }
        else
        {
            SignupForm($error);
        } 
    }

    ?>
</body>
</html>