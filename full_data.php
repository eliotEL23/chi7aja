<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Details</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https:stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Your-Font-Family', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 30px;
        }

        /* Navbar styling */
        .navbar {
            background-color: #343a40;
        }

        .navbar-brand {
            color: #ffffff;
            font-size: 24px;
        }

        .navbar-dark .navbar-toggler-icon {
            border-color: #ffffff;
        }

        /* Page content styling */
        h2 {
            color: #343a40;
        }

        p {
            color: #555;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #343a40;
            color: #ffffff;
        }

        /* Styling for certificate and formation tables */
        .certificates-table, .formations-table {
            margin-top: 20px;
        }

        /* Button styling */
        .btn-primary {
            background-color: #007BFF;
            border-color: #007BFF;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-3">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Datails Stagiaire</a>
        </nav>

        <!-- Full Data -->
        <div class="mt-5">
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
                $stagiaireID = $_GET['CIN'];

                $query = "SELECT * FROM stagiareform WHERE CIN = ?";
                $stmt = mysqli_stmt_init($conn);

                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, "i", $stagiaireID);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $stagiaireData = mysqli_fetch_assoc($result);

                     //Display the full data
                    if ($stagiaireData) {
                        echo "<h2>" . $stagiaireData['Nom'] . " " . $stagiaireData['Prenom'] . "</h2>";
                        echo " " . $stagiaireData['CIN'] . "</p>";
                        echo " " . $stagiaireData['Genre'] . "</p>";
                        echo " " . $stagiaireData['DateN'] . "</p>";
                        echo " " . $stagiaireData['Email'] . "</p>";
                        echo " " . $stagiaireData['telephone'] . "</p>";
                        echo " " . $stagiaireData['Adresse'] . "</p>";
                        echo " " . $stagiaireData['Ecole'] . "</p>";
                        echo " " . $stagiaireData['AdresseEcole'] . "</p>";
                        echo " " . $stagiaireData['FixEcole'] . "</p>";
                        echo " " . $stagiaireData['Filiere'] . "</p>";
                        echo " " . $stagiaireData['EncadrantAcd'] . "</p>";
                        echo " " . $stagiaireData['EncadrantTel'] . "</p>";
                        echo " " . $stagiaireData['EncadrantEmail'] . "</p>";
                        echo " " . $stagiaireData['PeriodeStage'] . "</p>";
                        echo " " . $stagiaireData['Departement'] . "</p>";
                        echo " " . $stagiaireData['DateDebut'] . "</p>";
                        echo " " . $stagiaireData['DateFin'] . "</p>";
                        echo " " . $stagiaireData['Pieces'] . "</p>";
                                            

                         //Display certificates data table
                        $certQuery = "SELECT * FROM certificates WHERE StagiaireId = ?";
                        $certStmt = mysqli_stmt_init($conn);

                        if (mysqli_stmt_prepare($certStmt, $certQuery)) {
                            mysqli_stmt_bind_param($certStmt, "i", $stagiaireID);
                            mysqli_stmt_execute($certStmt);
                            $certResult = mysqli_stmt_get_result($certStmt);

                            if (mysqli_num_rows($certResult) > 0) {
                                echo "<h3>Certificates</h3>";
                                echo "<table class='table table-bordered table-striped'>";
                                echo "<thead><tr><th>Certificate ID</th><th>Certificate Name</th><th>Programme</th><th>Date Obtention</th></tr></thead>";
                                echo "<tbody>";

                                while ($certData = mysqli_fetch_assoc($certResult)) {
                                    echo "<tr>";
                                    echo "<td>" . $certData['Id'] . "</td>";
                                    echo "<td>" . $certData['NomCertificat'] . "</td>";
                                    echo "<td>" . $certData['Programme'] . "</td>";
                                    echo "<td>" . $certData['DateObtention'] . "</td>";
                                    echo "</tr>";
                                }

                                echo "</tbody></table>";
                            } else {
                                echo "<p>No certificates found for this Stagiaire ID.</p>";
                            }

                            mysqli_stmt_close($certStmt);
                        } else {
                            echo "Error preparing statement for certificates: " . mysqli_error($conn);
                        }

                         //Display formations data table
                        $formQuery = "SELECT * FROM formations WHERE StagiaireId = ?";
                        $formStmt = mysqli_stmt_init($conn);

                        if (mysqli_stmt_prepare($formStmt, $formQuery)) {
                            mysqli_stmt_bind_param($formStmt, "i", $stagiaireID);
                            mysqli_stmt_execute($formStmt);
                            $formResult = mysqli_stmt_get_result($formStmt);

                            if (mysqli_num_rows($formResult) > 0) {
                                echo "<h3>Formations</h3>";
                                echo "<table class='table table-bordered table-striped'>";
                                echo "<thead><tr><th>Formation ID</th><th>Formation Titre</th><th>Etablissement</th><th>Branche</th><th>Date Debut</th><th>Date Fin</th></tr></thead>";
                                echo "<tbody>";

                                while ($formData = mysqli_fetch_assoc($formResult)) {
                                    echo "<tr>";
                                    echo "<td>" . $formData['Id'] . "</td>";
                                    echo "<td>" . $formData['FormationTitre'] . "</td>";
                                    echo "<td>" . $formData['Etablissement'] . "</td>";
                                    echo "<td>" . $formData['Branche'] . "</td>";
                                    echo "<td>" . $formData['DateDebut'] . "</td>";
                                    echo "<td>" . $formData['DateFin'] . "</td>";
                                    echo "</tr>";
                                }

                                echo "</tbody></table>";
                            } else {
                                echo "<p>No formations found for this Stagiaire ID.</p>";
                            }

                            mysqli_stmt_close($formStmt);
                        } else {
                            echo "Error preparing statement for formations: " . mysqli_error($conn);
                        }
                    } else {
                        echo "<p>No data found for this Stagiaire ID.</p>";
                    }
                } else {
                    echo "Error preparing statement: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Stagiaire ID not provided.";
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>
    <!-- Bootstrap JS and jQuery CDN -->
    <script src="https:code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https:cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https:stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>