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

        
  function createTable(){

    $connexionBDD = connect_bd();

    echo "<script>
      console.log(\"Entrer fonction createTable\");
                
                var table = document.createElement('table');
                var thead = document.createElement('thead');
                var tbody = document.createElement('tbody');

                //lier le thead et le tbody en tant qu'enfant de la balise table
                table.appendChild(thead);
                table.appendChild(tbody);

                //Intégrer le tableau entier dans Div3
                var div = document.getElementById('Div3');
                div.appendChild(table);

                //Ajout d'éléments tr, th et td
                var row_1 = document.createElement('tr');
                var heading_1 = document.createElement('th');
                heading_1.innerHTML = \" Matière \";
                var heading_2 = document.createElement('th');
                heading_2.innerHTML = \"Etudiant.e\";
                var heading_3 = document.createElement('th');
                heading_3.innerHTML = \"Moyenne\";


                row_1.appendChild(heading_1);
                row_1.appendChild(heading_2);
                row_1.appendChild(heading_3);
                thead.appendChild(row_1);

                //Ajouter les données dans le tbody
                

    ";

       $reqP2= 'SELECT NOM, PRENOM, LBLLMTR, AVG(VALEUR) AS MOYENNE
                                     FROM user, matiere, note
                                     WHERE matiere.IDMTR = note.IDMTR
                                     AND user.IDUSR = note.IDUSR
                                     GROUP BY matiere.IDMTR, user.IDUSR
                                     ORDER BY NOM ASC';

            foreach ($connexionBDD->query($reqP2) as $row) {

              echo "var row_2 = document.createElement('tr');

                    var row_2_data_1 = document.createElement('td');
                    row_2_data_1.innerHTML = \" ".$row['LBLLMTR']." \";
                    var row_2_data_2 = document.createElement('td');
                    row_2_data_2.innerHTML = \" ".$row['NOM']." \";
                    var row_2_data_3 = document.createElement('td');
                    row_2_data_3.innerHTML = \" ".$row['MOYENNE']." \";";


               echo " row_2.appendChild(row_2_data_1);
                      row_2.appendChild(row_2_data_2);
                      row_2.appendChild(row_2_data_3);
                      tbody.appendChild(row_2); ";



                     if ($row['MOYENNE'] >= 14 ) {
                        echo " console.log(\"Moyenne 14 ou +\");
                        row_2.style.background = \" green \";";
                      }
                      else if ($row['MOYENNE'] >= 10 ) {
                         
                        echo "console.log(\"Moyenne 10 ou +\");
                        row_2.style.background = \" orange \";";
                      } 
                      else if ($row['MOYENNE'] <= 10 ) {
                         
                        echo "console.log(\"Moyenne 10 ou -\");
                        row_2.style.background = \" red \";";
                      }



              }// Fin foreach

              

    echo " row_2.appendChild(row_2_data_1);
            row_2.appendChild(row_2_data_2);
            row_2.appendChild(row_2_data_3);
            tbody.appendChild(row_2);



    </script>";




 } //Fin fonction

?>

