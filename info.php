<?php

$command = escapeshellcmd('pythonPhp.py');
$output = shell_exec($command);
echo $output;
?>