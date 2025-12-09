<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Midterm Project</title>
        <link rel="stylesheet" href="style.css">

        <?php
        require("connect.php");
        $q = "SELECT * FROM `game`";
        $result = $connection->query($q);
        ?>

    </head>
    <body>
        <!--Navigation Bar-->
        <ul id="navBar">
            <li><a href="HomePage.php">Home</a></li>
            <li style="text-align:center;">Game Library, David Zuniga(812015)</li>
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

        <!--Reads from database and display games in gridlike fashion-->
        <div id = "grid" class = "grid">
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="cell">
                <a href="RemoveGame.php?id=<?php echo $row['id']; ?>">Delete Game</a>
                <a href = "gameDesc.php?id=<?php echo $row['id']; ?>">
                <img src="<?php echo $row['image']; ?>">
                <h3><?php echo $row['title']; ?></h3>
            </a>
            </div>
            <?php endwhile; ?>
        </div>
        
    </body>
</html>