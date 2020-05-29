<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname='projet1';
    if (isset($_POST["submit"])) {
        $nom=htmlentities(trim($_POST["nom_professeur"]));
        $prenom=htmlentities(trim($_POST["prenom_professeur"]));
        $numcin=htmlentities(trim($_POST["cin"]));
        $date_de_naissance=htmlentities(trim($_POST["date_de_naissance"]));
        $email =htmlentities(trim($_POST["email"]));
        $numero_de_telephone=htmlentities(trim($_POST["numero_de_telephone"]));
        $governat=htmlentities(trim($_POST["governat"]));
        $ville_d_origine=htmlentities(trim($_POST["ville_d_origine"]));
        $codepostale=htmlentities(trim($_POST["codepostale"]));
        $specialite=htmlentities(trim($_POST["specialite"]));
        $adresseENIG=htmlentities(trim($_POST["adresseENIG"]));
        $motdepasse1=htmlentities(trim($_POST["motdepasse1"]));
        $motdepasse2=htmlentities(trim($_POST["motdepasse2"]));
        $robot=htmlentities(trim($_POST["robot"]));
        if ( $nom&&$prenom&&$numcin&&$date_de_naissance&&$email&&$numero_de_telephone&&$adresseENIG&&$governat&&$ville_d_origine&&$codepostale&&$specialite&&$motdepasse1&&$motdepasse2&&$robot) {
           if ($motdepasse2==$motdepasse1) {
            try{
                $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $sql = "INSERT INTO professeur_enig(nom,prenom,numcin,date_de_naissance,email,numero_de_telephone,governat,ville_d_origine,code_postale,specialite,mot_de_passe,adresseENIG)VALUES('$nom','$prenom','$numcin','$date_de_naissance','$email','$numero_de_telephone','$governat','$ville_d_origine','$codepostale','$specialite','$motdepasse1','$adresseENIG')";
                
                $dbco->exec($sql);
                echo 'Entrée ajoutée dans la table';
            }
            
            catch(PDOException $e){
              echo "Erreur : " . $e->getMessage();
            }
               
           }else {
               echo ("les deux mots de passe doivent être identiques !");
           }
        }else {
            echo("s'il vous plait de remplir tous les champs !");
        }

        





    }
?>
