<?php
$errors = ['email' => '', 'title' => '', 'ingredients' => ''];
$email = $title = $ingredients = '';

$conn = mysqli_connect('localhost', 't3dd', '', 'pizza_db');

if (!$conn) {
    echo "Connection Error " . mysqli_connect_error();
}
if (isset($_POST['submit'])) {
    // echo htmlspecialchars($_POST['email']); //we use the htmlspecialcharacters to prevent XSS attacks
    // echo htmlspecialchars($_POST['title']);
    // echo htmlspecialchars($_POST['ingredients']);

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email cannot be empty';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Provide valid email address';
        }
    }
    if (empty($_POST['title'])) {
        $errors['title'] = 'Title cannot be empty';
    } else {
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = 'Provide valid title';
        }
    }
    if (empty($_POST['ingredients'])) {
        $errors['ingredients'] = "Ingredients cannot be empty";
    } else {
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = "Ingredients must be comma separated";
        }
    }
    if (!array_filter($errors)) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $sql = "INSERT INTO pizzas(title,ingredients,email) VALUES('$title','$ingredients','$email')";
        if (mysqli_query($conn, $sql)) {
            header('Location:index.php');
        }
    }
}
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
                <li><a href="#" class="btn brand z-depth-0">Add a Pizza</a></li>
            </ul>
        </div>
    </nav>
    <section class="container grey-text">
        <h4 class="center">Add Pizza</h4>
        <form action="add.php" class="white" method="POST">
            <label for="email">Enter Email</label>
            <input type="email" name="email" id="" required value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"><?php echo $errors['email'] ?></div>
            <label for="title">Pizza Title</label>
            <input type="text" name="title" id="" required value="<?php echo htmlspecialchars($title) ?>">
            <div class="red-text"><?php echo $errors['title'] ?></div>
            <label for="ingredients">Ingredients (Comma Separeted)</label>
            <input type="text" name="ingredients" id="" required value="<?php echo htmlspecialchars($ingredients) ?>">
            <div class="red-text"><?php echo $errors['ingredients'] ?></div>
            <div class="center">
                <input type="submit" value="submit" name="submit" class="btn brand z-depth-0">
            </div>

        </form>
    </section>
    <footer class="section">
        <div class="center grey-text">CopyRight 2023 Ted Blair</div>
    </footer>
</body>

</html>