<?php
include './connecterDB.php';
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(!empty($_GET['tableSelected'])){
        $tableSelected=$_GET['tableSelected'];
        $stmt = $conn->prepare("SELECT * FROM $tableSelected limit 1" );
                $stmt->execute();
                $countEtud = $stmt->rowCount();    
                $infoEtudiant = $stmt->fetchAll();
                echo json_encode(array_keys(array_values($infoEtudiant)[0]));
    }
}
?>