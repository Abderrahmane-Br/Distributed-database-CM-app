<?php
include './connecterDB.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['ID_Etudiant'])){
       $q = modifier("etudiants",  "ID_Etudiant=". $_POST['ID_Etudiant']);
        shell_exec("D:/Programs/Windows/Python/Python310/python.exe D:/Development/Python/BDD/projet_bda_final/pythonBackend/write/modify.py " .$q);
    }
    if(isset($_POST['ID_Enseignant'])){
        echo "ensei";
       $q = strval(modifier("enseignants", "ID_Enseignant='". $_POST['ID_Enseignant']."'"));
        $out = shell_exec("D:/Programs/Windows/Python/Python310/python.exe D:/Development/Python/BDD/projet_bda_final/pythonBackend/write/modify.py " . escapeshellarg($q));
        echo $out;
    }
    if(isset($_POST['ID_Cours'])){
        // echo "ensei";
        $q = strval(modifier("cours", "ID_Cours='" . $_POST['ID_Cours'] . "'"));
        $out = shell_exec("D:/Programs/Windows/Python/Python310/python.exe D:/Development/Python/BDD/projet_bda_final/pythonBackend/write/modify.py " . escapeshellarg($q));
        echo $out;
    }
}
function modifier($tableName,  $val) {
    // echo "modifier";
    $fields = array_slice(array_keys($_POST), 0);
    $values = array_slice(array_values($_POST), 0);
    $query = "UPDATE $tableName SET ";
    $i=1;
    for ($i ; $i < count($fields)-1; $i++) {
        $query .= $fields[$i]." = '".strval($values[$i]). "', ";
    }
    $query .= $fields[$i]." = '".strval($values[$i])."' where ".$val."";
    //  $conn->query($query);
    // echo "returning /n";
    // echo $query;
    return $query;
}
