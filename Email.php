<?php
namespace Workerman;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Created by PhpStorm.
 * User: alonexy
 * Date: 18/4/13
 * Time: 10:53
 */
class Email
{
    public function __construct()
    {

    }
    public function eamilConfig()
    {
        if(!getenv('APP_DEBUG')){
            #发件帐号信息
            return [
                'host_server'=>'smtp.qq.com',
                'sender_email'=>'2485208728@qq.com',
                'server_pass'=>'',
                'email_title'=>'[PRO]'
            ];
        }else{
            #发件帐号信息
            return [
                'host_server'=>'smtp.qq.com',
                'sender_email'=>'2485208728@qq.com',
                'server_pass'=>'',
                'email_title'=>'[TEST]'
            ];
        }

    }
    public function getToEmails()
    {
        $emails = getenv('NOTICE_EMAILS');
        return explode(',',$emails);
    }
    /**
     * @name 邮件发送
     * @param string $msg
     */
    public function Send($msg='')
    {
        echo "\n";
        print_r($msg);
        echo "\n";
        return true;
        $mail = new PHPMailer(getenv('APP_DEBUG'));                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $this->eamilConfig()['host_server'];  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $this->eamilConfig()['sender_email'];                 // SMTP username
            $mail->Password = $this->eamilConfig()['server_pass'];                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($this->eamilConfig()['sender_email'], 'IWork');

            foreach($this->getToEmails() as $k=>$v){
                if($k==0){
                    $mail->addAddress($this->getToEmails()[$k]);
                }else{
                    $mail->addCC($this->getToEmails()[$k]);
                }
            }
            //Content
            $mail->isHTML(true);
                                         // Set email format to HTML
            $mail->Subject = $this->eamilConfig()['email_title'];
            $mail->Body    = $msg;
            $mail->AltBody = 'Iwork';

            $mail->send();
            echo "邮件发送成功 \n";
        } catch (\Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo."\n";
        }
    }
}