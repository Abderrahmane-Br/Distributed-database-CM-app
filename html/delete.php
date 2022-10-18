<?php
include 'connecterDB.php';
include 'connecterDBMoh.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $q = "";
    if($_GET['table_name'] == 'enseignements' || $_GET['table_name'] == 'inscription_cours') {
        $q = deleteEnseignement();
    }
    else {
        // echo "others";
        $q = delete();
    }

    $out = shell_exec("D:/Programs/Windows/Python/Python310/python.exe D:\Development\Python\BDD\projet_bda_final\pythonBackend\write\delete.py " . escapeshellarg($q));
    echo $out;
    /*    if (isset($_GET['id_num'])) {            
            $idNum=$_GET['id_num'];
            $tableName = $_GET['table_name'];       
            $idName = $_GET['id_name']; 
            $stmt = $conn->prepare("DELETE FROM $tableName WHERE $idName = ?");
            $stmt->execute(array($idNum));
        } 
        else if (!empty($_GET['ID_Enseignement'])) { 
            if($_GET['id_name_ens']=='ID_Enseignementeignant') {
                $idNumEns=$_GET['ID_Enseignement'];
                $idNumCour=$_GET['ID_Cours'];
                $tableName = $_GET['table_name'];       
                $idNameEns = $_GET['id_name_ens']; 
                $idNameCour = $_GET['id_name_cour'];
                $Typeeignement=$_GET['Type'];
                if($_GET['table_name']=='enseignements'){
                    $stmt = $conn->prepare("DELETE FROM Typeeignement WHERE $idNameEns = ? and $idNameCour=? and `Type`=?" );
                $stmt->execute(array($idNumEns,$idNumCour,$Typeeignement));
                }
                
                $stmt = $conn->prepare("Select * FROM Typeeignement WHERE $idNameEns = ? and $idNameCour=?");
                $stmt->execute(array($idNumEns,$idNumCour));
                $countType = $stmt->rowCount();
                if($countType==0){
                    $stmt = $conn->prepare("DELETE FROM $tableName WHERE $idNameEns = ? and $idNameCour=?");
                    $stmt->execute(array($idNumEns,$idNumCour));
                }
            }else{
                $idNumEns=$_GET['ID_Enseignement'];
                $idNumCour=$_GET['ID_Cours'];
                $tableName = $_GET['table_name'];       
                $idNameEns = $_GET['id_name_ens']; 
                $idNameCour = $_GET['id_name_cour'];
                $stmt = $conn->prepare("DELETE FROM $tableName WHERE $idNameEns = ? and $idNameCour=?");
                $stmt->execute(array($idNumEns,$idNumCour));
            }
            

           
        } 
    if (isset($_GET['ID_cours'])) {
        # code...
        if ($_GET['ID_cours']<=105) {
            # code...
            deleteEl($conn);
        }
        else {
            deleteEl($connMoh);
        }

    }
    else {
        deleteEl($conn);
        deleteEl($connMoh);
    }
      
    }   

    function deleteEl($conn) {


        if (isset($_GET['id_num'])) {
            
            $idNum = $_GET['id_num'];
            $tableName = $_GET['table_name'];
            $idName = $_GET['id_name'];
            $stmt = $conn->prepare("DELETE FROM $tableName WHERE $idName = ?");
            $stmt->execute(array($idNum));
            delete($tableName, $conn, $idNum);
  
        }
     else if (!empty($_GET['ID_Enseignement'])) {
        if ($_GET['id_name_ens'] == 'ID_Enseignementeignant') {
            $idNumEns = $_GET['ID_Enseignement'];
            $idNumCour = $_GET['ID_Cours'];
            $tableName = $_GET['table_name'];
            $idNameEns = $_GET['id_name_ens'];
            $idNameCour = $_GET['id_name_cour'];
            $Typeeignement = $_GET['Type'];
            if ($_GET['table_name'] == 'enseignements') {
                $stmt = $conn->prepare("DELETE FROM Typeeignement WHERE $idNameEns = ? and $idNameCour=? and `Type`=?");
                $stmt->execute(array($idNumEns, $idNumCour, $Typeeignement));
            }

            $stmt = $conn->prepare("Select * FROM Typeeignement WHERE $idNameEns = ? and $idNameCour=?");
            $stmt->execute(array($idNumEns, $idNumCour));
            $countType = $stmt->rowCount();
            if ($countType == 0) {
                $stmt = $conn->prepare("DELETE FROM $tableName WHERE $idNameEns = ? and $idNameCour=?");
                $stmt->execute(array($idNumEns, $idNumCour));
            }
        } else {
            $idNumEns = $_GET['ID_Enseignement'];
            $idNumCour = $_GET['ID_Cours'];
            $tableName = $_GET['table_name'];
            $idNameEns = $_GET['id_name_ens'];
            $idNameCour = $_GET['id_name_cour'];
            $stmt = $conn->prepare("DELETE FROM $tableName WHERE $idNameEns = ? and $idNameCour=?");
            $stmt->execute(array($idNumEns, $idNumCour));
        }
         } */
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
    // echo $query;
    // return "";
}
