<?php
# ---------------------------------------------------------------- #
# Script:        read.php
# Description:   responsavel por fazer um select na tabela minha_tabela
# Written by	 vanderson.lima/antonio.silva
# Date:			 14.01.2021
#            	 Grupo Vicoa Brasil
# ---------------------------------------------------------------- #

#IMPORTA O ARQUIVO DE CONFIGURACAO
require_once "config.php";

#INCLUINDO O GERENCIADOR DE LOG
include "log.php";

#INCLUINDO A CLASSE COM A FUNCAO DE ENVIO DE EMAILS
#include "sendmail_aso.php";
require_once "sendmail_aso.php"; 

#CRIA A STRING DE CONEXAO
$sql = ("SELECT nome, email, admissao FROM minha_tabela WHERE STATUS = 'ATIVO' AND admissao IS NOT NULL");
logMe("CRIANDO A STRING DE CONEXAO SQL\n");

#EXECUTA A STRING DE CONEXAO
$result = mysqli_query($conn, $sql);
logMe("EXECUTANDO INSTRUCAO\n");

#PEGANDO A DATA ATUAL PARA COMPARAR COM A DATA DE ADMISSAO RETORNADA DO BANCO DE DADOS
$agora = date('Y-m-d');
logMe("QUERY.php ---> PEGANDO A DATA ATUAL\n");

#SE O NUMERO DE LINHAS FOR MAIOR QUE ZERO...PERCORRE
if (mysqli_num_rows($result) > 0) {

  #ENQUANTO TIVER REGISTRO, VAI PEGANDO E IMPRIMINDO
  while($row = mysqli_fetch_assoc($result)) 
  { 
	#PEGANDO OS DADOS DA COLUNA admissao
	$admissao = $row["admissao"];
	
	#"CONVERTENDO" A DATA PARA TIME
	$datetime1 = strtotime($admissao);
	
	#"CONVERTENDO" A DATA PARA TIME
	$datetime2 = strtotime($agora);
	
	#SUBTRAINDO AS DATAS	
	$secs = $datetime2 - $datetime1;
	
	#RESULTADO DIVIDIDO POR SEGUNDOS, RESULTADO EM DIAS
	$resultado = $secs / 86400;
	
	#SE O USUARIO ESTIVER COM 355 DIAS DE EMPRESA, SERA ENVIADO UM EMAIL PARA O RH
	if ($resultado == 343)
	{
		$nome = $row["nome"];
		$email = $row["email"];
		enviarEmail($nome, $email);	
		logMe("COLETANDO NOMES PARA ENVIAR O ALERTA\n");	
	}
	else
	{
		#echo "Erro: " . $mail->ErrorInfo;
		logMe("OCORREU UM ERRO AO COLETAR NOMES\n");
	}
  }
} else {
	
	#EMITE UM ALERT 
	logMe("ERRO AO COLETAR DADOS\n");
}
#FECHA A CONEXAO
mysqli_close($conn);
?>