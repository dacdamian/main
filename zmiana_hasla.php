<?php   
        
        require_once('db.php');
        session_start();
        
        $page_title = 'zmiana hasla';
        require_once('header.php');

        // error_reporting(E_ALL ^ E_NOTICE);
        $login = $_SESSION['user'];
        $haslo3 = $_POST["haslo3"];
        $haslo = $_POST["haslo"];
        $haslo2 = $_POST["haslo2"];
        $haslo3 = md5($haslo3);
        
?>

<html lang="pl_PL">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skrypt rejestracji z wykorzystaniem PHP i bazy MySQL</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
       <div class="container"> 
<?php

    $old = mysql_query("SELECT * FROM users WHERE haslo='$haslo3' and login='$login'") or die(mysql_error());
    if (mysql_num_rows($old) == 0){
        $blad++;
		require_once('navmenu.php');
        echo '<hr /><h3><center>Błęne stare hasło';
        echo '<meta http-equiv="refresh" content="3; URL=hide3.php">';
        echo '<p style="padding-top:10px;"><strong>Proszę czekać...</strong><br>trwa powrót do strony zmiany hasła<p></p>';
        exit();
    }

    if ($haslo !== $haslo2) {
            $blad++;
            echo 'Podane hasła nie są ze sobą zgodne. <br>';
        }  
        
    if ($blad == 0){
    
        $haslo = md5($haslo);

        $query = "UPDATE users SET haslo='$haslo' WHERE login='$login'";
        mysql_query($query);
		require_once('navmenulogout.php');
        echo '<hr />Hasło zmienione, dalsza praca będzie możliwa po ponownym zalogowaniu. <br> <a href="wyloguj.php"> Zaloguj sie ponownie </a>';
        echo '<meta http-equiv="refresh" content="5; URL=index.php">';
        echo '<p style="padding-top:10px;"><strong>Proszę czekać...</strong><br>przenoszenie do formularza logowania</center></h3></p>';
        
        
        session_destroy();
    }
?>
</div>
<?php
    require_once('footer.php');
?>