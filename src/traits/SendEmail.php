<?php
/**
 * Created By PhpStorm
 * User: LW
 * Date: 2020/12/11
 * Time: 17:11
 * Desc: 邮件处理方法
 */
namespace funcext\email\traits;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use think\facade\Cache;
use think\facade\Config;

/**
 * 添加
 */

trait SendEmail
{
    /**邮件发送
     * @param array $receiver           邮件接收者,支持多个
     * @param array $content            邮件内容 subject:邮件标题,body:邮件内容主体
     * @param string $title
     * @return bool|string
     * @time 2020/12/21 15:42
     * @author LW
     */
    public function sendEmails(array $receiver, array $content)
    {
        $emailSender = json_decode(Cache::get('emailSender'),true);     //array
        arsort($emailSender);
        $senderAddress = array_key_first($emailSender);     //发送人账号
        $config = Config::get();
        die;
        //读取配置信息
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();                            //smtp方式发送
            $mail->CharSet = PHPMailer::CHARSET_UTF8;
            $mail->Host       = 'smtp1.example.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'user@example.com';
            $mail->Password   = 'secret';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        //tls:587,ssl:465
            $mail->Port       = 465;
            $mail->setFrom($sender['email'], $sender['name']);      //设置发送人
            //设置收件人
            foreach ($receiver as $value){
                $mail->addAddress($value['email'],$value['name']??$value['email']);
            }

            $mail->isHTML(true);
            $mail->Subject = $content['subject'];           // 邮件标题
            $mail->Body = $content['body'];
            $mail->send();
        }catch (Exception $exception){
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        //设置发送缓存
        return true;
    }
}
