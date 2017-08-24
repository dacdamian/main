<?php
        require_once('db.php');
        session_start();
        
        $page_title = 'Edycja';
        require_once('header.php');

       // error_reporting(E_ALL ^ E_NOTICE);
        
        $old_login = $_SESSION['user'];
        $login = $_POST["login"];
        $imie = $_POST["imie"];
        $nazwisko = $_POST["nazwisko"];
        $data_ur = $_POST["data_urodzenia"];
        $email = $_POST["email"];
		$id = $_POST["id"];
		$old = mysql_query("SELECT * FROM users WHERE login='$old_login'");
		
		if(mysql_num_rows($old) > 0 ) {
	  
            while($r = mysql_fetch_assoc($old)) {
              
                $old_email = $r['email'];   
			}
		}
               

?>

<html lang="pl_PL">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skrypt edycji z wykorzystaniem PHP i bazy MySQL</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        
        <?php
		if (strlen($login) < 3 or strlen($login) > 30 or !eregi("^[a-zA-Z0-9_.]+$", $login)) {
            $blad++;
            echo '<hr /><h3><center>Proszę wprowadzić poprawny login (od 3 do 30 znakow).';
        } else {
            $wynik=mysql_query("SELECT * FROM users WHERE login='$login'") or die(mysql_error());
            if ((mysql_num_rows($wynik)>0) && ($login != $old_login)) { $blad++;
            echo '<hr /><h3><center>Wybrany login jest już używany przez innego użytkownika.<br>';
			echo '<meta http-equiv="refresh" content="3; URL=hide2.php">';
			echo '<p style="padding-top:10px;"><strong>Proszę czekać...</strong><br>trwa powrót do strony zmiany danych</center></h3></p>';
            }
        }
		
		if (!eregi("^[0-9a-z_.-]+@([0-9a-z-]+\.)+[a-z]{2,4}$", $email)) {
            $blad++;
            echo 'Proszę wprowadzić poprawnie adres email.';
            } else {
            $wynik1=mysql_query("SELECT * FROM users WHERE email='$email'") or die(mysql_error());
            if ((mysql_num_rows($wynik1)>0) && ($email != $old_email)) { $blad++;
            echo "<h3><center>Wybrany email jest już używany przez innego użytkownika.<br>";
			echo '<meta http-equiv="refresh" content="3; URL=hide2.php">';
			echo '<p style="padding-top:10px;"><strong>Proszę czekać...</strong><br>trwa powrót do strony zmiany danych</center></h3></p>';
        }
            }
		
        $old = mysql_query("SELECT login FROM users WHERE login='$old_login'") or die('blad zapytania');
        
        if($blad == 0 )  {
            
            $query="UPDATE users SET imie='$imie', nazwisko='$nazwisko', login='$login', data_urodzenia='$data_ur', email='$email' WHERE login='$old_login'";
                mysql_query($query);
				require_once('navmenulogout.php');
                echo '<hr /><h3><center>Rekord zaktualizowany, dalsza praca będzie możliwa po ponownym zalogowaniu. <br> <a href="wyloguj.php"> Zaloguj sie ponownie </a></center></h3>';
				session_destroy();
				}
				
		else{
			require_once('navmenu.php');
			echo '<p style="padding-top:10px;"><hr /><h3><center>Nie udalo sie edytowac danych</center></h3>';
		}
        

        ?>
        <?php
        require_once('footer.php');
        ?>
    </body>
</html>