<?php
$val= "UPDATE enseignants SET Nom = 'Abid', Prenom = 'Khaled', N_Tel = '0755555553', Email = 'Kabid@gmail.com', Adresse = 'Oran' where 'ID_Enseignementeignant=1'"; 
echo 'starting';
// $command = escapeshellcmd("test.py " ."aa");
$outpout = shell_exec("D:/Programs/Windows/Python/Python310/python.exe D:/Development/Python/BDD/test.py " .$val);
echo $outpout;
?>