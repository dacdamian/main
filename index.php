<?php
          session_start();
          require_once('db.php');
          
		  
    ?>


<html lang="pl_PL">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formularz rejestracyjny html</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap/js/bootstrap.js" language=javascript type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    </head>
	<body>
	
<?php
    
    if (!isset($_POST['login']) && !isset($_POST['haslo']) && !isset($_POST['aktywne']) && $_SESSION['auth'] == FALSE) {
        $page_title = 'Logowanie do serwisu';
        require_once('header.php');
		require_once('navmenu.php');
		
  ?>
	
<form class="form-horizontal" method="POST" action="index.php">
<fieldset>

<!-- Form Name -->
<legend><center>Logowanie do serwisu</center></legend>

<!-- Text input-->
<div class="container">
<div class="form-group">
  <label class="col-md-4 control-label" for="login">Login</label>  
  <div class="col-md-4">
  <input id="login" name="login" type="text" placeholder="login" class="form-control input-md" required="">
    <span class="komunikat" id="user-availability-status"></span>
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="haslo">Hasło</label>
  <div class="col-md-4">
    <input id="haslo" name="haslo" type="password" placeholder="haslo" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="loguj"></label>
  <div class="col-md-4">
    <button id="loguj" name="loguj" class="btn btn-success">Zaloguj</button>
  </div>
</div>
<div class="form-group">
	<label class="col-md-4 control-label" for="rejestracja"></label>
	<div class="col-md-5">
	Jeśli nie masz jeszcze konta to zarejestruj się <a href="rejestracja.html"><b>">>tutaj<<"</b></a><br>
	Jeśli nie pamietasz hasła kliknij <a href="nowe_haslo.php"><b>">>tutaj<<"</b></a>
	</div>
	</div>
	</div>
</fieldset>
</form>
<script>//walidacje
$(document).ready(function() {
 
	
	$('#login').on('blur', function() {
		var input = $(this);
		var login_length = input.val().length;
		if(login_length >= 3 && login_length <= 30){
			input.removeClass("invalid").addClass("valid");
			input.next('.komunikat').text("Wprowadzono poprawny login.").removeClass("blad").addClass("ok");
				 jQuery.ajax({
                                url: "sprawdz_login.php",
                                data:'login1='+$("#login").val(),
                                type: "POST",
                                success:function(data){
                                $("#user-availability-status").html(data);
                                },
                                error:function (){
                                }
                                });
		}
		else{
			input.removeClass("valid").addClass("invalid");
			input.next('.komunikat').text("Login musi mieć więcej niż 3 i mniej niż 30 znaków!").removeClass("ok").addClass("blad");
			
		}
	});
});
</script>

<?php
    }
  
    elseif (isset($_POST['login']) && isset($_POST['haslo']) && $_SESSION['auth'] == FALSE) {
          
        if (!empty($_POST['login']) && !empty($_POST['haslo'])) {
          
        
        $login = mysql_real_escape_string($_POST['login']);
        $haslo = mysql_real_escape_string($_POST['haslo']);
        
        
        $haslo = md5($haslo);
        
        
        $sql = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `login` = '$login' AND `haslo` = '$haslo' AND aktywne in('1','2')"));
        
	$sql1 = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `login` = '$login' AND `haslo` = '$haslo' AND aktywne='0'"));
        
        $sql2 = mysql_query("SELECT * FROM users WHERE login='$login'") or die('blad zapytania');
            
            if(mysql_num_rows($sql2) > 0 ) {
	 
                while($r = mysql_fetch_assoc($sql2)){
                    
                    $kod = $r['kod'];   
                }
            }
            if ($sql == 1) {
              
              
                $_SESSION['user'] = $login;
                $_SESSION['auth'] = TRUE;
                
				$page_title = 'logowanie';
				require_once('header.php');
                require_once('navmenu.php');
				echo '<meta http-equiv="refresh" content="1; URL=index.php">';
				echo '<hr /><h3><center><p style="padding-top:10px;"><strong>Proszę czekać...</strong><br>trwa logowanie i wczytywanie danych</center></h3></p>';
            }	
            elseif ($sql1 == 1) {
                require_once('header.php');
				require_once('navmenu.php');
				echo '<h3><center>Konto jest nieaktywne <br>';
                echo '<a href="aktywuj.php?kod='.$kod.'&login='.$login.'">aktywuj konto<br></a>';
                echo '<a href="index.php" style="">Wróć do formularza</a></p></center></h3>';
                                
            }
            else {
				$page_title = 'Błędne logowanie';
				require_once('header.php');
				require_once('navmenu.php');
                echo '<h3><center><p style="padding-top:10px;color:red">Blad podczas logowania do systemu haslo<br>';
                echo '<a href="index.php" style="">Wróć do formularza</a></p></center></h3>';
				$data = date("Y-m-d | h:i:sa");
				$tresc = "$data - Blad podczas logowania do systemu na konto : $login
"; 
				
				
				// przypisanie zmniennej $file nazwy pliku 
				$file = "log.txt"; 

				// uchwyt pliku, otwarcie do dopisania 
				$fp = fopen($file, "a"); 

				// blokada pliku do zapisu 
				flock($fp, 2); 

				// zapisanie danych do pliku 
				fwrite($fp, $tresc); 

				// odblokowanie pliku 
				flock($fp, 3); 

				// zamknięcie pliku 
				fclose($fp); 
            }
        }
        else {
			$page_title = 'Błędne logowanie';
			require_once('header.php');
			require_once('navmenu.php');
            echo '<h3><center><p style="padding-top:10px;color:red">Blad podczas logowania do systemu dupa<br>';
            echo '<a href="index.php" style="">Wróć do formularza</a></p></center></h3>';   

        }
		
    }
	
    elseif ($_SESSION['auth'] == TRUE && !isset($_GET['logout'])) {
		$page_title = 'Strona startowa';
        require_once('header.php');
        require_once('navmenu.php');
		
		echo '<div class="container"><h3><p style="padding-top:10px;"> Witaj '.$_SESSION['user'].', <br><br> 
		obecnie znajdujesz się na stronie głównej serwisu rejesetracyjnego i logującego z możliwością zmiany danych.
		W przypadku zapomnienia hasła na stronie głównej logowania jest opcja przypomnij hasło,
		która generuje wiadomość z nowym hasłem i wysyła na adres email wprowdzony przy rejestracji.
		Nowe hasło można zmienić w odpowiedniej zakładce, w razie błędnego wprowadzenia danych masz jeszcze dwa dni od rejestracji na poprawę.<br><br>
		Pozdrawiam<br>Administrator serwisu ;)</p></h3></div>';
		}
       /* echo '<meta http-equiv="refresh" content="1; URL=hide1.php">';
        echo '<hr /><h3><center><p style="padding-top:10px;"><strong>Proszę czekać...</strong><br>trwa wczytywanie danych</center></h3></p>';
   */ 
	
	
?>
</div>
<?php

 require_once('footer.php');
 
?>
    </body>
</html>