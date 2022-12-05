<?php
include 'connecterDB.php';
include 'connecterDBMoh.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $q = "";
    if ($_GET['table_name'] == 'enseignements' || $_GET['table_name'] == 'inscription_cours') {
        $q = deleteEnseignement();
    } else {

        $q = delete();
    }

    $out = shell_exec("D:/Programs/Windows/Python/Python310/python.exe D:\Development\Python\BDD\projet_bda_final\pythonBackend\write\delete.py " . escapeshellarg($q));
    echo $out;
}

function delete()
{
    $query = "DELETE FROM $_GET[table_name] WHERE $_GET[id_name]='$_GET[id_num]'";
    return $query;
}

function deleteEnseignement()
{
    $query = " DELETE FROM $_GET[table_name] WHERE ID_Cours= $_GET[ID_Cours] and $_GET[id_name_ens]='$_GET[ID_Enseignant]'";
    return $query;
}
