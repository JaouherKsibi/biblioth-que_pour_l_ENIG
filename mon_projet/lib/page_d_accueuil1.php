<?php
session_start();
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname='projet1'; 
    $adresse_enig=$_POST['adresse_enig'];
    $mot_de_passe=$_POST['password']    ;
    $ok=$_POST['submit'];
    $erreur;
    
    if(isset($ok))
    {
        try{
                $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $req=$dbco->prepare("SELECT nom,prenom,specialite FROM professeur_enig WHERE adresseENIG='$adresse_enig' AND mot_de_passe='$mot_de_passe'");
                $execute_is_ok=$req->execute(array('nom','prenom','specialite'));
                if ($execute_is_ok==false) {
                    $erreur='la connection a la base de données et la récupération des données a échoué!';
                }
                else{
                    $user_exist=$req->rowCount();
                    if ($user_exist==1) {
                        $userinfo=$req->fetch();
                        $nom_professeur=$userinfo['nom'];
                        $prenom_professeur=$userinfo['prenom'];
                        $specialite_professeur=$userinfo['specialite'];
                        $connection=true;
                    }
                    else {
                        $erreur="ce compte n'existe pas s'il vous plait de vérifier l'adresse ou le mot de pasee tapé ";
                    }
                }
                
                

        }catch(PDOException $e){
              echo "Erreur : " . $e->getMessage();
            }
    }
    
    function afficher_document($id_doc,$nom_doc,$matiere,$nom_complet_professeur,$niveau_scolaire,$type_doc,$lien_doc,$specialite1)
    {
       
        
        echo "
                            <article class='col-md-4 col-lg-4 col-xs-12 col-sm-12 document'>
                                <div class='container'>
                                    <p> <em>$type_doc </em></p>
                                    <h2>$nom_doc</h2>
                                    <h6><em>id:</em> $id_doc</h6>
                                    <p><em>matiere:</em> $matiere</p>
                                    <p><em>auteur:</em> $nom_complet_professeur</p>
                                    <p><em>specialite:</em> $specialite1</p>
                                    <p><em>niveau scolaire:</em> $niveau_scolaire </p>
                                    <p><a href='$lien_doc'>voir le document</a></p>
                                </div>
                            </article>"
                            ;
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../img/logoENIG.jpeg" />

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/boostrap-theme.min.css">
    <link rel="stylesheet" href="../css/style_page_d_accueil.css">
    <title>
        acueuil <?php echo "$nom_professeur $prenom_professeur";?>
    </title>
</head>
<body>
    <header>
     <div class="wrapper">
         <div class="logo">
             <img src="../img/logoENIG1.jpeg" alt="logo ENIG">
         </div>
         <ul class="nav-area">
             <li><a href="home_page.html">Home</a></li>
             <li><a href="learn_more_about_enig.html">About</a></li>
             <li><a href="mailto:ksibijaouher@gmail.com">Contact</a></li>
             <li><a href="../lib/profession1.php">Login</a></li>
             <li>
                 <p><img src="../img/logoENIG1.jpeg" alt=" user image"><?php echo "$nom_professeur $prenom_professeur";?></p>
                 
             </li>
             <li><a href="disconnect.php">Log-out</a></li>
         </ul>
        </div>
    </header>
    <div class="container">
        <h2>COURS AJOUTES</h2>
        <div class="container">
            <!--**********************affichage des documents par niveau et par specialite  **********-->
            
            <?php
                $nom_complet_professeur1=$prenom_professeur.' '.$nom_professeur;
                try{
                    
                    $dbco_doc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $dbco_doc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $req_doc=$dbco_doc->prepare("SELECT id_doc,nom_doc,matiere,nom_complet_professeur,niveau_scolaire,type_doc,lien_doc,specialite FROM document WHERE  nom_complet_professeur='$nom_complet_professeur1' AND type_doc='cours'");
                    $execute_is_ok=$req_doc->execute(array('id_doc','nom_doc','matiere','nom_complet_professeur','niveau_scolaire','type_doc','lien_doc','specialite'));
                        if ($execute_is_ok==false) {
                            $erreur='la connection a la base de données et la récupération des documents a échoué!';
                        }
                        else{
                            $docs=$req_doc->fetchAll();
                            $i=1;
                            foreach ($docs as $doc ) {
                            
                                if ($i%3==1) {
                                    echo "<div class=\"row\">";
                                }
                                $id_doc=$doc['id_doc'];
                                $nom_doc=$doc['nom_doc'];
                                $matiere=$doc['matiere'];
                                $nom_complet_professeur=$doc['nom_complet_professeur'];
                                $niveau_scolaire=$doc['niveau_scolaire'];
                                $type_doc=$doc['type_doc'];
                                $lien_doc=$doc['lien_doc'];
                                $specialite1=$doc['specialite'];
                                //echo"<article class='col-md-4 col-lg-4 col-xs-12 col-sm-12'>";
                                afficher_document($id_doc,$nom_doc,$matiere,$nom_complet_professeur,$niveau_scolaire,$type_doc,$lien_doc,$specialite1);
                                //echo "</article>" ;
                                if ($i%3==0) {
                                    echo "</div>";
                                }
                                $i=$i+1;
                                
                            }
                        }

            }catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
                }
                
            ?>
        </div>
        <h2>SERIE D'EXERCICES</h2>
        <div class="container">
            <!--**********************affichage des documents par niveau et par specialite  **********-->
        
            <?php
                try{
                    
                    $dbco_doc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $dbco_doc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $req_doc=$dbco_doc->prepare("SELECT id_doc,nom_doc,matiere,nom_complet_professeur,niveau_scolaire,type_doc,lien_doc,specialite FROM document WHERE nom_complet_professeur='$nom_complet_professeur1' AND type_doc='serie d exercice'");
                    $execute_is_ok=$req_doc->execute(array('id_doc','nom_doc','matiere','nom_complet_professeur','niveau_scolaire','type_doc','lien_doc','specialite'));
                        if ($execute_is_ok==false) {
                            $erreur='la connection a la base de données et la récupération des documents a échoué!';
                        }
                        else{
                            $docs=$req_doc->fetchAll();
                            $i=1;
                            foreach ($docs as $doc ) {
                            
                                if ($i%3==1) {
                                    echo "<div class=\"row\">";
                                }
                                $id_doc=$doc['id_doc'];
                                $nom_doc=$doc['nom_doc'];
                                $matiere=$doc['matiere'];
                                $nom_complet_professeur=$doc['nom_complet_professeur'];
                                $niveau_scolaire=$doc['niveau_scolaire'];
                                $type_doc=$doc['type_doc'];
                                $lien_doc=$doc['lien_doc'];
                                $specialite=$doc['specialite'];
                                //echo"<article class='col-md-4 col-lg-4 col-xs-12 col-sm-12'>";
                                afficher_document($id_doc,$nom_doc,$matiere,$nom_complet_professeur,$niveau_scolaire,$type_doc,$lien_doc,$specialite);
                                //echo "</article>" ;
                                if ($i%3==0) {
                                    echo "</div>";
                                }
                                $i=$i+1;
                                
                            }
                        }

            }catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
                }
                
            ?>
        </div>
        <h2>EXAMEN</h2>
        <div class="container">
            <!--**********************affichage des documents par niveau et par specialite  **********-->
            
            <?php
                try{
                    
                    $dbco_doc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $dbco_doc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $req_doc=$dbco_doc->prepare("SELECT id_doc,nom_doc,matiere,nom_complet_professeur,niveau_scolaire,type_doc,lien_doc,specialite FROM document WHERE nom_complet_professeur='$nom_complet_professeur1' AND type_doc='examen'");
                    $execute_is_ok=$req_doc->execute(array('id_doc','nom_doc','matiere','nom_complet_professeur','niveau_scolaire','type_doc','lien_doc','specialite'));
                        if ($execute_is_ok==false) {
                            $erreur='la connection a la base de données et la récupération des documents a échoué!';
                        }
                        else{
                            $docs=$req_doc->fetchAll();
                            $i=1;
                            foreach ($docs as $doc ) {
                            
                                if ($i%3==1) {
                                    echo "<div class=\"row\">";
                                }
                                $id_doc=$doc['id_doc'];
                                $nom_doc=$doc['nom_doc'];
                                $matiere=$doc['matiere'];
                                $nom_complet_professeur=$doc['nom_complet_professeur'];
                                $niveau_scolaire=$doc['niveau_scolaire'];
                                $type_doc=$doc['type_doc'];
                                $lien_doc=$doc['lien_doc'];
                                $specialite=$doc['specialite'];
                                //echo"<article class='col-md-4 col-lg-4 col-xs-12 col-sm-12'>";
                                afficher_document($id_doc,$nom_doc,$matiere,$nom_complet_professeur,$niveau_scolaire,$type_doc,$lien_doc,$specialite);
                                //echo "</article>" ;
                                if ($i%3==0) {
                                    echo "</div>";
                                }
                                $i=$i+1;
                                
                            }
                        }

            }catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
                }
                
            ?>
        </div>
        <div class="container">
            <form action="ajouter_un_document.html" >
                <button>ajouter un document</button>
            </form>
            <h2><a href="#">ajouter un document</a></h2>
        </div>
    </div>
</body>
</html>