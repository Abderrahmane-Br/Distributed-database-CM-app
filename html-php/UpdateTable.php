<?php
include 'connecterDB.php';

function runPython($str)
{
    $command = escapeshellcmd('..\pythonBackend\read\\' . $str);
    $output = shell_exec($command);
    return json_decode($output, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['tableUpdate'])) {
        # code...
        $tableUp = $_GET['tableUpdate'];
        if ($tableUp == 'etudiants') {






            $infoEtudiant = runPython('etudiants.py');

            foreach ($infoEtudiant as $row) {
                $id_Modifier = $row['ID_Etudiant'];
                $id_supp = $row['ID_Etudiant'];
                echo "<tr>";
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
        } else if ($tableUp == 'enseignants') {

            $stmt = $conn->prepare("SELECT * FROM enseignants ");
            $stmt->execute();
            $countEns = $stmt->rowCount();
            $infoEnseignant = $stmt->fetchAll();
            foreach ($infoEnseignant as $row) {
                $id_Modifier = $row['ID_Enseignant'];
                $id_supp = $row['ID_Enseignant'];
                echo "<tr>";
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
        } elseif ($tableUp == 'cours') {





            $infoCours = runPython('cours.py');
            foreach ($infoCours as $row) {
                $id_Modifier = $row['ID_Cours'];
                $id_supp = $row['ID_Cours'];
                echo "<tr>";
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
        } else if ($tableUp == 'enseignements') {





            $infoCours = runPython('enseignements.py');

            foreach ($infoCours as $row) {
                $id_Modifier = $row['ID_Enseignant'];
                $id_Ens = $row['ID_Enseignant'];
                $id_Cour = $row['ID_Cours'];
                $Typeeignement = $row['Type'];

                echo "<tr>";
                echo "<td><i class='far fa-file-pdf'></td>";
                echo "<td>" . $row['ID_Enseignant'] . "</td>";
                echo "<td>" . $row['Nom'] . "</td>";
                echo "<td>" . $row['Prenom'] . "</td>";
                echo "<td>" . $row['Cours'] . "</td>";
                echo "<td>" . $row['Type'] . "</td>";
                echo "<td>
                        <button class='btnSupp' onclick=deleteEns($id_Ens,$id_Cour,'enseignements','ID_Enseignant','ID_Cours')><i class='far fa-trash-alt'></i></button>                         
                        </td>";
                echo "</tr>";
            }
        } else {




            $infoCours = runPython('inscriptions_cours.py');
            foreach ($infoCours as $row) {
                $id_Modifier = $row['ID_Etudiant'];
                $id_Ens = $row['ID_Etudiant'];
                $id_Cour = $row['ID_Cours'];
                echo "<tr>";
                echo "<td><i class='fas fa-file-signature'></td>";
                echo "<td>" . $row['ID_Etudiant'] . "</td>";
                echo "<td>" . $row['Nom'] . "</td>";
                echo "<td>" . $row['Prenom'] . "</td>";
                echo "<td>" . $row['Nom_Cours'] . "</td>";
                echo "<td>
                        <button class='btnSupp' onclick=deleteEns($id_Ens,$id_Cour,'inscription_cours','ID_Etudiant','ID_Cours')><i class='far fa-trash-alt'></i></button>                         
                        </td>";
                echo "</tr>";
            }
        }
    }
}
