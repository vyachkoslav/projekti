<?php
    include("connection.php");
    session_start();

    $sql = mysqli_query($conn,
        "SELECT * FROM users WHERE username='"
        . $_SESSION["username"] . "' ");

    if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
        session_unset(); 
        header("location:login.php");
    }

    echo $_SESSION['username'];
?>