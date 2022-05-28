<?php
    include($_SERVER['DOCUMENT_ROOT']."/connection.php");
    session_start();

    $sql = mysqli_query($conn,
        "SELECT * FROM users WHERE username='"
        . $_SESSION["username"] . "' ");
    $row = mysqli_fetch_assoc($sql);
    
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
        <link rel="stylesheet" href="/styles/profile.css">
        <script>
            // 0 - ma-pe 8-14
            // 1 - ma-pe 14-20
            // 2 - 2 2 10-20

            var user_type = <?php echo $row["type"]; ?>;
            var days = ["ma", "ti", "ke" , "to", "pe", "la", "su"];
            var hoursInRow = 4;
            function init(){
                switch (user_type) {
                    case 0:
                        for(var i = 0; i < 3; i++){
                            for(var j = 0; j < days.length; j++){
                                var align = ["center top", "center bottom"];
                                var proc = 0;
                                if(i == 0){
                                    proc = 101;
                                }
                                else if(i == 1){
                                    proc = 50;
                                }
                                else{
                                    proc = 0;
                                }
                                var style = `-webkit-gradient(linear, ${align[0]}, ${align[1]}, color-stop(0%,rgb(83, 178, 255)), color-stop(${proc-1}%,rgb(83, 178, 255)), color-stop(${proc}%,rgb(255, 255, 255)), color-stop(100%,rgb(255, 255, 255)))`;
                                var id = days[j] + i;
                                document.getElementById(id).style.background = style;
                            }
                        }
                        break;
                    case 1:
                        for(var i = 0; i < 3; ++i){
                            for(var j = 0; j < days.length; j++){
                                var align = ["center top", "center bottom"];
                                var proc = 0;
                                if(i == 0){
                                    proc = 0;
                                }
                                else if(i == 1){
                                    proc = 50;
                                    align = align.reverse();
                                }
                                else{
                                    proc = 100;
                                }
                                var style = `-webkit-gradient(linear, ${align[0]}, ${align[1]}, color-stop(0%,rgb(120, 194, 255)), color-stop(${proc-1}%,rgb(95, 119, 255)), color-stop(${proc}%,rgb(255, 255, 255)), color-stop(100%,rgb(255, 255, 255)))`;
                                var id = days[j] + i;
                                document.getElementById(id).style.background = style;
                            }
                        }
                        break;
                    case 2:
                        var currentdate = new Date();
                        var oneJan = new Date(currentdate.getFullYear(),0,1);
                        var numberOfDays = Math.floor((currentdate - oneJan) / (24 * 60 * 60 * 1000));
                        var result = Math.ceil(( currentdate.getDay() + 1 + numberOfDays) / 7);
                        var offset = 4 - result % 4;

                        for(var i = 0; i < 3; ++i){
                            for(var j = 0; j < days.length; j++){
                                console.log(j + offset % 4);
                                if((j + offset) % 4 >= 2){
                                    continue;
                                }
                                var align = ["center top", "center bottom"];
                                var proc = 0;
                                if(i == 0){
                                    proc = 50;
                                    align = align.reverse();
                                }
                                else if(i == 1){
                                    proc = 100;
                                }
                                else{
                                    proc = 100;
                                }
                                var style = `-webkit-gradient(linear, ${align[0]}, ${align[1]}, color-stop(0%,rgb(120, 194, 255)), color-stop(${proc-1}%,rgb(95, 119, 255)), color-stop(${proc}%,rgb(255, 255, 255)), color-stop(100%,rgb(255, 255, 255)))`;
                                var id = days[j] + i;
                                document.getElementById(id).style.background = style;
                            }
                        }
                        break;
                }
            }

        </script>
    </head>
    <body onload="init();">
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
                    <a class="log-button" href="/login/">Profiili</a>
                </div>
            </div>
        </header>
        <div class="content">
            <h2>
                <?php
                    echo "Tervetuloa, " . $_SESSION['username'];
                ?>. Työjärjestyksesi tälle viikolle.
            </h2>
            <table>
                <tr class="top left">
                  <th class="top left"></th>
                  <th class="top">ma</th>
                  <th class="top">ti</th>
                  <th class="top">ke</th>
                  <th class="top">to</th>
                  <th class="top">pe</th>
                  <th class="top">la</th>
                  <th class="top">su</th>
                </tr>
                <tr>
                  <th class="left">
                      <div class="tbcontent">
                        <div class="toptext">
                            08:00
                        </div>
                        <div class="bottomtext">
                            12:00
                        </div>
                      </div>
                  </th>
                  <td id="ma0"></td>
                  <td id="ti0"></td>
                  <td id="ke0"></td>
                  <td id="to0"></td>
                  <td id="pe0"></td>
                  <td id="la0"></td>
                  <td id="su0"></td>
                </tr>
                <tr>
                  <th class="left">
                      <div class="tbcontent">
                        <div class="bottomtext">
                            16:00
                        </div>
                      </div>
                  </th>
                  <td id="ma1"></td>
                  <td id="ti1"></td>
                  <td id="ke1"></td>
                  <td id="to1"></td>
                  <td id="pe1"></td>
                  <td id="la1"></td>
                  <td id="su1"></td>
                </tr>
                <tr>
                  <th class="left">
                      <div class="tbcontent">
                        <div class="bottomtext">
                            20:00
                        </div>
                      </div>
                  </th>
                  <td id="ma2"></td>
                  <td id="ti2"></td>
                  <td id="ke2"></td>
                  <td id="to2"></td>
                  <td id="pe2"></td>
                  <td id="la2"></td>
                  <td id="su2"></td>
                </tr>

            </table>
        </div>
    </body>
</html>