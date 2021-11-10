<?php
    //Démarrer la session
    session_start();


    include "fnctn.php";
    $connexionBDD = connect_bd(); // permet l'utilisation au fil de la page

?>


<!DOCTYPE html>
<html>
<head>
    <title>Page Utilisateur.rice</title>

    <meta charset="utf-8">

    <!-- source logo onglet -->
    <link rel="shortcut icon" type="image/x-icon" href="../img/logo/icone.png">

    <!-- code source CSS -->
    <link rel="stylesheet" type="text/css" href="../CSS/index_template.css">
    <link rel="stylesheet" type="text/css" href="../CSS/div_art.css">

    <!-- code source Typographie -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Pacifico:400' rel='stylesheet' type='text/css'>

    <style >
        /*spécial tableau*/
    .tpTab{

            border:3px solid black;
            padding: 4% 2%;
        }

        .tpTab:hover {
            border: 1px solid black;
            opacity: 50%;
        }


    </style>


</head>

<!-- Visuel de la page -->
<body>

    <header id="HBody" name="HBody" class="header_body">
        
        <nav id="Nav" name="Nav" class="navigation">
            
            <div id="DivList" name="DivList">
                 
                <ul id="Ul_nav" name="Ul_nav">
                    <!-- -->
                    <!-- -->
                    <!--<a href="#" class="btn btn-2"> CLICK ME </a>-->

                    <li id="li1" name="li1" class="list_nav btn-2">

                        <a href="#" id="lien1" name="lien1" class="btn"> * </a>  

                    </li> 
                    <!-- -->
                    <!-- -->

                    <li id="li2" name="li2" class="list_nav btn-2"> 

                        <a href="#" id="lien2" name="lien2" class="btn"> Utilisateur </a> 

                    </li>
                    <!-- -->
                    <!-- -->
                    <li id="li3" name="li3" class="list_nav btn-2">

                        <a href="../index.php" id="lien3" name="lien3" class="btn"> Accueil </a> 


                    </li>
                    <!-- -->
                    <!-- -->
            
            <!--    </ul> 
                 -->
                <!-- -->
                <img src="../img/logo/Carte_visite.png" id="logo1" name="icone" class="logo">
                <!-- -->

            <!--    <ul id="Ul_nav" name="Ul_nav">
                     -->
                    <!-- -->

                      <li id="li4Bis" name="li4Bis" class="list_nav btn-2"> 

                          <a href="#" id="lien4Bis" name="lien4Bis" class="btn"> Déconnexion </a> 



                        </li> 

                    <!-- -->
                    <!-- -->
                    <li id="li5" name="li5" class="list_nav btn-2">

                        <a href="#" id="lien5" name="lien5" class="btn"> * </a>   

                    </li>

                    <!-- -->
                    <!-- -->

                    <li id="li6" name="li6" class="list_nav btn-2">

                        <a href="#" id="lien6" name="lien6" class="btn"> * </a> 

                    </li>

                    <!-- -->
                    <!-- -->
            
                </ul> 

            </div>

        </nav>

    </header>
    <!-- -->
    <!-- -->


<?php

         
             //modification d'une note
             if(isset($_POST['Valider'])){

                if(isset($_POST['bttn2'])){

                    //Recupération donnée ?
                  // $reqSubmit = 

                   // foreach($connexionBDD->query($reqSubmit) as $row){


                        //toutes les virification sont faites
                        $POST = $_POST;

                        //fonction de modification
                        function UpdateNote($connexionBDD, $POST){

                            //Mise à jour de la note

                            $reqUpdate = 'UPDATE note
                            SET VALEUR = :VALEUR
                            WHERE IDUSR = \''.$row['IDUSR'].'\'
                            AND IDNT = \''.$row['IDNT'].'\'

                            ';

                            try{
                                //requête préparer
                                $stmt = $connexionBDD->prepare($reqUpdate);

                                //
                                $stmt->binvalue(':VALEUR', $row['VALEUR'], PDO::PARAM_INT);


                                //Exécuter la requête
                                $stmt->execute();

                                //Indication de la mise à jour faite
                                echo "<p>Mise à jour effectué</p>";


                            } // fin try

                            catch(PDOExeption $e){
                                echo 'Erreur : '.$e->getMessage();
                            }// fin Catch

                      //} //Fin foreach

                    } //fin fonction

                    //Enregistrement dans la base de donnée :
                    UpdateNote($connexionBDD, $POST);

                } //fin isset bttn2


             } // fin isset Valider

             ?>



        <!-- Div principale -->
        <div id="DivPrin" name="DivPrin" class="DivArticle">
            <!-- -->
            <!-- -->

            <h1 id="Title1" name="Title1" class="Title_A">Exercice</h1>
            <!-- -->
            <!-- -->

            <h2 id="Title2" name="Title2" class="Title_B"></h2>
            <!-- -->
            <!-- -->
            <pre id="P1" name="P1" class="parag"> </pre>


            

            <!-- -->
            <!-- -->
           <table class="table table-striped">
               <thead>
                    <th class="tpTab">
                        Matière
                    </th>


                    <th class="tpTab">
                        Etudiant.e
                    </th>


                    <th class="tpTab">
                        Note
                    </th>


                    <th class="tpTab">
                        Editer
                    </th>
                   
               </thead>
               <!-- -->
                <!-- -->
                <tbody>

                    <?php  ///---/// 

                    $reqP= 'SELECT DISTINCT NOM, PRENOM, LBLLMTR, VALEUR
                             FROM user, matiere, note
                             WHERE matiere.IDMTR = note.IDMTR
                             AND user.IDUSR = note.IDUSR
                             ORDER BY NOM ASC';

                    $reqMTR = '';

                    $reqUSR ='';

                    $reqNT = '';

                    foreach ($connexionBDD->query($reqP) as $row) {
                        echo "
            
                            <tr>
                                <td class=\"tpTab\">


                                    ".$row['LBLLMTR']."              
                                </td> ";

                        echo "
            
                                
                                    <td class=\"tpTab\">


                                        ".$row['NOM']." ".$row['PRENOM']."              
                                    </td> "; 

                        echo "
            
                                
                                    <td class=\"tpTab\">


                                        ".$row['VALEUR']."                
                                     </td>"; 


                        echo "
            
                                
                                    <td class=\"tpTab\">

                                    <input type=\"text\" name=\"bttn1[]\">

                                    <input type=\"checkbox\" name=\"bttn2[]\">
                                                        
                                    </td> "; 


                    }





            ?> 

                    


                </tbody>

           </table>
            <!-- -->
            <!-- -->
             <input type="submit" name="Valider" value="valider">


    </div>



   


    <!-- -->
    <!-- -->
    <!-- -->
    <footer id="FBody" name="FBody" class="footer_body">
        <!-- -->
        <!-- -->
        <table id="tabF" name="tabF" class="">
            <thead id="tHF1" name="tHF1" class="thFoot">
                <tr id="trF1" name="trF1" class="TRFoot">
                    <th id="thF1" name="thF1" class="THFoot">
                        O'Vide
                    </th>

                    <th id="thF2" name="thF2" class="THfoot">
                        <p>(c) Oriane VICECONTE, Cycle 2</p>
                    </th>

                    <th id="thF3" name="thF3" class="THfoot">
                        <p>2021 - 2022</p>
                    </th>

                    

                    <th id="thF6" name="thF6" class="THfoot Tvide">
                        <p></p>
                    </th>

                    <th id="thF7" name="thF7" class="THfoot">
                        <p><p>Contact</p></p>
                    </th>

                    <th id="thF8" name="thF8" class="THfoot">
                        <p>o.viceconte@ludus-academie.com</p>
                    </th>

                    
                </tr>

                
            </thead>
            <!-- -->
            <!-- -->
            <tbody id="tBF1" name="tBF1" class="tbodyFoot">
            <!--    <tr id="trF2" name="trF2" class="TRFoot">
                    <td id="tdF1" name="tdF1" class="THFoot">
                        Réseaux sociaux
                    </td>
            -->
                

            </tbody>
            <!-- -->
            <!-- -->

        </table>

        <!-- -->
        <!-- -->
    </footer>

</body>
</html>