<?php
include './connecterDB.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['searchTable']) && !empty($_GET['searchElement']) && !empty($_GET['searchValue'])) {
        $tableSearch = $_GET['searchTable'];
        $elementSearch = $_GET['searchElement'];
        $valueSearch = $_GET['searchValue'];
        if ($_GET['searchTable'] == 'etudiants' || $_GET['searchTable'] == 'enseignants' || $_GET['searchTable'] == 'cours') {
            $tableSearch = $_GET['searchTable'];
            $elementSearch = $_GET['searchElement'];
            $valueSearch = $_GET['searchValue'];

            $stmt = $conn->prepare("SELECT * FROM $tableSearch WHERE $elementSearch=? ");
            $stmt->execute(array($valueSearch));
            $infoSearch = $stmt->fetchAll();
            if ($tableSearch == 'etudiants') {
                //  responceText
                foreach ($infoSearch as $row) {
                    $id_Modifier = $row['ID_Etudiant'];
                    $id_supp = $row['ID_Etudiant'];
                    echo "<tr id='rechercheElement'>";
                    echo "<td><i class='fas fa-user-graduate'></td>";
                    echo "<td>" . $row['ID_Etudiant'] . "</td>";
                    echo "<td>" . $row['Nom'] . "</td>";
                    echo "<td>" . $row['Prenom'] . "</td>";
                    echo "<td>" . $row['Adresse'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . $row['Specialite'] . "</td>";
                    echo "<td>" . $row['N_Tel'] . "</td>";
                    echo "<td>
                <button  class='btnModifier' onclick=modifier($id_Modifier,'etudiants','ID_Etudiant')><i class='fas fa-pencil-alt'></i></button>
                <button class='btnSupp' onclick=deleteElement($id_supp,'etudiants','ID_Etudiant')><i class='far fa-trash-alt'></i></button>                         
                </td>";
                    echo "</tr>";
                }
            } else if ($tableSearch == "enseignants") {

                foreach ($infoSearch as $row) {
                    $id_Modifier = $row['ID_Enseignant'];
                    $id_supp = $row['ID_Enseignant'];
                    echo "<tr id='rechercheElement'>";
                    echo "<td><i class='fas fa-user-tie '></i></td>";
                    echo "<td>" . $row['ID_Enseignant'] . "</td>";
                    echo "<td>" . $row['Nom'] . "</td>";
                    echo "<td>" . $row['Prenom'] . "</td>";
                    echo "<td>" . $row['Adresse'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . $row['N_Tel'] . "</td>";
                    echo "<td>
            <button  class='btnModifier' onclick=modifier($id_Modifier,'enseignants','ID_Enseignant')><i class='fas fa-pencil-alt'></i></button>
            <button class='btnSupp' onclick=deleteElement($id_supp,'enseignants','ID_Enseignant')><i class='far fa-trash-alt'></i></button> 
            </td>";
                    echo "</tr>";
                }
            } else if ($tableSearch == 'cours') {
                $q = search();
                $out = shell_exec("D:/Programs/Windows/Python/Python310/python.exe D:\Development\Python\BDD\projet_bda_final\pythonBackend\\read\search.py " . escapeshellarg($q));
                $infoSearch = json_decode($out, true);
                # code...
                foreach ($infoSearch as $row) {
                    $id_Modifier = $row['ID_Cours'];
                    $id_supp = $row['ID_Cours'];
                    echo "<tr id='rechercheElement'>";
                    echo "<td><i class='far fa-file-pdf'></td>";
                    echo "<td>" . $row['ID_Cours'] . "</td>";
                    echo "<td>" . $row['Nom'] . "</td>";
                    echo "<td>" . $row['Coeffecient'] . "</td>";
                    echo "<td>
            <button  class='btnModifier' onclick=modifier($id_Modifier,'cours','ID_Cours')><i class='fas fa-pencil-alt'></i></button>
            <button class='btnSupp' onclick=deleteElement($id_supp,'cours','ID_Cours')><i class='far fa-trash-alt'></i></button>                         
            </td>";
                    echo "</tr>";
                }
            }
        } else if ($_GET['searchTable'] == 'enseignements') {
            $q = search();
            $out = shell_exec("D:/Programs/Windows/Python/Python310/python.exe D:\Development\Python\BDD\projet_bda_final\pythonBackend\\read\search.py " . escapeshellarg($q));
            $infoSearch = json_decode($out, true);

            foreach ($infoSearch as $row) {
                $id_Modifier = $row['ID_Enseignant'];
                $id_Ens = $row['ID_Enseignant'];
                $ID_Cours = $row['ID_Cours'];

                echo "<tr id='rechercheElement'>";
                echo "<td><i class='far fa-file-pdf'></td>";
                echo "<td>" . $row['ID_Enseignant'] . "</td>";
                echo "<td>" . $row['Nom'] . "</td>";
                echo "<td>" . $row['Prenom'] . "</td>";
                echo "<td>" . $row['Cours'] . "</td>";
                echo "<td>
                <button class='btnSupp' onclick=deleteEns($id_Ens,$ID_Cours,'enseignements','ID_Enseignant','ID_Cours')><i class='far fa-trash-alt'></i></button>                         
                </td>";
                echo "</tr>";
            }
        } elseif ($_GET['searchTable'] == 'inscription_cours') {
            $elementSearch;
            if ($_GET['searchElement'] == 'Cour') {
                $elementSearch = 'cours.Nom';
            } else {
                $elementSearch = 'etudiants.' . $_GET['searchElement'];
            }
            $q = search();
            $out = shell_exec("D:/Programs/Windows/Python/Python310/python.exe D:\Development\Python\BDD\projet_bda_final\pythonBackend\\read\search.py " . escapeshellarg($q));
            $infoSearch = json_decode($out, true);
            
            foreach ($infoSearch as $row) {

                $id_Etud = $row['ID_Etudiant'];
                $ID_Cours = $row['ID_Cours'];

                echo "<tr id='rechercheElement'>";
                echo "<td><i class='far fa-file-pdf'></td>";
                echo "<td>" . $row['ID_Etudiant'] . "</td>";
                echo "<td>" . $row['Nom'] . "</td>";
                echo "<td>" . $row['Prenom'] . "</td>";
                echo "<td>" . $row['Cours'] . "</td>";
                echo "<td>
                <button class='btnSupp' onclick=deleteEns($id_Etud,$ID_Cours,'inscription_cours','ID_Etudiant','ID_Cours')><i class='far fa-trash-alt'></i></button>                         
                </td>";
                echo "</tr>";
            }
        }
    }
}

function search()
{
    $q = "";
    $tbName = $_GET['searchTable'];

    if ($tbName == 'enseignements') {
        if ($_GET['searchElement'] == "Cours")
            $clmn = "cours.Nom";
        else
            $clmn = "enseignants.$_GET[searchElement]";
        $q = "SELECT enseignants.ID_Enseignant, enseignants.Nom, enseignants.Prenom, cours.Nom as Cours, cours.ID_Cours from enseignants, cours, enseignements where enseignants.ID_Enseignant=enseignements.ID_Enseignant and  enseignements.ID_cours=cours.ID_cours and $clmn='$_GET[searchValue]'";
    }
    elseif ($tbName == 'inscription_cours'){
        if($_GET['searchElement'] == "Cours")
            $clmn = "cours.Nom";
        else 
            $clmn = "etudiants.$_GET[searchElement]";
        $q = "SELECT etudiants.ID_Etudiant, etudiants.Nom, etudiants.Prenom, cours.Nom as Cours, cours.ID_Cours from etudiants, cours,inscription_cours where etudiants.ID_Etudiant=inscription_cours.ID_Etudiant and inscription_cours.ID_Cours=cours.ID_Cours and $clmn='$_GET[searchValue]'";
    }
    else {
        $q = "SELECT * FROM $tbName WHERE $_GET[searchElement]='$_GET[searchValue]'";
    }
   
    return $q;
}
