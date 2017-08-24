<?php
  function poczatek_sesji()
  {
    @session_start();
    if (!isset($_SESSION['koszyk']))
    {
      $_SESSION['koszyk']=array('pizza'=>array());
    }
  }

  function do_koszyka($pizza)
  {
    if (!isset($_POST['do_koszyka'])) return;
    if (count($_POST['towary'])===0) return;
    $towary=$_POST['towary'];
    foreach($towary as $towar)
    {
      $id=(int)(substr($towar,0,6));
      $klucz_cena='cena'.$id;
      $klucz_ilosc='ile'.$id;
      if ($pizza)
      {
        $count=count($_SESSION['koszyk']['pizza']);
        $_SESSION['koszyk']['pizza'][$count]['opis']=substr($towar,6);
        $_SESSION['koszyk']['pizza'][$count]['cena']=$_POST[$klucz_cena];
        $_SESSION['koszyk']['pizza'][$count]['ilosc']=$_POST[$klucz_ilosc];
      }
      else
      {
       
    }
  } 
  }  

  function pusty_koszyk()
  {
    if (!isset($_POST['pusty_koszyk'])) return;
    $_SESSION['koszyk']['pizza']=array();
    echo '<br />Koszyk jest pusty!';
  }
  
  function pokaz_koszyk()
  {
    if (!isset($_POST['pokaz_koszyk'])) return;
    $pizza=$_SESSION['koszyk']['pizza'];
    
    echo '<br />';
    if (count($pizza)===0)
    {
      echo 'Koszyk jest pusty!';
      return;
    }
    
    $suma=0;
    if (count($pizza)>0)
    {
      echo 'Pizza:<br />';
      for($k=0;$k<count($pizza);$k++)
      {
        $suma+=$pizza[$k]['cena']*$pizza[$k]['ilosc'];
        echo ($k+1).'. '.$pizza[$k]['opis'].', cena: '
            .$pizza[$k]['cena'].', ilość: '.$pizza[$k]['ilosc'].'<br />'."\n";
      }
    }
    
    echo '<br />Wartość zamówienia w koszyku: '.$suma;    
  }
?>