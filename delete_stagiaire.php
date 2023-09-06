<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Supprimer Stagiaire</title>
    <link rel="stylesheet" href="https:stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Supprimer Stagiaire</h2>
        <form method="post">
            <div class="form-group">
                <label for="cin">CIN du Stagiaire:</label>
                <input type="text" class="form-control" id="cin" name="cin" placeholder="Entrez le CIN du Stagiaire" required>
            </div>
            <button type="submit" class="btn btn-danger" name="delete">Supprimer</button>
        </form>

        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
                $host = "localhost";
                $user = "root";
                $dbname = "stagiarealten";
                $password = "";

                $conn = mysqli_connect($host, $user, $password, $dbname);

                if (mysqli_connect_errno()) {
                    die("Error connecting: " . mysqli_connect_error());
                }

                $cin = $_POST['cin'];

                 //Delete certificates related to the stagiaire
                $deleteCertificatesQuery = "DELETE FROM certificates WHERE StagiaireId = '$cin'";
                mysqli_query($conn, $deleteCertificatesQuery);

                 //Delete formations related to the stagiaire
                $deleteFormationsQuery = "DELETE FROM formations WHERE StagiaireId = '$cin'";
                mysqli_query($conn, $deleteFormationsQuery);

                // Delete stagiaire from the database
                $deleteQuery = "DELETE FROM stagiareform WHERE CIN = '$cin'";
                if (mysqli_query($conn, $deleteQuery)) {
                    echo "<p>Stagiaire with CIN '$cin' and related records deleted successfully.</p>";
                } else {
                    echo "<p>Error deleting stagiaire: " . mysqli_error($conn) . "</p>";
                }

                mysqli_close($conn);
            }
        ?>
    </div>
    <script src="https:code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https:cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https:stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
