<?php
include 'connecterDB.php';

function runPython($str) {
    $command = escapeshellcmd('..\pythonBackend\read\\' . $str);
    $output = shell_exec($command);
    return json_decode($output, true);
}
// include 'partitionBDD.php';
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_GET['tableUpdate'])) {
        # code...
        $tableUp = $_GET['tableUpdate'];
        if ($tableUp == 'etudiants') {
            // select etudiants
            // $stmt = $conn->prepare("SELECT * FROM etudiants GROUP BY ID_Etudiant ");
            // $stmt->execute();
            // $countEtud = $stmt->rowCount();    
            // $infoEtudiant = $stmt->fetchAll();
            
            $infoEtudiant = runPython('etudiants.py');
            //  responceText
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
            }
            else if($tableUp == 'enseignants'){
                 // select ense
                $stmt = $conn->prepare("SELECT * FROM enseignants ");
                $stmt->execute();
                $countEns = $stmt->rowCount();
                $infoEnseignant = $stmt->fetchAll();
                foreach($infoEnseignant as $row){
                    $id_Modifier = $row['ID_Enseignant'];
                    $id_supp = $row['ID_Enseignant'];
                    echo "<tr>";
                    echo "<td><i class='fas fa-user-tie '></i></td>";
                    echo "<td>".$row['ID_Enseignant']."</td>";
                    echo "<td>".$row['Nom']."</td>";
                    echo "<td>".$row['Prenom']."</td>";
                    echo "<td>".$row['Adresse']."</td>";
                    echo "<td>".$row['Email']."</td>";
                    echo "<td>".$row['N_Tel']."</td>";
                    echo "<td>
                    <button  class='btnModifier' onclick=modifier($id_Modifier,'enseignants','ID_Enseignant')><i class='fas fa-pencil-alt'></i></button>
                    <button class='btnSupp' onclick=deleteElement($id_supp,'enseignants','ID_Enseignant')><i class='far fa-trash-alt'></i></button> 
                    </td>";
                    echo "</tr>";
                } 
            }
            elseif($tableUp=='cours'){
                // select cours
                // $stmt = $conn->prepare("SELECT * FROM cours ");
                // $stmt->execute();
                // $countCour = $stmt->rowCount();    
                // $infoCours = $stmt->fetchAll();
                $infoCours = runPython('cours.py');
                foreach($infoCours as $row){
                    $id_Modifier = $row['ID_Cours'];
                    $id_supp = $row['ID_Cours'];
                    echo "<tr>";
                        echo "<td><i class='far fa-file-pdf'></td>";
                        echo "<td>".$row['ID_Cours']."</td>";
                        echo "<td>".$row['Nom']."</td>";
                        echo "<td>".$row['Coeffecient']."</td>";
                        echo "<td>
                        <button  class='btnModifier' onclick=modifier($id_Modifier,'cours','ID_Cours')><i class='fas fa-pencil-alt'></i></button>
                        <button class='btnSupp' onclick=deleteElement($id_supp,'cours','ID_Cours')><i class='far fa-trash-alt'></i></button>                         
                        </td>" ;                         
                        echo "</tr>";               
                    } 
            }
            else if($tableUp == 'enseignements'){
                // select enseignements
                // $stmt = $conn->prepare("SELECT enseignants.ID_Enseignant,enseignants.Nom , enseignants.Prenom , cours.Nom  AS Nom_Cours ,cours.ID_Cours ,Typeeignement.Type From enseignants join enseignements on enseignements.ID_Enseignant=enseignants.ID_Enseignant inner join cours on enseignements.ID_Cours=cours.ID_Cours inner JOIN Typeeignement on enseignements.ID_Enseignant=Typeeignement.ID_Enseignant");
                // $stmt->execute();
                // $countCour = $stmt->rowCount();    
                // $infoCours = $stmt->fetchAll();
                $infoCours = runPython('enseignements.py');
                // var_dump($infoCours) ;
                foreach($infoCours as $row){
                    $id_Modifier = $row['ID_Enseignant'];
                    $id_Ens = $row['ID_Enseignant'];
                    $id_Cour = $row['ID_Cours'];
                    $Typeeignement=$row['Type'];

                    echo "<tr>";
                        echo "<td><i class='far fa-file-pdf'></td>";
                        echo "<td>".$row['ID_Enseignant']."</td>";
                        echo "<td>".$row['Nom']."</td>";
                        echo "<td>".$row['Prenom']."</td>";
                        echo "<td>".$row['Cours']."</td>";
                        echo "<td>".$row['Type']."</td>";
                        echo "<td>
                        <button class='btnSupp' onclick=deleteEns($id_Ens,$id_Cour,'enseignements','ID_Enseignant','ID_Cours')><i class='far fa-trash-alt'></i></button>                         
                        </td>" ;                         
                        echo "</tr>";               
                    } 
            }else{
                // $stmt = $conn->prepare("SELECT etudiants.ID_Etudiant,etudiants.Nom , etudiants.Prenom , cours.Nom AS Nom_Cours,cours.ID_Cours From etudiants join inscription_cours on inscription_cours.ID_Etudiant=etudiants.ID_Etudiant inner join cours on inscription_cours.ID_Cours=cours.ID_Cours ORDER BY etudiants.ID_Etudiant");
                // $stmt->execute();
                // $countCour = $stmt->rowCount();    
                // $infoCours = $stmt->fetchAll();
                $infoCours = runPython('inscriptions_cours.py');
                foreach($infoCours as $row){
                    $id_Modifier = $row['ID_Etudiant'];
                    $id_Ens = $row['ID_Etudiant'];
                    $id_Cour = $row['ID_Cours'];
                    echo "<tr>";
                        echo "<td><i class='fas fa-file-signature'></td>";
                        echo "<td>".$row['ID_Etudiant']."</td>";
                        echo "<td>".$row['Nom']."</td>";
                        echo "<td>".$row['Prenom']."</td>";
                        echo "<td>".$row['Nom_Cours']."</td>";
                        echo "<td>
                        <button class='btnSupp' onclick=deleteEns($id_Ens,$id_Cour,'inscription_cours','ID_Etudiant','ID_Cours')><i class='far fa-trash-alt'></i></button>                         
                        </td>" ;                          
                        echo "</tr>";               
                    } 
            }

        } 
        
    }
