<?php
    session_start();
    if (isset($_SESSION['username']) || !empty($_SESSION['username'])) {
        header("location:profile.php");
    }

    include("connection.php"); // $conn

    $err = "";
    if(isset($_POST['username'])) {
        $sql = mysqli_query($conn,
        "SELECT * FROM users WHERE username='"
        . $_POST["username"] . "' AND
        password='" . $_POST["password"] . "'    ");

        $num = mysqli_num_rows($sql);
       
        if($num > 0) {
            $row = mysqli_fetch_array($sql);
            $_SESSION['username'] = $_POST["username"]; 
            header("location:profile.php");
        }
        else {
            $err = "Wrong username or password";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles/shared.css">
        <link rel="stylesheet" href="styles/login.css">
    </head>
    <body>
        <a class="back-btn" href="javascript:history.back()">
            <i class="arrow"></i>
            Takaisin
        </a>
        <form action="login.php" method="post" class="login">
            <input name="username" class="txt" type="text" placeholder="Käyttäjänimi"/><br/>
            <input name="password" class="txt" type="password" placeholder="Salasana"/><br/>
            <p class="error">
                <?php echo $err; ?>
            </p>
            <input class="btn" type="submit" value="Kirjaudu"/>
        </form>
    </body>
</html>