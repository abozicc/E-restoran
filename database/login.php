<?php
    header('Content-Type: application/json');

    $conn = mysqli_connect("localhost", "root", "", "restoran");

    if (!$conn) {
        die('Connect Error: '.mysqli_connect_error());
    }

 
    $email = $_POST['email'];
    $password = $_POST['password'];
  

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
  

$sql = "select email, password from users where email= '$email' and password= '$password' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);



if($row){
  echo json_encode ('Login success, welcome');
     session_start();

    //Postavi podatke ulogiranog korisnika na sesiju
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
 header("location: ../index.html");
    
 }

else {
    echo json_encode( "Pogreska, pokusajte ponovnoe");
}

?>
