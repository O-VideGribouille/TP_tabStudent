<?php

  //def connexion à BDD MySQL
  define('USER',"root");
  define('PASSWORD',"");
  define('SERVER',"localhost");
  define('BASE',"tpbddscolaire");

  //fonction de connexion à la base pour factoriser :
  function connect_bd(){
   /* $dsn="mysql:dbname=".BASE.";host=".SERVER; */
    $dsn="mysql:host=".SERVER.";dbname=".BASE;

    //On essaie de se connecter
    try{
      $connexion=new PDO($dsn,USER,PASSWORD);

      //On définit le mode d'erreur de PDO sur Exception
      $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      /*echo 'Connexion réussie';*/
      
    }

    /*On capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
    catch(PDOExeption $e){
      echo "Echec de la connexion : %s\n".$e->getMessage();
      exit();
    }
    return $connexion;
  }


?>

<?php
        
            //On ferme la connexio
  //          $conn = null;
        ?>

