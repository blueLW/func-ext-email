<?php
/**
 * Created By PhpStorm
 * User: LW
 * Date: 2020/12/11
 * Time: 17:11
 * Desc: 邮件发送处理
 */
namespace funcext\email\traits;

use funcext\email\common\Structure;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use think\facade\Cache;
use think\facade\Config;

trait SendEmail
{

    /**邮件发送
     * @param array $receiver           邮件接收者,支持多个
     * @param array $content            邮件内容 subject:邮件标题,body:邮件内容主体
     * @return bool|string
     * @throws Exception
     * @time 2020/12/21 15:42
     * @author LW
     */
    public function sendEmails(array $receiver, array $content)
    {
        $sender = Config::get('email.');
        if(empty($sender)){
            $structure = Structure::EMAIL_CONFIG_STRUCTURE;
            $error = [
                'msg'=>'未配置邮件发送账户,请参考配置结构,在config目录创建email.php配置文件/更新已有的email.php配置文件',
                'config_structure'=>$structure
            ];
            throw new Exception(json_encode($error,JSON_UNESCAPED_UNICODE),500);
        }

        $emailSender = json_decode(Cache::get('emailSender'),true);     //array
        if(!empty($emailSender) && count($emailSender) == count($sender)){
            asort($emailSender);
            $senderAddress = key($emailSender);     //发送人账号
        }else{
            shuffle($sender);                //随机取一个账号
            $senderAddress = current($sender)['username'];
            $cache = array_flip(array_column($sender,'username'));
        }
        $sender = array_column($sender,null,'username');

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();                                                            //smtp方式发送
            $mail->CharSet = PHPMailer::CHARSET_UTF8;
            $mail->Host       = $sender[$senderAddress]['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $senderAddress;
            $mail->Password   = $sender[$senderAddress]['password'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                            //tls:587,ssl:465
            $mail->Port       = 465;
            $mail->setFrom($senderAddress, $sender[$senderAddress]['name']);            //设置发送人
            //设置收件人
            foreach ($receiver as $value){
                $mail->addAddress($value['email'],$value['name']??$value['email']);
            }
            $mail->isHTML(true);
            $mail->Subject = $content['subject'];                                       // 邮件标题
            $mail->Body = $content['body'];
            $mail->send();
        }catch (Exception $exception){
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        //设置发送缓存值
        $emailSender[$senderAddress] = empty($emailSender) ?  1 : $emailSender[$senderAddress] + 1;
        isset($cache) && $emailSender = $cache;
        Cache::set('emailSender',json_encode($emailSender),3600*24);         //缓存24小时
        return true;
    }


}
