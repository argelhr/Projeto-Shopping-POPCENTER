<?php
//identificação para a chamada da classe

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";

function enviaEmail($pessoas, $mensagem, $assunto, $email_resposta=null){//envia pra varias pessoas



    // instanciando a classe
    $mail = new PHPMailer();

    // habilitando SMTP	
    $mail->isSMTP();

    // habilitando tranferêcia segura 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // Pode ser: 0 = não exibe erros, 1 = exibe erros e mensagens, 2 = apenas mensagens	

    $mail->SMTPDebug = 0; // Debug

    // habilitando autenticação	
    $mail->SMTPAuth = true;

    // Configurações para utilização do SMTP do Gmail 

    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587; // porta gmail
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ]
    ];

    $mail->Username = 'argelymanu@gmail.com'; ////Usuário para autenticação 
    $mail->Password = 'iitkhyfjybgkxgxw'; //senha autenticação

    // Remetente da mensagem - sempre usar o mesmo usuário da autenticação  
    $mail->setFrom('argelymanu@gmail.com','Adm Pop Center');

    // Endereço(s) de destino do email
    foreach($pessoas as $pessoa)
        $mail->addAddress($pessoa['email'], $pessoa['nome'] );

    $mail->CharSet = "utf-8";

    // Endereço para resposta
    if($email_resposta)
    {
        $mail->addReplyTo($email_resposta);
    }
    // Assunto e Corpo do email
    $mail->Subject = $assunto;

    $mail->Body = $mensagem;

    $mail->isHTML(true);


    // Enviando o email
    if (!$mail->send())
        $retorno = false;
    else
        $retorno = $mensagem;

    return $retorno;
}


function enviaEmail2($email, $nome, $mensagem, $assunto, $email_resposta=null){//envia pra uma pessoa



    // instanciando a classe
    $mail = new PHPMailer();

    // habilitando SMTP	
    $mail->isSMTP();

    // habilitando tranferêcia segura 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // Pode ser: 0 = não exibe erros, 1 = exibe erros e mensagens, 2 = apenas mensagens	

    $mail->SMTPDebug = 0; // Debug

    // habilitando autenticação	
    $mail->SMTPAuth = true;

    // Configurações para utilização do SMTP do Gmail 

    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587; // porta gmail
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ]
    ];

    $mail->Username = 'argelymanu@gmail.com'; ////Usuário para autenticação 
    $mail->Password = 'iitkhyfjybgkxgxw'; //senha autenticação

    // Remetente da mensagem - sempre usar o mesmo usuário da autenticação  
    $mail->setFrom('argelymanu@gmail.com','Adm Pop Center');

    // Endereço(s) de destino do email
    $mail->addAddress($email,$nome);

    $mail->CharSet = "utf-8";

    // Endereço para resposta
    if($email_resposta)
    {
        $mail->addReplyTo($email_resposta);
    }
    // Assunto e Corpo do email
    $mail->Subject = $assunto;

    $mail->Body = $mensagem;

    $mail->isHTML(true);


    // Enviando o email
    if (!$mail->send())
        $retorno = false;
    else
        $retorno = $mensagem;

    return $retorno;
}


?>