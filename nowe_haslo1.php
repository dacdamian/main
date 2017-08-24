<?php
	require_once('db.php');
	
	$page_title = 'Nowe hasło';
	require_once('header.php');
	require_once('navmenu.php');

	
	?>
<div class="container">
<?php


		$login = $_POST["login_generuj"];

		if (strlen($login) < 3 or strlen($login) > 30 or !eregi("^[a-zA-Z0-9_.]+$", $login)) {
            $blad++;
            echo '<hr /><h3><center>Proszę wprowadzić poprawny login (od 3 do 30 znakow).';
        } else {
            $wynik=mysql_query("SELECT * FROM users WHERE login='$login'") or die(mysql_error());
            if (mysql_num_rows($wynik)==0) { $blad++;
            echo 'Brak konta o takim loginie.<br>';
            }
        }
		
		if ($blad == 0) {
			
			$vhaslo = substr(md5(rand()), 0, 16);
			$haslo = md5($vhaslo);
			
			
			$zmiana = "UPDATE users SET haslo='$haslo' WHERE login='$login'";
			mysql_query($zmiana);}
		
		if ($zmiana) {
			echo 'Hasło zostało wygenerowane.<br>';
			
			 $wynik = mysql_query("SELECT * FROM users WHERE login='$login'") or die('blad zapytania');
  
  
    if(mysql_num_rows($wynik) > 0 ) {
    while($r = mysql_fetch_assoc($wynik)) {
        
        $email = $r['email'];   
        $imie = $r['imie'];
        $nazwisko = $r['nazwisko'];
        $data_ur = $r['data_urodzenia'];
        $data_ut = $r['data_utworzenia'];
        $kod = $r['kod'];
		$haslo = $r['haslo'];
   
		  }}
	
    $tresc = '		Witam,

		Przesyłam nowe hasło : '.$vhaslo.' , zaloguje się w http://10.10.10.10/i1/praca/index.php 
		Po ponownym zalogownaiu proszę zmienić hasło na własne.
		Twoje dane to:
		Login: '.$login.'
		Imię: '.$imie.'
		Nazwisko: '.$nazwisko.'
		Data Urodzenia: '.$data_ur.'
		E-mail: '.$email.'
		Pozdrawiam Administrator';
  
    $to = "damian.dac@standard.lublin.pl;". $email;
    $subject = "Aktywacja";
    $message = "$tresc";
    $from = "admin@localhost";
    $headers = "From:" . $from;
    mail($to,$subject,$message,$headers);
    echo "Mail z nowym hasłem został wysłany na adres : $email<br>";
    //echo "$tresc";
			
			echo '<br><a href="index.php">Przejdz do okna logowania</a>';}
			
		else{
			echo 'Wygenerowanie hasła nie powiodło się.<br>';
			echo '<a href="javascript:history.back();">Wstecz</a></center></h3>';}
		
		
			
			
?>
</div>	
<?php
	require_once('footer.php');
?>