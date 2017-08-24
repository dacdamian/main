<?php
        require_once('db.php');
        session_start();
        
        $page_title = 'Edycja';
        require_once('header.php');

       // error_reporting(E_ALL ^ E_NOTICE);
        
        //$old_login = $_SESSION['user'];
        $login = $_POST["login"];
		$haslo = $_POST["haslo"];
        $imie = $_POST["imie"];
        $nazwisko = $_POST["nazwisko"];
		$data_ur = $_POST["data_urodzenia"];
		$email = $_POST["email"];
		$id = $_POST["id"];
		$status = $_POST["status"];
		var_dump($id);
		var_dump($status);
		$old = mysql_query("SELECT * FROM users WHERE id='$id'");
		var_dump($old);
		if(mysql_num_rows($old) > 0 ) {
	  
            while($r = mysql_fetch_assoc($old)) {
              
                $old_email = $r['email'];
				$old_login = $r['login'];
				var_dump($old_email);
				var_dump($old_login);
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
			echo '<meta http-equiv="refresh" content="3; URL=users.php?action=edit&id='.$id.'">';
			echo '<p style="padding-top:10px;"><strong>Proszę czekać...</strong><br>trwa powrót do strony zmiany danych</center></h3></p>';
            }
        }
		if(!empty($email)) {
		if (!eregi("^[0-9a-z_.-]+@([0-9a-z-]+\.)+[a-z]{2,4}$", $email)) {
            $blad++;
            echo 'Proszę wprowadzić poprawnie adres email.';
            } else {
            $wynik1=mysql_query("SELECT * FROM users WHERE email='$email'") or die(mysql_error());
            if ((mysql_num_rows($wynik1)>0) && ($email != $old_email)) { $blad++;
            echo "<h3><center>Wybrany email jest już używany przez innego użytkownika.<br>";
			echo '<meta http-equiv="refresh" content="3; URL=users.php">';
			echo '<p style="padding-top:10px;"><strong>Proszę czekać...</strong><br>trwa powrót do strony zmiany danych</center></h3></p>';
        }
		}}else{}
		
        //$old = mysql_query("SELECT login FROM users WHERE login='$old_login'") or die('blad zapytania');
        
        if(!empty($id))  {
			if(!empty($haslo)) {
            
			$haslo = md5($haslo);
			
            $update = "UPDATE users SET imie='$imie', nazwisko='$nazwisko', login='$login', haslo='$haslo', email='$email', data_urodzenia='$data_ur', aktywne='$status' WHERE id='$id'";
                mysql_query($update);
				require_once('navmenu.php');
				echo '<meta http-equiv="refresh" content="3; URL=users.php">';
                echo '<hr /><h3><center>Rekord zaktualizowany, zmiany będą widoczne po ponownym zalogowaniu użytkownika.</center></h3>';
				
				}
				else{
					
				$update = "UPDATE users SET imie='$imie', nazwisko='$nazwisko', login='$login', email='$email', data_urodzenia='$data_ur', aktywne='$status' WHERE id='$id'";
                mysql_query($update);
				require_once('navmenu.php');
				echo '<meta http-equiv="refresh" content="10; URL=users.php">';
                echo '<hr /><h3><center>Rekord zaktualizowany, zmiany będą widoczne po ponownym zalogowaniu użytkownika.</center></h3>';
				
		}}
				
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