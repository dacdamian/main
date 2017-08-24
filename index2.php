<?php


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>A Cool Login System With PHP MySQL &amp jQuery | Tutorialzine demo</title>
    
    <link rel="stylesheet" type="text/css" href="demo.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="login_panel/css/slide.css" media="screen" />
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    
    <!-- PNG FIX for IE6 -->
    <!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
    <!--[if lte IE 6]>
        <script type="text/javascript" src="login_panel/js/pngfix/supersleight-min.js"></script>
    <![endif]-->
    
    <script src="login_panel/js/slide.js" type="text/javascript"></script>
    
    <?php echo $script; ?>
</head>

<body>

<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			
            
            
            <?php
			
			if(!$_SESSION['id']):
			
			?>
            
			<div class="left">
				<!-- Login Form -->
				<form class="clearfix" action="" method="post">
					<h1>Login użytkownika</h1>
                    
                    <?php
						
						if($_SESSION['msg']['login-err'])
						{
							echo '<div class="err">'.$_SESSION['msg']['login-err'].'</div>';
							unset($_SESSION['msg']['login-err']);
						}
					?>
					
					<label class="grey" for="username">Login:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="password">Hasło:</label>
					<input class="field" type="password" name="password" id="password" size="23" />
					<input type="submit" name="submit" value="Login" class="bt_login" />
				</form>
			</div>
			<div class="left right">			
				<!-- Register Form -->
				<form class="clearfix" action="rejestracja.php" method="POST">


				<h1>Formularz rejestracyjny</h1>
		
                    
                    <?php
						
						if($_SESSION['msg']['reg-err'])
						{
							echo '<div class="err">'.$_SESSION['msg']['reg-err'].'</div>';
							unset($_SESSION['msg']['reg-err']);
						}
						
						if($_SESSION['msg']['reg-success'])
						{
							echo '<div class="success">'.$_SESSION['msg']['reg-success'].'</div>';
							unset($_SESSION['msg']['reg-success']);
						}
					?>
                    		
					
<form>
<div class="form-group" id="frmCheckUsername">
<div class="col-md-4">
  <label class="grey" for="Login">Login</label>
  <input id="login" name="login" type="text" placeholder="login" class="form-control input-md" required="" onBlur="checkAvailability()" size="23">
  <span class="komunikat" id="user-availability-status"></span>
 </div>
  </div>


<div class="form-group">
  <label class="col-md-4 control-label" for="haslo">Haslo</label>
  <div class="col-md-4">
    <input id="haslo" name="haslo" type="password" placeholder="Haslo" class="form-control input-md" required="">
    <span class="komunikat"></span>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="haslo2">Powtorz haslo</label>
  <div class="col-md-4">
    <input id="haslo2" name="haslo2" type="password" placeholder="wpisz ponownie haslo" class="form-control input-md" required="">
    <span class="komunikat"></span>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="imie">Imie</label>  
  <div class="col-md-4">
  <input id="imie" name="imie" type="text" placeholder="imie" class="form-control input-md" required="">
  <span class="komunikat"></span>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="nazwisko">Nazwisko</label>  
  <div class="col-md-4">
  <input id="nazwisko" name="nazwisko" type="text" placeholder="nazwisko" class="form-control input-md" required="">
  <span class="komunikat"></span>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="data_urodzenia">Data urodzenia</label>  
  <div class="col-md-4">
  <input id="data_urodzenia" name="data_urodzenia" type="date" placeholder="data" class="form-control input-md" required="" value="rrrr-mm-dd">
  <span class="komunikat"></span>  
  </div>
</div>


<div class="form-group" id="frmCheckEmail">
  <label class="col-md-4 control-label" for="email">E-mail</label>  
  <div class="col-md-4">
  <input id="email" name="email" type="text" placeholder="email" class="form-control input-md" required="" onBlur="checkAvailability()">
  <span class="komunikat" id="email-availability-status"></span>  
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <input id="submit" name="submit" class="bt_register" value="Zarejestruj"/>
  </div>
</div>

</fieldset>

</form>
			</div>
            
            <?php
			
			else:
			
			?>
            
            <div class="left">
            
            <h1>Panel użytkownika</h1>
            
            <p>You can put member-only data here</p>
            <a href="registered.php">Zobacz strony dla zalogowanych</a>
            <p>- or -</p>
            <a href="?logoff">Wyloguj</a>
            
            </div>
            
            <div class="left right">
            </div>
            
            <?php
			endif;
			?>
		</div>
	</div> <!-- /login -->	
	

    <!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
	    	<li class="left">&nbsp;</li>
	        <li>Witaj <?php echo $_SESSION['usr'] ? $_SESSION['usr'] : 'Gościu';?>!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#"><?php echo $_SESSION['id']?'Open Panel':'Zaloguj | Zarejestruj';?></a>
				<a id="close" style="display: none;" class="close" href="#">Zwiń panel</a>			
			</li>
	    	<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->

<div class="pageContent">
    <div id="main">
      <div class="container">
        <h1>Strona główna</h1>
        </div>
        
        <div class="container">
        <p>To jest strona główna serwisu logowania i rejestracji.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis gravida arcu. Quisque eget tellus lectus. Fusce non eros massa. Mauris nisl sapien, sagittis at ante eget, eleifend facilisis leo. Integer et porta nibh. Sed id eros eu magna feugiat malesuada rhoncus ac diam. Curabitur venenatis, neque ut tempus sollicitudin, ante lacus porttitor ante, ut varius magna est sed nibh. Aenean tincidunt neque ac elit ultrices molestie. In vitae lectus eu mauris aliquam posuere.

Integer non nunc nisl. Sed justo mi, pellentesque ut vulputate eget, ullamcorper at diam. Integer feugiat fermentum magna, et ultrices magna laoreet efficitur. Vivamus nec neque rutrum, facilisis erat vel, convallis ipsum. Donec tincidunt ex nec viverra consequat. Praesent mauris purus, euismod vestibulum lectus ut, suscipit pellentesque nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris tempus egestas odio, non tincidunt mi convallis ut.

Morbi libero dolor, pellentesque non fermentum non, egestas in odio. Donec rutrum est ut ligula posuere, vel efficitur justo blandit. Proin tincidunt porttitor vehicula. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur auctor nisl luctus dui placerat, non sodales velit imperdiet. Sed a augue nisi. Suspendisse suscipit rutrum justo id congue. Donec vel lobortis tellus.

Praesent sapien turpis, sagittis eget mollis vel, dignissim non tellus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nisi metus, aliquam vitae eleifend non, faucibus et nisi. Suspendisse varius ac arcu nec mattis. Nunc sollicitudin ultricies feugiat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus maximus mauris non malesuada pulvinar. In semper luctus justo, vitae aliquet nulla facilisis non.

Aenean sed nunc est. Sed nisl odio, finibus eget fermentum sit amet, scelerisque nec ipsum. Vivamus cursus magna leo, eget pulvinar justo consectetur quis. Duis sollicitudin lobortis ligula nec suscipit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut scelerisque elementum odio sed efficitur. Suspendisse tristique arcu non tempor euismod. Proin auctor lacus tortor, id hendrerit sapien euismod ac. Aliquam enim diam, dapibus in purus suscipit, euismod tincidunt ante. Mauris porta purus justo, id finibus metus efficitur id.</p>
          <div class="clear"></div>
        </div>
        
      <div class="container tutorial-info">
      <?php
	  require_once('footer1.php');
	  ?>
    </div>
</div>

</body>
</html>