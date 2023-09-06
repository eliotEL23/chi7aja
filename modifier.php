<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modifier Stagiaire</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php
            $host = "localhost";
            $user = "root";
            $dbname = "stagiarealten";
            $password = "";

            $conn = mysqli_connect($host, $user, $password, $dbname);

            if (mysqli_connect_errno()) {
                die("Error connecting: " . mysqli_connect_error());
            }

            if (isset($_GET['CIN'])) {
                $cin = $_GET['CIN'];

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nom = $_POST['nom']; // Retrieve other form data similarly
                    $prenom = $_POST['prenom'];
                    $genre = $_POST['genre'];
                    $dateN = $_POST['daten'];
                    $email = $_POST['email'];
                    $telephone = $_POST['telephone'];
                    $adresse = $_POST['adresse'];
                    $ecole = $_POST['ecole'];
                    $adresseEcole = $_POST['adresseEcole'];
                    $fixEcole = $_POST['fixEcole'];
                    $filiere = $_POST['filiere'];
                    $encadrantAcd = $_POST['encadrantAcd'];
                    $encadrantTel = $_POST['encadrantTel'];
                    $encadrantEmail = $_POST['encadrantEmail'];
                    $periodeStage = $_POST['periodeStage'];
                    $departement = $_POST['departement'];
                    $dateDebut = $_POST['dateDebut'];
                    $dateFin = $_POST['dateFin'];

                    // Update stagiaire's data in the database
                    $updateQuery = "UPDATE stagiareform SET Nom = '$nom', Prenom = '$prenom', Genre = '$genre', DateN = '$dateN', Email = '$email', 
                        telephone = '$telephone', Adresse = '$adresse', Ecole = '$ecole', AdresseEcole = '$adresseEcole', FixEcole = '$fixEcole', 
                        Filiere = '$filiere', EncadrantAcd = '$encadrantAcd', EncadrantTel = '$encadrantTel', EncadrantEmail = '$encadrantEmail', 
                        PeriodeStage = '$periodeStage' Departement = '$departement' DateDebut = '$dateDebut' DateFin = '$dateFin' WHERE CIN = '$cin'";
                        
                    if (mysqli_query($conn, $updateQuery)) {
                        echo "<p>Stagiaire data updated successfully.</p>";
                        // Redirect to view page or list page
                    } else {
                        echo "<p>Error updating data: " . mysqli_error($conn) . "</p>";
                    }
                } else {
                    // Retrieve stagiaire's existing data
                    $query = "SELECT * FROM stagiareform WHERE CIN = '$cin'";
                    $result = mysqli_query($conn, $query);
                    $stagiaireData = mysqli_fetch_assoc($result);

                    if ($stagiaireData) {
                        // Display a form pre-filled with existing data
                        echo "<h2>Modifier Stagiaire</h2>";
                        echo "<form method='post'>";
                        echo "<div class='form-group'>
                            <label for='nom'>Nom:</label>
                            <input type='text' class='form-control' id='nom' name='nom' value='" . $stagiaireData['Nom'] . "'>
                        </div>";
                        echo "<div class='form-group'>
                        <label for='prenom'>Prenom:</label>
                        <input type='text' class='form-control' id='prenom' name='prenom' value='" . $stagiaireData['Prenom'] . "'>
                    </div>";
                        echo "<div class='form-group'>
                        <label for='genre'>Genre:</label>
                        <input type='text' class='form-control' id='genre' name='genre' value='" . $stagiaireData['Genre'] . "'>
                    </div>";
                        echo "<div class='form-group'>
                        <label for='daten'>DateN:</label>
                        <input type='date' class='form-control' id='daten' name='daten' value='" . $stagiaireData['DateN'] . "'>
                    </div>";
                        echo "<div class='form-group'>
                        <label for='email'>Email:</label>
                        <input type='text' class='form-control' id='email' name='email' value='" . $stagiaireData['Email'] . "'>
                    </div>";
                        echo "<div class='form-group'>
                        <label for='telephone'>Prenom:</label>
                        <input type='text' class='form-control' id='telephone' name='telephone' value='" . $stagiaireData['telephone'] . "'>
                    </div>";
                        echo "<div class='form-group'>
                        <label for='Adresse'>Prenom:</label>
                        <input type='text' class='form-control' id='adresse' name='adresse' value='" . $stagiaireData['Adresse'] . "'>
                    </div>";
                    echo "<div class='form-group'>
                        <label for='ecole'>École:</label>
                        <input type='text' class='form-control' id='ecole' name='ecole' value='" . $stagiaireData['Ecole'] . "'>
                    </div>";
                    echo "<div class='form-group'>
                        <label for='adresseEcole'>Adresse de l'École:</label>
                        <input type='text' class='form-control' id='adresseEcole' name='adresseEcole' value='" . $stagiaireData['AdresseEcole'] . "'>
                    </div>";
                    echo "<div class='form-group'>
                        <label for='fixEcole'>Téléphone de l'École:</label>
                        <input type='text' class='form-control' id='fixEcole' name='fixEcole' value='" . $stagiaireData['FixEcole'] . "'>
                    </div>";   
                    echo "<div class='form-group'>
                    <label for='filiere'>Filière:</label>
                    <input type='text' class='form-control' id='filiere' name='filiere' value='" . $stagiaireData['Filiere'] . "'>
                </div>";    
                     echo "<div class='form-group'>
                     <label for='encadrantAcd'>Encadrant Académique:</label>
                     <input type='text' class='form-control' id='encadrantAcd' name='encadrantAcd' value='" . $stagiaireData['EncadrantAcd'] . "'>
                 </div>";

                    echo "<div class='form-group'>
                    <label for='encadrantTel'>Téléphone de l'Encadrant:</label>
                    <input type='text' class='form-control' id='encadrantTel' name='encadrantTel' value='" . $stagiaireData['EncadrantTel'] . "'>
                </div>";

                echo "<div class='form-group'>
                <label for='encadrantEmail'>Email de l'Encadrant:</label>
                <input type='text' class='form-control' id='encadrantEmail' name='encadrantEmail' value='" . $stagiaireData['EncadrantEmail'] . "'>
            </div>";

                echo "<div class='form-group'>
                <label for='periodeStage'>Période de Stage:</label>
                <input type='text' class='form-control' id='periodeStage' name='periodeStage' value='" . $stagiaireData['PeriodeStage'] . "'>
            </div>";

            echo "<div class='form-group'>
            <label for='departement'>Département:</label>
            <input type='text' class='form-control' id='departement' name='departement' value='" . $stagiaireData['Departement'] . "'>
            </div>";
    
            echo "<div class='form-group'>
                    <label for='dateDebut'>Date de Début:</label>
                    <input type='date' class='form-control' id='dateDebut' name='dateDebut' value='" . $stagiaireData['DateDebut'] . "'>
                </div>";
            
            echo "<div class='form-group'>
                    <label for='dateFin'>Date de Fin:</label>
                    <input type='date' class='form-control' id='dateFin' name='dateFin' value='" . $stagiaireData['DateFin'] . "'>
                </div>";
    
                        
                // Add other form fields similarly
                echo "<button type='submit' class='btn btn-primary'>Enregistrer les Modifications</button>";
                echo "</form>";
                    } else {
                        echo "<p>Stagiaire not found.</p>";
                    }
                }
            }

            mysqli_close($conn);
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
