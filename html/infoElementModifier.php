<?php
include './connecterDB.php';
include './connecterDBMoh.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id_Modifier'])){
        $id_modifier = $_GET['id_Modifier'];
        $tableModifier = $_GET['table_Modifier'];
        $id_Name_Modifier = $_GET['id_Name_Modifier'];

        if($id_modifier <= 105)
            $stmt = $conn->prepare("SELECT * FROM $tableModifier WHERE $id_Name_Modifier=? ");
        else
            $stmt = $connMoh->prepare("SELECT * FROM $tableModifier WHERE $id_Name_Modifier=? ");

        $stmt->execute(array($id_modifier));    
        $infoModifier = $stmt->fetch(); 
        echo json_encode($infoModifier);
    }
}

?>