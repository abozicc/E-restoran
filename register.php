<?php
    header('Content-Type: application/json');

    $conn = mysqli_connect("localhost", "root", "", "restoran");

    if (!$conn) {
        die('Connect Error: '.mysqli_connect_error());
    }

    $username= $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $address = $_POST['address'];


    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $first_name = mysqli_real_escape_string($conn, $first_name);
    $last_name = mysqli_real_escape_string($conn, $last_name);
    $address = mysqli_real_escape_string($conn, $address);


    // Check does user with username or email already exists
    $user_check_sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";

    $user_check_result = mysqli_query($conn, $user_check_sql);

    if (mysqli_num_rows($user_check_result) > 0) {
        // Do not allow registration of double usernames or emails
        while($row = mysqli_fetch_assoc($user_check_result)) {
            if($row['username'] == $username) {
                echo json_encode('User with that username already exists');
            } else {
                echo json_encode('User with that email already exists');
            }
        }
    } else {
        // If there is no user, add new one
        $sql = "INSERT INTO users ( username, password, first_name, last_name, email, address, user_type_id)
                VALUES( '$username', '$password' , '$first_name', '$last_name', '$email', '$address', 2)";

        $register_result = mysqli_query($conn, $sql);

        if($register_result) {
            echo json_encode('User successfully registered');
        } else {
            echo json_encode('Error' . mysqli_error($conn));
        }
    }
?>