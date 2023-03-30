<?php
session_start();
include_once "config.php";

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM users WHERE email = '{$email}'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "$email already exists!";
        } else {
            if (isset($_FILES['image'])) {
                $file_name = $_FILES['image']['name'];
                $file_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];

                $img_explode = explode('.', $file_name);
                $img_ext = end($img_explode);

                $extensions = ['png', 'jpeg', 'jpg'];
                if (in_array($img_ext, $extensions) === true) {
                    $time = time();
                    $new_img_name = $time . $file_name;
                    if (move_uploaded_file($tmp_name, "profiles/" . $new_img_name)) {
                        $status = 'Active now';
                        $random_id = rand(time(), 10000000);

                        $insert = "INSERT INTO users(unique_id,fname,lname,email,password,img,status) VALUES('$random_id','$fname','$lname','$email','$password','$new_img_name','$status') ";
                        $results2 = mysqli_query($conn, $insert);
                        if ($results2) {
                            $get = "SELECT * FROM users WHERE email='$email'";
                            $result3 = mysqli_query($conn, $get);
                            if (mysqli_num_rows($result3) > 0) {
                                $row = mysqli_fetch_assoc($result3);
                                $unique_id = $row['unique_id'];
                                $_SESSION['unique_id'] = $unique_id;
                                echo "success";
                            } else {
                                echo "Something went wrong!";
                            }
                        }
                    }
                } else {
                    echo "Please provide an image file; jpeg,jpg,png";
                }
            } else {
                echo "Please select an image";
            }
        }
    } else {
        echo "$email is not a valid email";
    }
} else {
    echo "All input fields have to filled";
}
