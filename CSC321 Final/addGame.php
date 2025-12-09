
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add game</title>
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


        <form method="post">
            <label>Title:</label><br>
            <input type="text" name="title" required><br><br>

            <label>Description:</label><br>
            <textarea name="description" required></textarea><br><br>

            <label>Image URL:</label><br>
            <input type="text" name="image" required><br><br>

            <input type="submit" value="Submit">
        </form>

        <?php 
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            $title = $_POST["title"];
            $description = $_POST["description"];
            $image = $_POST["image"];

            //Adds game to database
            $q = "INSERT INTO game (title, description, image) VALUES (?, ?, ?)";
            $stmt = $connection->prepare($q);
            $stmt->bind_param("sss", $title, $description, $image);

            if($stmt->execute())
            {
                echo "<p>Game added!</p>";
            }
            else
            {
                echo "<p>Error when Adding Game</p>";
            }
        }

        ?>
</body>
</html>