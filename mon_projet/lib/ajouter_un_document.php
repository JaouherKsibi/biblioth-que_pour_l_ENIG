<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname='projet1';
    if (isset($_POST["submit"])) {
        $nom_doc=htmlentities(trim($_POST["nom_doc"]));
        $lien_doc=htmlentities(trim($_POST["lien_doc"]));
        $matiere=htmlentities(trim($_POST["matiere"]));
        $type_doc=htmlentities(trim($_POST["type_doc"]));
        $niveau =htmlentities(trim($_POST["niveau"]));
        $specialite=htmlentities(trim($_POST["specialite"]));
        $auteur=htmlentities(trim($_POST["auteur"]));
        
        if ($nom_doc&&$lien_doc&&$lien_doc&&$matiere&&$type_doc&&$niveau&&$specialite&&$auteur) {
           
            try{
                $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $sql = "INSERT INTO document(nom_doc,matiere,nom_complet_professeur,niveau_scolaire,type_doc,lien_doc,specialite)VALUES('$nom_doc','$matiere','$auteur','$niveau','$type_doc','$lien_doc','$specialite')";
                
                $dbco->exec($sql);
                echo 'Entrée ajoutée dans la table';
            }
            
            catch(PDOException $e){
              echo "Erreur : " . $e->getMessage();
            }
               
           
        }else {
            echo("s'il vous plait de remplir tous les champs !");
        }

        





    }
?>
