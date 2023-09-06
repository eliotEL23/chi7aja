<?php
$host = "localhost";
$user = "root";
$dbname = "stagiarealten";
$password = "";

$conn = mysqli_connect($host, $user, $password, $dbname);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attestation de Stage</title>
    <script>
        function Export2Word(element, filename = '') {
            var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
            var postHtml = "</body></html>";
            var html = preHtml + element.value + postHtml;

            var blob = new Blob(['\ufeff', html], {
                type: 'application/msword'
            });

            // Specify link url
            var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);

            // Specify file name
            filename = filename ? filename + '.doc' : 'document.doc';

            // Create download link element
            var downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = url;

                // Setting the file name
                downloadLink.download = filename;

                // triggering the function
                downloadLink.click();
            }

            document.body.removeChild(downloadLink);
        }
        
        function exportToWord() {
            // Get the HTML content of the attestation div
            var attestationContent = document.querySelector('.attestation').innerHTML;

            // Create a hidden textarea to store the HTML content
            var textarea = document.createElement('textarea');
            textarea.value = attestationContent;
            document.body.appendChild(textarea);

            // Trigger the Export2Word function to convert and download as .doc
            Export2Word(textarea, 'attestation.doc');

            // Clean up the temporary textarea
            document.body.removeChild(textarea);
        }
    </script>
    <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            position: relative;
            font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        .attestation {
            width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 2px solid #000;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            position: relative;
            
        }

        .entete {
            text-align: center;
            margin-right: 30px;
        }

        #drh
        {
            text-align: right;
            margin-right: 70px;
            margin-top: -15px;
        }
        
        #blcd
        {
            text-align: right;
        }

        .titre {
            font-size: 24px;
            font-weight: bold;
            margin-top: 100px;
            color: #007BFF; 
        }

        #points
        {
            font-size: 30px;
            margin-bottom: 60px;
            margin-top: -5px;
            color: blue;
        }

        .nom {
            font-size: 16px;
            margin-bottom: 10px;
            margin-left: 90px;
        }

        .date {
            font-size: 16px;
            margin-bottom: 20px;
            color: #555; /* Date color */
        }

        .contenu {
            text-align: center;
            font-size: 16px;
            line-height: 1; /* Increased line height for better readability */
            color: #333; /* Text color */
        }

        #dep 
        {
            margin-left:22px;
        }

        .signature {
            text-align:left;
            color:blue;
        }

        #signat 
        {
            color: black;
        }
        
        #dte
        {
            margin-right:490px;
            margin-left: 125px;
        }

        #souhaite
        {
            margin-right: 260px;
            margin-left:120px;
        }

        .tampon {
            text-align: left;
            margin-top: 20px;
            color: blue;
            margin-bottom: 90px;
        }

        /* Styling for the Generate Certificate button */
        .generate-button {
            text-align: right;
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .generate-button input[type="button"] {
            background-color: #007BFF;
            color: #fff;
            font-size: 18px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .generate-button input[type="button"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="attestation">
        <div class="entete">
            <p id="blcd">Belcaid, le 4 septembre 2023</p>
            <p id="drh">DRH-ALTEN Maroc</p>
            <div class="titre">ATTESTATION DE STAGE </div>
            <p id="points">......................</p>
        </div>
        <form action="generate_attestation.php" method="GET">
            <input type="hidden" id="CIN" name="CIN">
            <div class="contenu">
                <p class="nom">Nous soussignes Societe ALTEN Maroc, attesttons que 
                
                    <?php
                    if (isset($_GET['CIN'])) {
                        // Replace the following lines with your logic to fetch the stagiaire's first name and last name based on their CIN
                        $CIN = $_GET['CIN'];
                        $query = "SELECT Prenom, Nom , Departement, DateDebut, DateFin FROM stagiareform WHERE CIN = '$CIN'";
                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $prenom = $row['Prenom'];
                            $nom = $row['Nom'];
                            $departement = $row['Departement'];
                            $datedebut = $row['DateDebut'];
                            $datefin = $row['DateFin'];

                            echo 'M.' . ' ' .$prenom . ' ' . $nom;
                        } else {
                            echo "Nom de Stagiaire Inconnu"; // Default name if CIN is not found
                        }
                    }
                    ?>
                </p>
                <p id="dep"><?php echo "a effectué un stage à $departement, pendant la période allant du $datedebut"; ?></p>
                <p id="dte">au <?php echo $datefin; ?>.</p>
                <p id="souhaite">Nous lui souhaitons une excellente continuation !</p>
            </div>
            <div class="generate-button">
                <input type="button" value="Générer l'attestation" onclick="exportToWord()">
            </div>
        </form>
        <div class="signature">
            <p>Signature :</p>
            <p id="signat">[Signature]</p>
        </div>
        <div class="tampon">
            <p>Tampon de l'entreprise</p>
        </div>
    </div>
</body>
</html>
</html>
