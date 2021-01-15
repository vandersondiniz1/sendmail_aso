<?php
# ---------------------------------------------------------------- #
# Script:        config.php
# Description:   configuracoes do banco de dados
# Written by	 vanderson.lima
# Date:			 14.01.2021
#            	 Grupo Vicoa Brasil
# ---------------------------------------------------------------- #
$servername = "00.000.00.000";
$username = "user";
$password = "pass";
$dbname = "dbname";

#CRIA A STRING DE CONEXAO
$conn = mysqli_connect($servername, $username, $password, $dbname);
 
#VERIFICA SE A CONEXAO DEU CERTO
if($conn === false){
    die("ERROR: Conection Refused. " . mysqli_connect_error());
}
?>
