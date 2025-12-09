<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Game Description</title>
        <link rel="stylesheet" href="style.css">

        <?php
        require("connect.php");
        session_start();
        $gameId = intval($_GET['id']);

        //gets game data from database
        $q = "SELECT * FROM `game` WHERE id = ?";
        $stmt = $connection->prepare($q);
        $stmt->bind_param("i", $gameId);
        $stmt->execute();
        $result = $stmt->get_result();
        $game = $result->fetch_assoc();

        //User can only upload review if signed in
        if(isset($_SESSION["login"]) && $_SESSION["login"] === true)
        {
            //Adds review to database
            if ($_SERVER['REQUEST_METHOD'] === 'POST') 
            {
                $review = $_POST['review'];
                $stmt = $connection->prepare("INSERT INTO review (game_id, user_id, review_text) VALUES (?, ?, ?)");
                $stmt->bind_param("iis", $gameId, $_SESSION["user_id"], $review);
                $stmt->execute();
            }
        }
        else
        {
            echo "<h2><br>You must be <br>signed in to <br>leave a review.</h2>";
        }

        //Gets review from database
        $stmt = $connection->prepare("SELECT * FROM review WHERE game_id = ?");
        $stmt->bind_param("i", $gameId);
        $stmt->execute();
        $reviewList = $stmt->get_result();
        //echo $gameId;
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

        <!--Searches database with the provided id and displays the information from the database-->
        <div id = "description">
            <h1><?php echo $game['title']?></h1> 
            <img src ="<?php echo $game['image']?>" style="width:400px"> 
            <p><?php echo $game['description']?></p>

            <!--Form for Reviews-->
            <div><h3>Leave a Review</h3>
            <form method="POST">
                <textarea name="review" placeholder="Write review here..." rows="5" required></textarea><br>
                <button type="submit">Submit</button>
            </form>
            </div>

            <h4>Reviews:</h4>
            <ul>
                <?php while ($row = $reviewList->fetch_assoc()): ?>
                    <li>
                        <?php echo $row['review_text']; ?>
                    </li>
                <?php endwhile; ?>
            </ul>

        </div>
    
    </body>
</html>