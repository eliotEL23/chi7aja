<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ADMIN Page</title>
    <link rel="stylesheet" href="https:stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https:cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
         <style>
        /* Custom Styles */
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #007bff; /* Blue background color */
        }

        .navbar-brand {
            color: #ffffff;
            font-weight: bold;
            font-size: 24px; /* Adjust the font size as needed */
        }

        .navbar-dark .navbar-toggler-icon {
            background-color:#007bff;
        }

        .container-fluid {
            margin-top: 20px;
        }

        .table-responsive {
            margin-top: 20px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }

        .navbar-nav {
        margin-right: 20px;
    }

    .nav-link {
        color: #fff !important; /* Text color for menu items */
        font-size: 18px;
        padding: 10px 20px;
        transition: background-color 0.3s;
    }

    .nav-link:hover {
        background-color: #0056b3 !important; /* Background color on hover */
        color: #fff !important; /* Text color on hover */
        border-radius: 5px;
    }

    .dropdown-menu {
        background-color: #343a40 !important; /* Background color for dropdowns */
        border: none;
    }

    .dropdown-item {
        color: #fff !important; /* Text color for dropdown items */
        font-size: 16px;
        padding: 10px 20px;
        transition: background-color 0.3s;
    }

    .dropdown-item:hover {
        background-color: #007bff !important; /* Background color on hover for dropdown items */
        color: #fff !important; /* Text color on hover for dropdown items */
        border-radius: 5px;
    }
    
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">
            <img src="altenLogo2.png" alt="Your Logo" height="200">
        </a>
    </nav>
    <div class="container-fluid">
    <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">
        <img src="altenLogo2.png" alt="Your Logo" height="200">
    </a>
    <div class="collapse navbar-collapse ml-auto" id="navbarNav"> <!-- Added ml-auto class to push menu to the left -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Acceuil</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="stagiaireDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Stagiaire
                </a>
                <div class="dropdown-menu" aria-labelledby="stagiaireDropdown">
                    <a class="dropdown-item" href="full_data.php">Details</a>
                    <a class="dropdown-item" href="inscription.html">Ajouter Stagiaire</a>
                    <a class="dropdown-item" href="modifier.php">Modifier</a>
                    <a class="dropdown-item" href="supprimer.php">Supprimer</a>
                    <a class="dropdown-item" href="attestation.php">Attestation</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="encadrantDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Encadrant
                </a>
                <div class="dropdown-menu" aria-labelledby="encadrantDropdown">
                    <a class="dropdown-item" href="#">View Details</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

        <main role="main" class="container mt-3">
            <h1 class="mt-5">Liste des Stagiaires</h1>
            <div class="form-group">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by CIN">
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="stagiairesTable">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Genre</th>
                            <th>CIN</th>
                            <th>Date de Naissance</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th>Ecole</th>
                            <th>Adresse Ecole</th>
                            <th>Fix Ecole</th>
                            <th>Filière</th>
                            <th>Encadrant Académique</th>
                            <th>Encadrant Téléphone</th>
                            <th>Encadrant Email</th>
                            <th>Période Stage</th>
                            <th>Departement</th>
                            <th>DateDebut</th>
                            <th>DateFin</th>
                            <th>Pieces</th>
                            <th>View</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                            <th>Attestation</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $host = "localhost";
                        $user = "root";
                        $dbname = "stagiarealten";
                        $password = "";

                        $conn = mysqli_connect($host, $user, $password, $dbname);

                        if (mysqli_connect_errno()) {
                            die("Error connecting: " . mysqli_connect_error());
                        }

                        $query = "SELECT * FROM stagiareform";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr onclick='redirectToEditPage(\"" . $row['CIN'] . "\")'>";  //Added onclick event
                            echo "<td>" . $row['Nom'] . "</td>";
                            echo "<td>" . $row['Prenom'] . "</td>";
                            echo "<td>" . $row['Genre'] . "</td>";
                            echo "<td>" . $row['CIN'] . "</td>";
                            echo "<td>" . $row['DateN'] . "</td>";
                            echo "<td>" . $row['Email'] . "</td>";
                            echo "<td>" . $row['telephone'] . "</td>";
                            echo "<td>" . $row['Adresse'] . "</td>";
                            echo "<td>" . $row['Ecole'] . "</td>";
                            echo "<td>" . $row['AdresseEcole'] . "</td>";
                            echo "<td>" . $row['FixEcole'] . "</td>";
                            echo "<td>" . $row['Filiere'] . "</td>";
                            echo "<td>" . $row['EncadrantAcd'] . "</td>";
                            echo "<td>" . $row['EncadrantTel'] . "</td>";
                            echo "<td>" . $row['EncadrantEmail'] . "</td>";
                            echo "<td>" . $row['PeriodeStage'] . "</td>";
                            echo "<td>" . $row['Departement'] . "</td>";
                            echo "<td>" . $row['DateDebut'] . "</td>";
                            echo "<td>" . $row['DateFin'] . "</td>";
                            echo "<td>";
                            $pieceFileName = $row['Pieces'];
                            if (!empty($pieceFileName)) {
                                echo "<a href='./Pieces/$pieceFileName' download>" . $pieceFileName . "</a>";
                            } else {
                                echo "No Piece Available";
                            }
                            echo "</td>";

                            echo "<td><a href='full_data.php?CIN=" . $row['CIN'] . "' class='btn btn-primary'>Details</a></td>";
                            echo "<td><a href='modifier.php?CIN=" . $row['CIN'] . "' class='btn btn-warning'>Modifier</a></td>";
                            echo "<td><a href='delete_stagiaire.php?CIN=" . $row['CIN'] . "' class='btn btn-danger'>Supprimer</a></td>";
                            echo "<td><a href='attestation.php?CIN=" . $row['CIN'] . "' class='btn btn-success'>Attestation</a></td>";


                            echo "<tr>";
                        }

                        mysqli_close($conn);
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-3">
                <form method="post" action="inscription.html " class="d-inline-block">
                    <button type="submit" class="btn btn-info mr-2">Ajouter</button>
                </form>
            </div>
        </main>
    </div>
    <script src="https:code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https:cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https:stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https:cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#stagiairesTable').DataTable();
        });
    </script>
</body>
</html>
