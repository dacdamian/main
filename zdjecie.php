<?php
	require_once('db.php');
?>

<?php 

		if ($_SESSION['auth'] == TRUE) {
        
         
        $user = $_SESSION['user'];
          
        $wynik = mysql_query("SELECT zdjecie FROM users WHERE login='$user'") or die('blad zapytania');
		
			if(mysql_num_rows($wynik) > 0 ) {
	  
            while($r = mysql_fetch_assoc($wynik)) {
             
			 
			echo '<img src="data:image/jpeg;base64,'.base64_encode($r['zdjecie']).'"width="'.$foto_size.'"/>';
			}}}
	?>
