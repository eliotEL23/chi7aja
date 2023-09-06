<?php
$host = "localhost";
$user = "root";
$dbname = "stagiarealten";
$password = "";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Error connecting: " . mysqli_connect_error());
}

 if (isset($_POST["cin"])) {
     $cin = $_POST["cin"];
 } else {
     $cin = "";
 }

 if (isset($_POST["nom"])) {
     $nom = $_POST["nom"];
 } else {
     $nom = "";
 }

 if (isset($_POST["prenom"])) {
     $prenom = $_POST["prenom"];
 } else {
     $prenom = "";
 }

 if (isset($_POST["genre"])) {
     $gnr = $_POST["genre"];
 } else {
     $gnr = "";
 }

 if (isset($_POST["dateNaissance"])) {
     $dN = $_POST["dateNaissance"];
 } else {
     $dN = "";
 }

 if (isset($_POST["adresse"])) {
     $adr = $_POST["adresse"];
 } else {
     $adr = "";
 }

 if (isset($_POST["email"])) {
     $eml = $_POST["email"];
 } else {
     $eml = "";
 }

 if (isset($_POST["telephone"])) {
     $tel = $_POST["telephone"];
 } else {
     $tel = "";
 }

 if (isset($_POST["ecole"])) {
     $ecl = $_POST["ecole"];
 } else {
     $ecl = "";
 }

 if (isset($_POST["adresseEcole"])) {
     $adrEcole = $_POST["adresseEcole"];
 } else {
     $adrEcole = "";
 }


 if (isset($_POST["fixEcole"])) {
     $fixEcole = $_POST["fixEcole"];
 } else {
     $fixEcole = "";
 }

 if (isset($_POST["filiere"])) {
     $flr = $_POST["filiere"];
 } else {
     $flr = "";
 }

 if (isset($_POST["encadrantAcd"])) {
     $encadrantAcd = $_POST["encadrantAcd"];
 } else {
     $encadrantAcd = "";
 }

 if (isset($_POST["encadrantTel"])) {
     $encadrantTel = $_POST["encadrantTel"];
 } else {
     $encadrantTel = "";
 }

 if (isset($_POST["encadrantEmail"])) {
     $encadrantEmail = $_POST["encadrantEmail"];
 } else {
     $encadrantEmail = "";
 }

 if (isset($_POST["periodeSouhaitee"])) {
     $prd = $_POST["periodeSouhaitee"];
 } else {
     $prd = "";
 }

 if (isset($_POST["departement"])) {
    $departement = $_POST["departement"];
} else {
    $departement = "";
}

if (isset($_POST["dateDebut"])) {
    $dateDebut = $_POST["dateDebut"];
} else {
    $dateDebut = "";
}

if (isset($_POST["dateFin"])) {
    $dateFin = $_POST["dateFin"];
} else {
    $dateFin = "";
}

 if (isset($_FILES["pieces"]["name"])) {
     $nomPiece = $_FILES["pieces"]["name"];
     $file_tmp_name = $_FILES["pieces"]["tmp_name"];
     move_uploaded_file($file_tmp_name, "./Pieces/$nomPiece");
 } else {
     $nomPiece = "";
 }

 $req = "INSERT INTO stagiareform (Nom, Prenom, Genre, CIN, DateN, Email, telephone, Adresse, Ecole, AdresseEcole ,FixEcole, Filiere, EncadrantAcd, EncadrantTel, EncadrantEmail, PeriodeStage,Departement, DateDebut, DateFin, Pieces) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

 $stmt = mysqli_stmt_init($conn);

 if (!mysqli_stmt_prepare($stmt, $req)) {
     die("Error preparing statement: " . mysqli_error($conn));
 }

 mysqli_stmt_bind_param($stmt, "ssssssssssssssssssss", $nom, $prenom, $gnr, $cin, $dN, $eml, $tel, $adr, $ecl, $adrEcole ,$fixEcole, $flr, $encadrantAcd, $encadrantTel, $encadrantEmail, $prd, $departement ,$dateDebut , $dateFin, $nomPiece);

 if (mysqli_stmt_execute($stmt)) {
     $lastInsertedId = mysqli_insert_id($conn);  //Get the ID of the last inserted record
    
     $certificateCount = $_POST["certificateCount"];
     $formationCount = $_POST["formationCount"];
          //Insert certificates
         for ($i = 1; $i <= $certificateCount; $i++) {
             $certificatId = $_POST["certificat" . $i];
             $nomCertificat = $_POST["nomCertificat" . $i];
             $programme = $_POST["programme" . $i];
             $dateObtention = $_POST["dateObtention" . $i];
    
             $certReq = "INSERT INTO certificates (Id, NomCertificat, Programme, DateObtention, StagiaireId)
                 SELECT ?, ?, ?, ?, CIN FROM stagiareform WHERE CIN = ?
                 ON DUPLICATE KEY UPDATE
                 NomCertificat = VALUES(NomCertificat),
                 Programme = VALUES(Programme),
                 DateObtention = VALUES(DateObtention)";
    
             $certStmt = mysqli_stmt_init($conn);
             if (mysqli_stmt_prepare($certStmt, $certReq)) {
                 mysqli_stmt_bind_param($certStmt, "sssss", $certificatId, $nomCertificat, $programme, $dateObtention, $cin);
                 mysqli_stmt_execute($certStmt);
             } else {
                 echo "Error preparing statement for certificates: " . mysqli_error($conn);
             }
             mysqli_stmt_close($certStmt);
    
         }
    
          //Insert formations
         for ($i = 1; $i <= $formationCount; $i++) {
             $formationId = $_POST["formationID" . $i];
             $formationTitre = $_POST["formationTitre" . $i];
             $etablissement = $_POST["etablissement" . $i];
             $branche = $_POST["branche" . $i];
             $dateDebut = $_POST["dateDebut" . $i];
             $dateFin = $_POST["dateFin" . $i];
    
             $formReqSelect = "INSERT INTO formations (Id, FormationTitre, Etablissement, Branche, DateDebut, DateFin, StagiaireId)
                 SELECT ?, ?, ?, ?, ?, ?, CIN FROM stagiareform WHERE CIN = ?";
             $formStmtSelect = mysqli_stmt_init($conn);
             if (mysqli_stmt_prepare($formStmtSelect, $formReqSelect)) {
                 mysqli_stmt_bind_param($formStmtSelect, "sssssss", $formationId, $formationTitre, $etablissement, $branche, $dateDebut, $dateFin, $cin);
                 mysqli_stmt_execute($formStmtSelect);
                 mysqli_stmt_close($formStmtSelect);
             } else {
                     echo "Error preparing statement for formations (SELECT): " . mysqli_error($conn);
                     continue;  //Skip to the next iteration if there's an error
                     }
    
      //If the above INSERT didn't happen, it means the formation with Formation_ID already exists,
      //so try to update using INSERT INTO ... VALUES ... ON DUPLICATE KEY UPDATE ...
                     $formReqInsertOrUpdate = "INSERT INTO formations (Id, FormationTitre, Etablissement, Branche, DateDebut, DateFin, StagiaireId)
                     VALUES (?, ?, ?, ?, ?, ?, ?)
                     ON DUPLICATE KEY UPDATE
                     FormationTitre = VALUES(FormationTitre),
                     Etablissement = VALUES(Etablissement),
                     Branche = VALUES(Branche),
                     DateDebut = VALUES(DateDebut),
                     DateFin = VALUES(DateFin)";
             $formStmtInsertOrUpdate = mysqli_stmt_init($conn);
         if (mysqli_stmt_prepare($formStmtInsertOrUpdate, $formReqInsertOrUpdate)) {
     mysqli_stmt_bind_param($formStmtInsertOrUpdate, "sssssss", $formationId, $formationTitre, $etablissement, $branche, $dateDebut, $dateFin, $cin);
     mysqli_stmt_execute($formStmtInsertOrUpdate);
     mysqli_stmt_close($formStmtInsertOrUpdate);
     } else {
     echo "Error preparing statement for formations (INSERT/UPDATE): " . mysqli_error($conn);
     }
     }
    
    
         echo "Data Saved";
     } else {
         echo "Error saving data: " . mysqli_stmt_error($stmt);
     }
    
 mysqli_stmt_close($stmt);
 mysqli_close($conn);
 ?>
