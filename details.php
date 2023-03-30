<?php
$conn = mysqli_connect('localhost', 't3dd', '', 'pizza_db');
if (!$conn) {
    echo "Connection Error " . mysqli_connect_error();
}
if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM pizzas WHERE id=$id_to_delete";

    if (mysqli_query($conn, $sql)) {
        header('Location:index.php');
    }
}
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM pizzas WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $pizza = mysqli_fetch_assoc($result);

    //free memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Page</title>
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
    <div class="container center">
        <?php if ($pizza) : ?>
            <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
            <p>Created By: <?php echo htmlspecialchars($pizza['email']); ?></p>
            <p>Created on: <?php echo date($pizza['created_at']); ?></p>
            <h5>Ingredients:</h5>
            <p><?php echo htmlspecialchars($pizza['ingredients']) ?></p>

            <form action="details.php" method="POST">
                <input type="hidden" value="<?php echo $pizza['id']; ?>" name="id_to_delete">
                <input type="submit" value="Delete" name="delete" class="btn brand z-depth-0">
            </form>
        <?php else : ?>
            <h4>No such Pizza exists!</h4>
        <?php endif; ?>
    </div>

    <footer class="section">
        <div class="center grey-text">CopyRight 2023 Ted Blair</div>
    </footer>

</body>

</html>