<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Search</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
            require("connect.php");
            
            if(isset($_GET["searchGame"]))
            {
                $search = strtolower(trim($_GET["searchGame"]));

                $q = "SELECT id FROM game WHERE title LIKE ?";
                $stmt = $connection->prepare($q);

                $stmt->bind_param("s", $search);
                $stmt->execute();
                $result = $stmt->get_result();

                if($result->num_rows > 0)
                {
                    $row = $result->fetch_assoc();
                    $id = $row['id'];
                    header("Location:gameDesc.php?id=$id");
                }
                else
                {
                    echo "<h3><a href='HomePage.php'>Game not Found.</a></h3>";
                }
            }
        ?>
    </body>
</html>