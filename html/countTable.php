<?php
include 'connecterDB.php';
include 'connecterDBMoh.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $stmt = $conn->prepare("SELECT * FROM etudiants ");
    $stmt->execute();
    $countEtud = $stmt->rowCount();

    $stmt = $conn->prepare("SELECT * FROM enseignants ");
    $stmt->execute();
    $countEns = $stmt->rowCount();

    $command = escapeshellcmd('..\pythonBackend\read\\countTable.py');
    $output = shell_exec($command);

    $data = ["CountEtudian" => $countEtud, "CountEnseignant" => $countEns, "CountCour" => $output];

    echo json_encode($data);
}
