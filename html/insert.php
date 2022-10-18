<?php
require_once 'connecterDB.php';
require_once 'connecterDBMoh.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ID_Cours'])) {
        # code...
        if ($_POST['ID_Cours'] <= 105) {
            fillFields(
                $_POST,
                $conn
            );
        } else {
            fillFields(
                $_POST,
                $connMoh
            );
        }
    } else {
        fillFields($_POST, $conn);
        fillFields($_POST, $connMoh);
    }
}
function fillFields($info, $conn)
{

    $tableName = $info['tableName'];

    if ($tableName == 'enseignements') {
        echo 'rak f enseignement';
        # code...
        $idEns = $info['ID_Enseignant'];
        $idCours = $info['ID_Cours'];
        $stmt = $conn->prepare("select * from type_enseignement join enseignements on enseignements.ID_Enseignement = type_enseignement.ID_Enseignement where Type= ? and enseignements.ID_Cours = ?");
        $stmt->execute(array('CM', $idCours));
        $cmExists = $stmt->rowCount() > 0 ? true : false;
        echo "\n cm exists ".var_dump($cmExists)." end cm exists\n";
        /*if (!($cmExists > 0)) {
            if (array_search('CM', $info['type']) !== false) {
                echo 'adding a new row to enseignements '.$info['ID_Enseignant'].' '. $info['ID_Cours'];
                $stmt = $conn->prepare("INSERT INTO enseignements (ID_Enseignant,ID_Cours) VALUES(?,?)");
                $stmt->execute(array($info['ID_Enseignant'], $info['ID_Cours']));
                echo 'added a new row to enseignements '.$info['ID_Enseignant'].' '. $info['ID_Cours'];
                foreach ($info['type'] as $type) {
                    echo $type;
                    # code...      
                    if (!is_null($type)) {
                        $stmt = $conn->prepare("INSERT INTO `type_enseignement` (`Type`, `ID_Cours`, `ID_Enseignant`) VALUES (?,(select ID_Enseignement from enseignements where enseignements.ID_Enseignant = $idEns and ID_Cours = $sidCours)");
 enseignement.                       $stmt->execute(array($type, $idCours, $idEns));
                    }
                }
            } 
            else {
                foreach ($info['type'] as $type) {
                    echo "";
                    # code...      
                    if (!is_null($type)) {
                        $stmt = $conn->prepare("INSERT INTO `type_enseignement` (`Type`, `ID_Cours`, `ID_Enseignant`) VALUES (?,?,?)");
                        $stmt->execute(array($type, $idCours, $idEns));
                    }
                }
            }
        }
        else {
            $stmt = $conn->prepare("INSERT INTO enseignements (ID_Enseignant,ID_Cours) VALUES(?,?)");
            $stmt->execute(array($info['ID_Enseignant'], $info['ID_Cours']));

            foreach ($info['type'] as $type) {
                echo $type;
                # code...      
                if (!is_null($type)) {
                    $stmt = $conn->prepare("INSERT INTO `type_enseignement` (`Type`, `ID_Cours`, `ID_Enseignant`) VALUES (?,?,?)");
                    $stmt->execute(array($type, $idCours, $idEns));
                }
            }
        }*/

        if ($cmExists) {
            try {
                $stmt = $conn->prepare("INSERT INTO enseignements (ID_Enseignant,ID_Cours) VALUES(?,?)");
                $stmt->execute(array($info['ID_Enseignant'], $info['ID_Cours']));
                $stmt = $conn->prepare("select ID_Enseignement from enseignements where `enseignements`.`ID_Enseignant` = ? and `enseignements`.`ID_Cours` = ?");
                $stmt->execute(array($idEns, $idCours));
                $idEnsmnt =  array_values($stmt->fetch())[0];
                foreach ($info['type'] as $type) {
                    echo $type;
                    # code...      
                    if (!is_null($type)) {
                        $stmt = $conn->prepare("INSERT INTO `type_enseignement` (`Type`, `ID_Enseignement`) VALUES (?,?)");
                        echo var_dump($idEnsmnt)." first echo of idEnsmt";
                        $stmt->execute(array($type));
                    }
                }
            } catch (Exception $e) {
                foreach ($info['type'] as $type) {
                    echo $type;
                    # code...      
                    if (!is_null($type)) {
                        $stmt = $conn->prepare("select ID_Enseignement from enseignements where `enseignements`.`ID_Enseignant` = ? and `enseignements`.`ID_Cours` = ?");
                        $stmt->execute(array($idEns, $idCours));
                        $idEnsmnt = array_values($stmt->fetch())[0];
                        $stmt = $conn->prepare("INSERT INTO `type_enseignement` (`Type`, `ID_Enseignement`) VALUES (?,?)");
                        echo var_dump($idEnsmnt) . " 2nd echo of idEnsmt";
                        $stmt->execute(array($type, $idEnsmnt));
                    }
                }
            }
        } else {
            var_dump($info['type']);
            if (array_search('CM', $info['type']) !== false) {
                $stmt = $conn->prepare("INSERT INTO enseignements (ID_Enseignant,ID_Cours) VALUES(?,?)");
                $stmt->execute(array($info['ID_Enseignant'], $info['ID_Cours']));
                foreach ($info['type'] as $type) {
                    echo $type;
                    # code...      
                    if (!is_null($type)) {
                        $stmt = $conn->prepare("select ID_Enseignement from enseignements where `enseignements`.`ID_Enseignant` = ? and `enseignements`.`ID_Cours` = ?");
                        $stmt->execute(array($idEns, $idCours));
                        $idEnsmnt =  array_values($stmt->fetch())[0];
                        $stmt = $conn->prepare("INSERT INTO `type_enseignement` (`Type`, `ID_Enseignement`) VALUES (?,?)");
                        echo var_dump($idEnsmnt) . " 3rd echo of idEnsmt";
                        $stmt->execute(array($type, $idEnsmnt));
                    }
                }
            }
            else {
                foreach ($info['type'] as $type) {
                    echo $type;
                    # code...      
                    if (!is_null($type)) {
                        $stmt = $conn->prepare("select ID_Enseignement from enseignements where `enseignements`.`ID_Enseignant` = ? and `enseignements`.`ID_Cours` = ?");
                        $stmt->execute(array($idEns, $idCours));
                        $idEnsmnt =  array_values($stmt->fetch())[0];
                        $stmt = $conn->prepare("INSERT INTO `type_enseignement` (`Type`, `ID_Enseignement`) VALUES (?,?)");
                        echo var_dump($idEnsmnt) . " 4th echo of idEnsmt";
                        $stmt->execute(array($type, $idEnsmnt));
                    }
                }
            }
        }
    } else {
        echo 'marakch f endseijfsdfisdf';
        $fields = array_slice(array_keys($info), 1);
        $values = array_slice(array_values($info), 1);
        $queryFill = str_repeat(",?", count($info) - 2);
        $stringFields = implode(',', $fields);
        $valuesFeild = implode(',', $values);
        $query = "INSERT INTO $tableName ($stringFields) VALUES(?$queryFill)";

        # code...
        $stmt = $conn->prepare($query);
        $stmt->execute([...$values]);
    }
}
