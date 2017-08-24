<?php
	session_start();
	require_once('db.php');
	$page_title = 'Strona główna';
	require_once('header.php');

?>	
<html lang="pl_PL">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<?php
	echo	'<title>Zadania od andrzeja - ' . $page_title . '</title>';
	?>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<script src="bootstrap/js/bootstrap.js" language="javascript" type="text/javascript"></script>
	<style type="text/css">

  body {
      height: 100vh;
      width: 100%;
      background: 0;
      margin: 0;
      padding: 0;
  }

  .left-menu {
      position: fixed;
      top: 0px;
      left: 0px;
      height: 100px;
      width: 200px;
      background: white;
      margin: 0;
      padding: 0;
  }

  .left-menu ul {
      list-style: none;
      text-align: center;
      padding: 0px;
  }

  .left-menu li {
      margin: 30px auto;
  }

  .left-menu ul li a {
      font-weight: 100;
      font-size: 16px;
      color: #082213;
      text-decoration: none;
      margin: 0px 15px;
      text-transform: uppercase;
  }

  .left-menu ul li a:hover {
      color: silver;
  }

  #nav-icon {
      position: absolute;
      top: 25px;
      left: 25px;
      cursor: pointer;
  }

  #nav-icon span {
      font-size: 42px;
      color: #2A3D45;
  }

  </style>

</head>

<body>


  <div id="nav-icon">
      <span><i class="fa fa-bars"></i></span>
  </div>

  <div class="left-menu">
      <ul>
          <li>
              <a href="index1.php">Strona główna</a>
          </li>
          <li>
              <hr>
          </li>
          <li>
              <a type="text" data-toggle="modal" data-target="#loguj">Zaloguj</a>
          </li>
          <li>
              <a type="text" data-toggle="modal" data-target="#generuj">Generuj hasło</a>
          </li>
		  <li>
              <a type="text" data-toggle="modal" data-target="#rejestruj">Zarejestruj</a>
          </li>

  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="bootstrap/sliiide-master/sliiide.min.js"></script>
<script>

$('.left-menu').sliiide({place: 'left', toggle: '#nav-icon'});

</script>
	
	<?php
    
    if (!isset($_POST['login_loguj']) && !isset($_POST['haslo_loguj']) && !isset($_POST['aktywne']) && $_SESSION['auth'] == FALSE) {
        $page_title = 'Logowanie do serwisu';
        require_once('header.php');
		
  ?>
	
	
	<div class="container">
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
  <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Rozwiń nawigację</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     <ul class="nav navbar-nav navbar-left">
		
		<li><button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#loguj">Loguj</button></li>
	</ul>
  <ul class="nav navbar-nav navbar-right">
		<li><button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#generuj">Generuj hasło</button></li>
        <li><button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#rejestruj">Rejestracja</button></li>
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>
</div>
<!-- logowanie -->
<div class="modal fade" id="loguj" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Okno logowania</h4>
        </div>
        <div class="modal-body">
		<form class="form-horizontal" method="POST" action="index1.php">
<fieldset>

<!-- Form Name -->
<legend><center>Logowanie do serwisu</center></legend>

<!-- Text input-->
<div class="container">
<div class="form-group">
  <label class="col-md-1 control-label" for="login_loguj">Login</label>  
  <div class="col-md-4">
  <input id="login_loguj" name="login_loguj" type="text" placeholder="login" class="form-control input-md" required="">
    <span class="komunikat" id="login_loguj-availability-status"></span>
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-1 control-label" for="haslo">Hasło</label>
  <div class="col-md-4">
    <input id="haslo_loguj" name="haslo_loguj" type="password" placeholder="haslo" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="loguj"></label>
  <div class="col-md-4">
    <button id="loguj" name="loguj" class="btn btn-success">Zaloguj</button>
  </div>
</div>
</div>
<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      
    </div>
  </div>
  </div>
</div>

</fieldset>

</form>	
<script>//walidacje logowanie
$(document).ready(function() {
$('#login_loguj').on('blur', function() {
		var input = $(this);
		var login_length = input.val().length;
		if(login_length >= 3 && login_length <= 30){
			input.removeClass("invalid").addClass("valid");
			input.next('.komunikat').text("Wprowadzono poprawny login.").removeClass("blad").addClass("ok");
				 jQuery.ajax({
                                url: "sprawdz_login.php",
                                data:'login1='+$("#login_loguj").val(),
                                type: "POST",
                                success:function(data){
                                $("#login_loguj-availability-status").html(data);
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
<!-- nowe haslo -->
<div class="modal fade" id="generuj" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Okno generowania nowego hasła</h4>
        </div>
        <div class="modal-body">
		
	<form class="form-horizontal" method="POST" action="nowe_haslo1.php">
<fieldset>

<!-- Form Name -->
<legend><center>Generowanie nowego hasła</center></legend>

<!-- Text input-->
<div class="container">

<div class="form-group" id="frmCheckLogin">
  <label class="col-md-2 control-label" for="login_generuj">Podaj swój login</label>  
  <div class="col-md-3">
  <input id="login_generuj" name="login_generuj" type="text" placeholder="login" class="form-control input-md" required="" onBlur="checkAvailability()">
    <span class="komunikat" id="login_generuj-availability-status"></span>
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label" for="generuj"></label>
  <div class="col-md-4">
    <button id="generuj" name="generuj" class="btn btn-primary">Generuj nowe hasło</button>
  </div>
</div>

</div>

<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      
    </div>
  </div>
  </div>
</div>
</fieldset>
</form>
<script>//walidacja istnienia loginu
$(document).ready(function() {
 
	
	$('#login_generuj').on('blur', function() {
		var input = $(this);
		var login_length = input.val().length;
		if(login_length >= 3 && login_length <= 30){
			input.removeClass("invalid").addClass("valid");
			input.next('.komunikat').text("Wprowadzono poprawny login.").removeClass("blad").addClass("ok");
				 jQuery.ajax({
                                url: "sprawdz_login.php",
                                data:'login1='+$("#login_generuj").val(),
                                type: "POST",
                                success:function(data){
                                $("#login_generuj-availability-status").html(data);
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


<!--   rejestracja -->
<div class="modal fade" id="rejestruj" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Okno rejestracji</h4>
        </div>
        <div class="modal-body">
         <form class="form-horizontal" action="rejestracja.php" method="POST">
<fieldset>


<legend><center>Formularz rejestracyjny</center></legend>

<form>
<div class="container">
<div class="form-group" id="frmCheckUsername">
  <label class="col-md-1 control-label" for="Login">Login</label>  
  <div class="col-md-4">
  <input id="login" name="login" type="text" placeholder="login" class="form-control input-md" required="" onBlur="checkAvailability()">
  <span class="komunikat" id="login-availability-status"></span>
 
  </div>
</div>


<div class="form-group">
  <label class="col-md-1 control-label" for="haslo">Haslo</label>
  <div class="col-md-4">
    <input id="haslo" name="haslo" type="password" placeholder="Haslo" class="form-control input-md" required="">
    <span class="komunikat"></span>
  </div>
</div>


<div class="form-group">
  <label class="col-md-1 control-label" for="haslo2">Powtorz haslo</label>
  <div class="col-md-4">
    <input id="haslo2" name="haslo2" type="password" placeholder="wpisz ponownie haslo" class="form-control input-md" required="">
    <span class="komunikat"></span>
  </div>
</div>


<div class="form-group">
  <label class="col-md-1 control-label" for="imie">Imie</label>  
  <div class="col-md-4">
  <input id="imie" name="imie" type="text" placeholder="imie" class="form-control input-md" required="">
  <span class="komunikat"></span>
  </div>
</div>


<div class="form-group">
  <label class="col-md-1 control-label" for="nazwisko">Nazwisko</label>  
  <div class="col-md-4">
  <input id="nazwisko" name="nazwisko" type="text" placeholder="nazwisko" class="form-control input-md" required="">
  <span class="komunikat"></span>
  </div>
</div>


<div class="form-group">
  <label class="col-md-1 control-label" for="data_urodzenia">Data urodzenia</label>  
  <div class="col-md-4">
  <input id="data_urodzenia" name="data_urodzenia" type="date" placeholder="data" class="form-control input-md" required="" value="rrrr-mm-dd">
  <span class="komunikat"></span>  
  </div>
</div>


<div class="form-group" id="frmCheckEmail">
  <label class="col-md-1 control-label" for="email">E-mail</label>  
  <div class="col-md-4">
  <input id="email" name="email" type="text" placeholder="email" class="form-control input-md" required="" onBlur="checkAvailability()">
  <span class="komunikat" id="email-availability-status"></span>  
  </div>
</div>


<div class="form-group">
  <label class="col-md-1 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-success">Zarejestruj</button>
  </div>
</div>
</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

</fieldset>

</form>

<script>//walidacje rejestracja
$(document).ready(function() {
 
	$('#login').on('blur', function() {
            var input = $(this);
            var login_length = input.val().length;
                
		if(login_length > 3 && login_length <= 30){
                    input.removeClass("invalid").addClass("valid");
                    input.next('.komunikat').text("Wprowadzono poprawny login.").removeClass("blad").addClass("ok");
                            jQuery.ajax({
                                url: "sprawdz_login.php",
                                data:'login='+$("#login").val(),
                                type: "POST",
                                success:function(data){
                                $("#login-availability-status").html(data);
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
	
        $('#haslo').on('blur', function()
            {
            var input = $(this);
            var haslo_length = input.val().length;

                if(haslo_length >= 5 && haslo_length <=20){
                    input.removeClass("invalid").addClass("valid");
                    input.next('.komunikat').text("Hasło jest poprawnej długości.").removeClass("blad").addClass("ok");

		}
		else{
                    input.removeClass("valid").addClass("invalid");
                    input.next('.komunikat').text("Hasło musi mieć powyżej 4 znaków, a nie więcej jak 20!").removeClass("ok").addClass("blad");

		}
	});

	$('#haslo2').on('blur', function(){
            var input = $(this);
            var haslo2 = document.getElementById('haslo2').value;
            var haslo = document.getElementById('haslo').value;


                if(haslo2 == haslo){
                    input.removeClass("invalid").addClass("valid");
                    input.next('.komunikat').text("Hasło jest zgodne.").removeClass("blad").addClass("ok");

                    }
                else{
                    input.removeClass("valid").addClass("invalid");
                    input.next('.komunikat').text("Hasło musi być takie samo jak wyżej!").removeClass("ok").addClass("blad");

                    }
	});
	
	$('#imie').on('blur', function() {
            var input = $(this);
            var imie_length = input.val().length;
		if(imie_length >= 4 && imie_length <= 15){
			input.removeClass("invalid").addClass("valid");
			input.next('.komunikat').text("Wprowadzono poprawną nazwę.").removeClass("blad").addClass("ok");
		}
		else{
			input.removeClass("valid").addClass("invalid");
			input.next('.komunikat').text("Nazwa musi mieć więcej niż 3 i mniej niż 16 znaków!").removeClass("ok").addClass("blad");
			
		}
	});
	
	$('#nazwisko').on('blur', function() {
            var input = $(this);
            var nazwisko_length = input.val().length;
		if(nazwisko_length >= 2 && nazwisko_length <= 20){
			input.removeClass("invalid").addClass("valid");
			input.next('.komunikat').text("Wprowadzono poprawną nazwę.").removeClass("blad").addClass("ok");
		}
		else{
			input.removeClass("valid").addClass("invalid");
			input.next('.komunikat').text("Nazwa musi mieć więcej niż 2 i mniej niż 21 znaków!").removeClass("ok").addClass("blad");
			
		}
	});
	
	
	$('#email').on('blur', function() {
            var input = $(this);
            var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            var is_email = pattern.test(input.val());
		if(is_email){
			input.removeClass("invalid").addClass("valid");
			input.next('.komunikat').text("Wprowadzono poprawny email.").removeClass("blad").addClass("ok");
                           jQuery.ajax({
                                url: "sprawdz_login.php",
                                data:'email='+$("#email").val(),
                                type: "POST",
                                success:function(data){
                                $("#email-availability-status").html(data);
                                },
                                error:function (){
                                }
        });
		}
		else{
			input.removeClass("valid").addClass("invalid");
			input.next('.komunikat').text("Wprowadź poprawny email!").removeClass("ok").addClass("blad");
		}
	});	
	
	$('#submit').click(function(event){
            var login = $('#login');
            var imie = $('#imie');
            var nazwisko = $('#nazwisko');
            var email = $('#email');
			
			
			
                if(login.hasClass('valid') && email.hasClass('valid') && imie.hasClass('valid') && nazwisko.hasClass('valid')){
				alert("Pomyślnie wysłano formularz.");	
                }
                else {
				event.preventDefault();
				alert("Uzupełnij wszystkie pola poprawnie!");	
		}
	});
	

});
</script>
        
<?php
    }
  
    elseif (isset($_POST['login_loguj']) && isset($_POST['haslo_loguj']) && $_SESSION['auth'] == FALSE) {
          
        if (!empty($_POST['login_loguj']) && !empty($_POST['haslo_loguj'])) {
          
        
        $login = mysql_real_escape_string($_POST['login_loguj']);
        $haslo = mysql_real_escape_string($_POST['haslo_loguj']);
        
        
        $haslo = md5($haslo);
        
        
        $sql = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `login` = '$login' AND `haslo` = '$haslo' AND aktywne='1'"));
        
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
                
                //require_once('navmenu.php');
				echo '<meta http-equiv="refresh" content="0.5; URL=index.php">';
				echo '<hr /><h3><center><p style="padding-top:10px;"><strong>Proszę czekać...</strong><br>trwa logowanie i wczytywanie danych</center></h3></p>';
            }	
            elseif ($sql1 == 1) {
                require_once('header.php');
				require_once('navmenulogout.php');
				echo '<h3><center>Konto jest nieaktywne <br>';
                echo '<a href="aktywuj.php?kod='.$kod.'&login='.$login.'">aktywuj konto<br></a>';
                echo '<a href="index.php" style="">Wróć do formularza</a></p></center></h3>';
                                
            }
            else {
				$page_title = 'Błędne logowanie';
				require_once('header.php');
				require_once('navmenulogout.php');
                echo '<h3><center><p style="padding-top:10px;color:red">Blad podczas logowania do systemu<br>';
                echo '<a href="index.php" style="">Wróć do formularza</a></p></center></h3>';
            }
        }
        else {
			$page_title = 'Błędne logowanie';
			require_once('header.php');
			require_once('navmenulogout.php');
            echo '<h3><center><p style="padding-top:10px;color:red">Blad podczas logowania do systemu<br>';
            echo '<a href="index.php" style="">Wróć do formularza</a></p></center></h3>';    
        }
		
    }
	
    elseif ($_SESSION['auth'] == TRUE && !isset($_GET['logout'])) {
		$page_title = 'Strona startowa';
        require_once('header.php');
        require_once('navmenu.php');
		
		echo '<div class="container"><h3><p style="padding-top:10px;"> Witaj '.$_SESSION['user'].', <br><br> obecnie znajdujesz się na stronie głównej serwisu rejesetracyjnego i logującego z możliwością zmiany danych. W przypadku zapomnienia hasła na stronie głównej logowania jest opcja przypomnij hasło, która generuje wiadomość z nowym hasłem i wysyła na adres email wprowdzony przy rejestracji. Nowe hasło można zmienić w odpowiedniej zakładce, w razie błędnego wprowadzenia danych masz jeszcze dwa dni od rejestracji na poprawę.<br><br>Pozdrawiam<br>Administrator serwisu ;)</p></h3></div>';
		}
       /* echo '<meta http-equiv="refresh" content="1; URL=hide1.php">';
        echo '<hr /><h3><center><p style="padding-top:10px;"><strong>Proszę czekać...</strong><br>trwa wczytywanie danych</center></h3></p>';
   */ 
	
	
?>



<?php
require_once('footer.php');
?>


<nav class="container navbar navbar-default navbar-fixed-bottom" role="navigation">
  <div class="container-fluid">
  <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Rozwiń nawigację</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     <ul class="nav navbar-nav navbar-left">
		
		<li><button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#loguj">Loguj</button></li>
	</ul>
	<ul class="nav navbar-text navbar-center">
	<li>Prawa autorskie by BaD</li>
	</ul>
  <ul class="nav navbar-nav navbar-right">
		<li><button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#generuj">Generuj hasło</button></li>
        <li><button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#rejestruj">Rejestracja</button></li>
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>

