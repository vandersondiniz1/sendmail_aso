<?php 
# ---------------------------------------------------------------- #
# Script:        log.php
# Description:   cria logs para a aplicacao
# Written by	 vanderson.lima/antonio.silva
# Date:			 14.01.2021
#            	 Grupo Vicoa Brasil
# ---------------------------------------------------------------- #

function logMe($msg){

#ABRE OU CRIA O ARQUIVO DE LOG
$fp = fopen("log/log.log", "a");

#ESCREVE A MENSAGEM NO ARQUIVO
$escreve = fwrite($fp, $msg);

#FECHA O ARQUIVO
fclose($fp);
}

?>