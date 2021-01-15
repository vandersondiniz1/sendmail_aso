<?php
# ---------------------------------------------------------------- #
# Script:        sendmail_aso.php
# Description:   envia email para o rh como lembrete do ASO
# Written by	 vanderson.lima/antonio.silva
# Date:			 14.01.2021
#            	 Grupo Vicoa Brasil
# ---------------------------------------------------------------- #

#INCLUINDO OS ARQUIVOS NECESSARIOS
include "PHPMailer-master/PHPMailerAutoload.php";

#INCLUINDO O GERENCIADOR DE LOG
require_once "log.php";

function enviarEmail($nomeDestinatario, $emailDestinatario){

#PEGANDO A DATA ATUAL
$data = date('d/m/Y H:i');

logMe("<------- INICIANDO APLICACAO $data -------> \n");

#INICIA A CLASSE PHPMAILER
$mail = new PHPMailer();
logMe("INICIANDO A CLASSE DE EMAIL\n");

#METODO DE ENVIO SMTP
$mail->IsSMTP();
logMe("CONFIGURANDO METODO DE ENVIO\n");

#CONFIGURACAO DO HOST 
$mail->Host = "smtp.gmail.com";
logMe("HOST CONFIGURADO: smtp.gmail.com\n",$mail);

#PORTA DE ENVIO, NESTE CASO, TLS
$mail->Port = 587;
logMe("CONFIGURACAO DE PORTA: 587\n");

#OBRIGANDO O USUARIO A SE AUTENTICAR
$mail->SMTPAuth = true;
logMe("AUTENTICANDO USUARIO\n");

#FAZENDO LOGIN NA CONTA
$mail->Username = 'meuemail@gmail.com';
$mail->Password = 'minhasenha';
logMe("USUARIO: meuemail@gmail.com \n");
logMe("SENHA: ************** \n");

#CONFIGURACOES TLS
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
logMe("CONFIGURACOES TLS");

#REMETENTE
$mail->From = "meuemail@gmail.com";
logMe("REMETENTE:meuemail@gmail.com \n");

#NOME QUE APARECERA NO EMAIL
$mail->FromName = "ATESTADO DE SAÚDE OCUPACIONAL";
logMe("NOME: ATESTADO DE SAUDE OCUPACIONAL \n");

#DESTINATARIO
$mail->AddAddress('destinatario@mail.com.br', 'Nome');
logMe("DESTINATARIO: destinatario@mail.com.br\n");

#COM COPIA PARA[...]
$mail->AddCC('outrodestinatario@gmail.com', 'Nome');
logMe("CC: outrodestinatario@mail.com.br \n");

#DEFININDO O FORMATO HTML
$mail->IsHTML(true);
logMe("TIPO DE CABECALHO DO EMAIL: HTML \n");

#TIPO DE CARACTERE UTILIZADO
$mail->CharSet = 'UTF-8';
logMe("TIPO DE CARACTERE: UTF-8\n");

#ASSUNTO DO EMAIL
$mail->Subject = "Atestado de Saúde Ocupacional";
logMe("ASSUNTO DO EMAIL: Atestado de Saude Ocupacional\n");

#MENSAGEM QUE SERA ENTREGUE NO CORPO DO EMAIL
$mail->Body = 'ALERTA: O usuário ' .$nomeDestinatario. ' está com 355 dias de empresa e precisará fazer o ASO em breve. Entre em contato.';
logMe("MENSAGEM: ==CONTEUDO OMITIDO== \n");

#ENVIA O EMAIL
$enviado = $mail->Send();
logMe("TENTANDO ENVIAR EMAIL\n");

#RETORNA UMA MENSAGEM
if ($enviado)
{
    echo "Enviado com Sucesso!\n";
	logMe("EMAIL ENVIADO COM SUCESSO\n");	
}
else
{
    echo "Erro: " . $mail->ErrorInfo;
	logMe("OCORREU UM ERRO AO ENVIAR O EMAIL\n");
}

#FECHA A FUNCAO
}
?>
