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
        /*concerne tableau*/
    .tpTab, .t1{

            border:3px solid black;
            padding: 4% 2%;
        }


        .t1:hover {
            border: 1px solid black;
            opacity: 50%;
        }

        .t1:nth-child(even) {background-color: #006064}
        .t1:nth-child(odd) {background-color: #00BFA5}

        .t2{
           background-color: black;
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

                    



                        //toutes les virification sont faites
                        $POST = $_POST;
                       // var_dump($POST);

                        //fonction de modification
                        function UpdateNote($connexionBDD, $B2, $B1){

                            //Mise à jour de la note

                            $reqUpdate = 'UPDATE note
                            SET VALEUR = :VALEUR
                            WHERE IDNT = :NOTE ;';

                            try{
                                //requête préparée
                                $stmt = $connexionBDD->prepare($reqUpdate);

                                //
                                $stmt->bindValue(':VALEUR', $B1, PDO::PARAM_INT);
                                $stmt->bindValue(':NOTE', $B2, PDO::PARAM_INT);


                                //Exécuter la requête
                                $stmt->execute();

                                //Indication de la mise à jour faite
                                echo "<p>Mise à jour effectué</p>"; //LE RENDRE VISIBLE, EN FAIRE UN ALERT!


                            } // fin try

                            catch(PDOExeption $e){
                                echo 'Erreur : '.$e->getMessage();
                            }// fin Catch


                    } //fin fonction

                    //Enregistrement dans la base de donnée :

                    for ($i=0; $i < sizeof($POST["bttn1"]); $i++) { 
                        UpdateNote($connexionBDD, $POST["bttn2"][$i],$POST["bttn1"][$i]);
                    }


                } //fin isset bttn2


             } // fin isset Valider

             ?> 



        <!-- Div principale -->
        <div id="DivPrin" name="DivPrin" class="DivArticle">
            <!-- -->
            <!-- -->

            <h1 id="Title1" name="Title1" class="Title_A">Tableau Editable</h1>
            <!-- -->
            <!-- -->

            <h2 id="Title2" name="Title2" class="Title_B"></h2>
            <!-- -->
            <!-- -->
            <pre id="P1" name="P1" class="parag"> </pre>


            

            <!-- -->
            <!-- -->
            <form action="" method="post">
                   <table class="table table-striped">
                       <thead class="t2">
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

                            $reqP= 'SELECT DISTINCT NOM, PRENOM, LBLLMTR, VALEUR, IDNT
                                     FROM user, matiere, note
                                     WHERE matiere.IDMTR = note.IDMTR
                                     AND user.IDUSR = note.IDUSR
                                     ORDER BY NOM ASC';


                            foreach ($connexionBDD->query($reqP) as $row) {
                                echo "
                    
                                    <tr class=\"t1\">
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

                                             //td class chk -> ne peut pas être modifié
                                echo "
                    
                                        
                                            <td class=\"tpTab chk\">

                                            <input type=\"text\" name=\"bttn1[]\" disabled required>

                                            </td>

                                            <td class=\"tpTa\">

                                            <input type=\"checkbox\" name=\"bttn2[]\" onchange = \"ValCheck(this)\" value=\"".$row["IDNT"]."\">
                                                                
                                            </td> 

                                            </tr>"; 


                            }






                    ?> 
                    <script type="text/javascript">

                        //rend éditable la note et ne prend pas en compte les notes non modifiées
                            
                            function ValCheck(valeur) {
                                console.log("coucou");

                                if(valeur.checked == true){
                                    valeur.parentNode.parentNode.querySelector(".chk").querySelector("input").disabled = false;
                                }else {
                                    valeur.parentNode.parentNode.querySelector(".chk").querySelector("input").disabled = true;
                                }

                            }

                    </script>

                            


                        </tbody>

                   </table>
                    <!-- -->
                    <!-- -->
                    
                     <input type="submit" name="Valider" value="valider">

        </form>
    </div>


     <!-- Div principale -->
        <div id="Div2" name="Div2" class="DivArticle">
            <!-- -->
            <!-- -->

            <h1 id="Title3" name="Title3" class="Title_A">Tableau Moyenne</h1>
            <!-- -->
            <!-- -->

            <h2 id="Title4" name="Title4" class="Title_B"></h2>
            <!-- -->
            <!-- -->
            <pre id="P2" name="P2" class="parag"> </pre>


            

            <!-- -->
            <!-- -->
           
                   <table class="table table-striped">
                       <thead class="t2">
                            <th class="tpTab">
                                Matière
                            </th>


                            <th class="tpTab">
                                Etudiant.e
                            </th>


                            <th class="tpTab">
                                Moyenne
                            </th>
                           
                       </thead>
                       <!-- -->
                        <!-- -->
                        <tbody>

                            <?php  ///---/// 

                            $reqP= 'SELECT NOM, PRENOM, LBLLMTR, AVG(VALEUR) AS MOYENNE
                                     FROM user, matiere, note
                                     WHERE matiere.IDMTR = note.IDMTR
                                     AND user.IDUSR = note.IDUSR
                                     GROUP BY matiere.IDMTR, user.IDUSR
                                     ORDER BY NOM ASC';


                            foreach ($connexionBDD->query($reqP) as $row) {
                                echo "
                    
                                    <tr class=\"t1\">
                                        <td class=\"tpTab\">


                                            ".$row['LBLLMTR']."              
                                        </td> ";

                                echo "
                    
                                        
                                            <td class=\"tpTab\">


                                                ".$row['NOM']." ".$row['PRENOM']."              
                                            </td> "; 



                                echo "
                    
                                        
                                            <td class=\"tpTab\">

                                                ".$row['MOYENNE']." 
                                                               
                                             </td>"; 

                                             
                              

                            }






                    ?> 

                            


                        </tbody>

                   </table>
                    <!-- -->
                    <!-- -->
                    
              
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