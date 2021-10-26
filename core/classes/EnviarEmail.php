<?php 

namespace core\classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EnviarEmail{

    public function enviar_email_confirmacao_novo_cliente($email_cliente, $purl){


        $link = BASE_URL . '?a=confirmar_email&purl=' .$purl;

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
            $mail->isSMTP();                                            
            $mail->Host       = EMAIL_HOST;                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = EMAIL_FROM;                     
            $mail->Password   = EMAIL_PASS;                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = EMAIL_PORT;    
            $mail->CharSet = 'UTF-8';                                

            //Recipients
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);     
            

            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = APP_NAME . ' - Confirmação de email';
            $html = '<p>Seja bem-vindo à nossa Loja ' .APP_NAME . '.</p>';
            $html .= '<p>Para poder entrar na nossa loja necessita confirmar o seu email.</p>';
            $html .= '<p>Para confirmar o email, clique no link abaixo:</p>';
            $html .= '<p><a href="'.$link.'">Confirmar email</a></p>';
            $html .= '<p><i><small>' . APP_NAME . '</small></i></p>';
            $mail->Body    = $html;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }


    }
}