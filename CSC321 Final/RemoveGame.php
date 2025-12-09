


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Remove game</title>
    <link rel="stylesheet" href="style.css">

    <?php
        require("connect.php");
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
        if(isset($_GET["id"]))
        {
            $id = $_GET["id"];

            $q = "DELETE FROM game WHERE id = ?";
            $stmt = $connection->prepare($q);
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }
        header("Location: HomePage.php");
        ?>
</body>
</html>