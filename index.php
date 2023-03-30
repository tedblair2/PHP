<?php
$conn = mysqli_connect('localhost', 't3dd', '', 'pizza_db');

if (!$conn) {
    echo "Connection Error " . mysqli_connect_error();
}

$sql = 'SELECT title,ingredients,id FROM pizzas ORDER BY created_at';

//make query and get results
$query = mysqli_query($conn, $sql);

//fetch results as an associative array
$pizzas = mysqli_fetch_all($query, MYSQLI_ASSOC);

//free memory
mysqli_free_result($query);

//close connection
mysqli_close($conn);

//using sessions
// session_start();
// echo $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Php</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">First PHP</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li><a href="add.php" class="btn brand z-depth-0">Add a Pizza</a></li>
            </ul>
        </div>
    </nav>
    <h4 class="center grey-text">Pizzas!</h4>
    <div class="container">
        <div class="row">
            <?php foreach ($pizzas as $pizza) { ?>
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($pizza['title']) ?></h6>
                            <div>
                                <ul>
                                    <?php foreach (explode(',', $pizza['ingredients']) as $item) { ?>
                                        <li><?php echo htmlspecialchars($item) ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="card-action right-align">
                            <a href="details.php?id=<?php echo $pizza['id'] ?>" class="brand-text">More Info</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <footer class="section">
        <div class="center grey-text">CopyRight 2023 Ted Blair</div>
    </footer>
</body>

</html>