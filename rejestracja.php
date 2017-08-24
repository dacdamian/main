<?php
        require_once('db.php');
        
        $page_title = 'Rejestracja';
        require_once ('header.php');
		require_once('navmenulogout.php');

       //error_reporting(E_ALL ^ E_NOTICE);
        
        $login = $_POST["login"];
        $haslo = $_POST["haslo"];
        $haslo2 = $_POST["haslo2"];
        $imie = $_POST["imie"];
        $nazwisko = $_POST["nazwisko"];
        $data_ur = $_POST["data_urodzenia"];
        $email = $_POST["email"];
		$telefon = $_POST["telefon"];
		$adres = $_POST["adres"];
		$zdjecie = addslashes(file_get_contents($_FILES['zdjecie']['tmp_name']));
		
		$telefon1 = $_POST["telefon1"];
		$adres1 = $_POST["adres1"];

?>

<html lang="pl_PL">
  <head>
    <meta http-equiv="Content-type" CONTENT="text/html; charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skrypt rejestracji z wykorzystaniem PHP i bazy MySQL</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        
        <?php
		if (strlen($login) < 3 or strlen($login) > 30 or !eregi("^[a-zA-Z0-9_.]+$", $login)) {
            $blad++;
            echo '<hr /><h3><center>Proszę wprowadzić poprawny login (od 3 do 30 znakow).</center></h3>';
        } else {
            $wynik=mysql_query("SELECT * FROM users WHERE login='$login'") or die(mysql_error());
            if (mysql_num_rows($wynik)>0) { $blad++;
            echo '<h3><center>Wybrany login jest już używany przez innego użytkownika.<br></center></h3>';
            }
        }
        
		if (strlen($telefon) < 9 or strlen($telefon) > 15 or !eregi("^[0-9_.]+$", $telefon)) {
			$blad++;
		} else {
			$wynik2=mysql_query("SELECT * FROM users WHERE telefon='$telefon'") or die(mysql_error());
			if (mysql_num_rows($wynik2)>0) { $blad++;
			echo '<h3><center>Podany numer tel został już zarejestrowany w systemie.<br></center></h3>';
			}
		}
       
        if ($haslo !== $haslo2) {
            $blad++;
            echo '<h3><center>Podane hasła nie są ze sobą zgodne. <br></center></h3>';
        }  
      
        if (!eregi("^[0-9a-z_.-]+@([0-9a-z-]+\.)+[a-z]{2,4}$", $email)) {
            $blad++;
            echo 'Proszę wprowadzić poprawnie adres email.';
            } else {
            $wynik1=mysql_query("SELECT * FROM users WHERE email='$email'") or die(mysql_error());
            if (mysql_num_rows($wynik1)>0) { $blad++;
            echo "<h3><center>Wybrany email jest już używany przez innego użytkownika.<br></center></h3>";
        }
            }
			
        if(isset($telefon) || isset($adres)) {
			$dod_dane = mysql_query("INSERT INTO dod_dane SET adres='$adres', telefon='$telefon'") or die(mysql_error());
		}
		
			/*$sel = mysql_query("SELECT id FROM dod_dane WHERE adres='$adres' and telefon='$telefon'");
			$id_dane = mysql_fetch_array($sel);
			$id_dane = $id_dane['id'];*/
        
        if ($blad == 0) {
 
            $haslo = md5($haslo); // zaszyfrowanie hasla
            $vkod = substr(md5(rand()), 0, 16);
			$kod = md5($vkod);// tworzenie unikalnego kodu dla uzytkownika
			
           $sel = mysql_query("SELECT id FROM dod_dane WHERE adres='$adres' and telefon='$telefon'");
			$id_dane = mysql_fetch_array($sel);
			$id_dane = $id_dane['id'];
			
  
			$ins = mysql_query("INSERT INTO users SET imie='$imie', nazwisko='$nazwisko', login='$login', haslo='$haslo', data_urodzenia='$data_ur', data_utworzenia=CURDATE(), email='$email', kod='$kod', zdjecie='$zdjecie', id_dod_dane='$id_dane'");
        	//$ins1 = mysql_query("INSERT INTO dod_dane SET telefon='$telefon', adres='$adres', id_users=(SELECT id FROM users WHERE login='$login')");
  }
  
        if($ins == 1){ 
            echo "<h3><center>Rejestracja powiodla się. <br>";
            require_once('wyslij.php');
            echo '<a href="index.php">przejdz do okna logowania</a></center></h3>';}
            
        else{ echo "<h3><center>Blad rejestracji uzytkownika. <br>";
            echo '<a href="javascript:history.back();">Wstecz</a></center></h3>';}
  
  ?>
        <?php
        require_once('footer.php');
        ?>
        
    </body>
</html>