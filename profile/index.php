<?php
    include($_SERVER['DOCUMENT_ROOT']."/connection.php");
    session_start();

    $sql = mysqli_query($conn,
        "SELECT * FROM users WHERE username='"
        . $_SESSION["username"] . "' ");

    if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
        session_unset(); 
        header("location:/login/");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/styles/shared.css">
    </head>
    <body>
        <header>
            <div class="navbar-home">
                <a href="/">
                    Ravintolan nimi
                    <img class="logo" src="/images/logo.png"/>
                </a>
            </div>
            <div class="navbar-right">
                <div class="navbar-menu">
                    <a href="/varaukset.html">Varaukset</a>
                    <a href="/yhteystiedot.html">Yhteystiedot</a>
                    <a href="/menu.html">Menu</a>
                    <a href="/blogi.html">Blogi</a>
                </div>
                <div class="navbar-login">
                    <a class="log-button" href="/login/">Kirjaudu sisään</a>
                </div>
            </div>
        </header>
    <?php
        echo "Tervetuloa " . $_SESSION['username'];
    ?>
    </body>
</html>