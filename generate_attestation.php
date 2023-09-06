<?php
require "autoload.php";
use \PHPOffice\PhpWord\PhpWord;

$phpWord = new PhpWord();
$section = $phpWord->addSection();

// Your database connection code goes here
$host = "localhost";
$user = "root";
$dbname = "stagiarealten";
$password = "";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Error connecting to the database: " . mysqli_connect_error());
}

$section->addText('Attestation de Stage', ['size' => 24, 'bold' => true]);
$section->addText("\n");
$section->addText("Belcaid, le 4 septembre 2023");
$section->addText("DRH-ALTEN Maroc");
$section->addText("\nATTESTATION DE STAGE ");
$section->addText("......................", [], ['align' => 'center']);
$section->addText("\nNous soussignés Société ALTEN Maroc, attestons que ", [], ['align' => 'left']);

$prenom = ''; // Declare $prenom and $nom variables
$nom = '';

if (isset($_GET['CIN'])) {
    $CIN = $_GET['CIN'];
    $query = "SELECT Prenom, Nom, Departement, DateDebut, DateFin FROM stagiareform WHERE CIN = '$CIN'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $prenom = $row['Prenom'];
        $nom = $row['Nom'];

        $section->addText("M. $prenom $nom", [], ['align' => 'left']);
        $section->addText("a effectué un stage au département departement, pendant la période allant du $dateDebut au $dateFin.", [], ['align' => 'left']);
        $section->addText("Nous souhaitons à $prenom $nom tout le succès dans ses projets futurs.", [], ['align' => 'left']);
    } else {
        $section->addText("Nom de Stagiaire Inconnu", [], ['align' => 'left']);
    }
}

$section->addText("\nSignature : [Signature]", [], ['align' => 'left']);
$section->addText("\nTampon de l'entreprise", [], ['align' => 'center']);

// Save the document to a temporary file
$tempFile = tempnam(sys_get_temp_dir(), 'attestation_');
$phpWord->save($tempFile);

// Define the file name and header for download
$filename = "Attestation_Stage.docx";
header("Content-Disposition: attachment; filename=$filename");
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Length: ' . filesize($tempFile));

// Output the file contents
readfile($tempFile);

// Clean up: Delete the temporary file
unlink($tempFile);
?>
