<?php
$rozmiar_obrazu = '60';
session_start();



 if ($_SESSION['auth'] == TRUE) {

$user = $_SESSION['user'];
          
        $wynik = mysql_query("SELECT * FROM users WHERE login='$user'") or die('blad zapytania');
  
        if(mysql_num_rows($wynik) > 0 ) {
	  
            while($r = mysql_fetch_assoc($wynik)) {
              
                $aktywne = $r['aktywne'];   
                
?>

<nav class="container navbar navbar-default" role="navigation">
 <div class="container-fluid">
  <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Rozwiń nawigację</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img src="bootstrap/standard.png" width="28" height="28"></a>
    </div>
    
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-left">
	 
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opcje <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="hide1.php">Moje dane</a></li>
            <li><a href="hide2.php">Edycja danych</a></li>
            <li><a href="hide3.php">Zmiana hasla</a></li>
			<li><a href="hide4.php">Zmiana zdjęcia</a></li>
			<?php if ($aktywne == 2){ ?>
			<li class="divider"></li>
			<li><a href="users.php">Użytkownicy</a></li>
			<? }?>
            <li class="divider"></li>
			<li><a href="http://10.10.2.194/ajax-chat/distribution/sample.php" target="_blink">Chat</a></li>
            <li class="divider"></li>
            <li><a href="#">Instrukcja obslugi</a></li>
            <li class="divider"></li>
            <li><a href="#">Pomoc</a></li>
			<li class="divider"></li>
			<li><a href="//10.10.10.10/pma" target="blank">PHPMyAdm</a></li>
			<li class="divider"></li>
            <li><a href="wyloguj.php">Wyloguj</a></li>
          </ul>
        </li>
		
		<li><a href="zamowienia.php">Zamówienia</a></li>
		
		<li><a href="menu.php">Menu</a></li>
		<?php if ($aktywne == 2){ ?>
		<li><a href="skladniki.php">Skladniki</a></li>
		<li><a href="menu.php">Edycja menu</a></li>
		<? }}}?>
	</ul>
	<ul class="nav navbar-nav navbar-right">
		<li>
		<?php 

		if ($_SESSION['auth'] == TRUE) {
		$page_title = 'Dane uzytkownika';
        
         
        $user = $_SESSION['user'];
          
        $wynik = mysql_query("SELECT zdjecie FROM users WHERE login='$user'") or die('blad zapytania');
		
			if(mysql_num_rows($wynik) > 0 ) {
	  
            while($r = mysql_fetch_array($wynik)) {
             
			 
			echo '<img src="data:image/jpeg;base64,'.base64_encode($r['zdjecie']).'"width="'.$rozmiar_obrazu.'"/>';
		}}}
	?>
		</li>
	</ul>
	 <ul class="nav navbar-nav navbar-right">
		<li><a href="wyloguj.php" class="navbar-link">Wyloguj<br></a> &nbsp </li>
    </ul>
	
	<ul class="nav navbar-text navbar-right">
		<li>Zalogowany jako: <?php echo ' '. $_SESSION['user'] . '&nbsp'; ?> &nbsp </li>
	
	</ul>
     
   
    </div><!-- /.navbar-collapse -->
	
  </div><!-- /.container -->
  
</nav>
</div>

<nav class="container navbar navbar-default navbar-fixed-bottom" style="background: white">
<div class="container-fluid">
  <div class="navbar-header">
      <a class="navbar-brand" href="index.php"><img src="bootstrap/standard.png" width="28" height="28"></a>
    </div>
    
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-left">
	 
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="hide1.php">Dane konta</a></li>
            <li><a href="hide2.php">Edycja danych</a></li>
            <li><a href="hide3.php">Zmiana hasla</a></li>
			<li><a href="hide4.php">Zmiana zdjęcia</a></li>
			<li class="divider"></li>
			<li><a href="users.php">Użytkownicy</a></li>
            <li class="divider"></li>
			<li><a href="http://10.10.2.194/ajax-chat/distribution/sample.php" target="_blink">Chat</a></li>
            <li class="divider"></li>
            <li><a href="#">Instrukcja obslugi</a></li>
            <li class="divider"></li>
            <li><a href="#">Pomoc</a></li>
			<li class="divider"></li>
            <li><a href="wyloguj.php">Wyloguj</a></li>
          </ul>
        </li>
	</ul>
	<ul class="nav navbar-text navbar-left">
		<li>Prawa autorskie by BaD</li>
	</ul>
	<ul class="nav navbar-text navbar-right">
		<li> Zalogowany jako: <?php echo ' "'. $_SESSION['user'] . '" .'; ?> </li>
	</ul>
     
   
    </div><!-- /.navbar-collapse -->
	
  </div><!-- /.container -->
  
</nav>

<?php
 }else{
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
		<li><a href="index.php" class="navbar-link">Logowanie</a></li>
		<li><a href="menu.php" class="navbar-link">Menu</a></li>
		
	</ul>
	<ul class="nav navbar-nav navbar-right">
		<li><a href="nowe_haslo.php" class="navbar-link">Generuj hasło</a></li>
        <li><a href="rejestracja.html" class="navbar-link">Rejestracja</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>
</div>
<?php
 }
 ?>