<?php

    require_once('db.php');
    $page_title = 'mail z danymi';
    require_once('header.php');
    
?>
<?php

    $wynik = mysql_query("SELECT * FROM users u, dod_dane dd WHERE u.login='$login'") or die('blad zapytania');
  
  
    if(mysql_num_rows($wynik) > 0 ) {
    while($r = mysql_fetch_assoc($wynik)) {
        
        $email = $r['email'];   
        $imie = $r['imie'];
        $nazwisko = $r['nazwisko'];
        $data_ur = $r['data_urodzenia'];
        $data_ut = $r['data_utworzenia'];
        $kod = $r['kod'];
		$adres = $r['adres'];
		$telefon = $r['telefon'];
   
		  }}
	
    $tresc = 'Witam,

    Przesyłam link aktywacyjny "http://10.10.10.10/i1/praca/aktywuj.php?kod='.$kod.'&login='.$login.'" Aktywuj konto
    Twoje dane to:
    Login: '.$login.'
    Imię: '.$imie.'
    Nazwisko: '.$nazwisko.'
	Adres: '.$adres.'
	Telefon: '.$telefon.'
    Data Urodzenia: '.$data_ur.'
    E-mail: '.$email.'
	Pozdrawiam Administrator';
  
    $to = "damian.dac@standard.lublin.pl;"/*. $email*/;
    $subject = "Aktywacja";
    $message = "$tresc";
    $from = "admin@localhost";
    $headers = "From:" . $from;
    mail($to,$subject,$message,$headers);
    echo "Mail wysłany na adres : $email<br>";
    echo "$tresc";

?>
<?php
    require_once('footer.php');
?>