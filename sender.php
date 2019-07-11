<?php


namespace app;

include_once('vendor/autoload.php');

class sender
{
    protected $mailer;
    /**
     * @var array Конфигурация исходящего почтового ящика
     */
    protected $config = ['login' => 'text@exemple.com',
                      'pass' => 'password',
                      'host' => 'smtp.yandex.ru',
                      'port' => '465',
                      'from' => 'text@exemple.com',
                      'encryption' => 'ssl'];

    protected static $instance;

    /**
     * Отправка письма
     *
     * @param $mail
     * @param $subject
     * @param $text
     *
     * @return mixed
     */

    public function send($mail, $subject, $text)
    {
        $message = new \Swift_Message();

        // Set a "subject"
        $message->setSubject($subject);

        // Set the "From address"
        $message->setFrom($mail);

        $message->setBody($text);

        return $this->mailer->send($message);
    }

    private function __construct($config = [])
    {

        if($config !== []){
            $this->config = $config;
        }
        $this->init($this->config);
    }

    /**
     * Инициализация класса работы с почтой
     *
     * @param array $config
     *
     * @return $this
     */
    public function init(array $config)
    {
        $transport = (new \Swift_SmtpTransport($config['host'], $config['port']))
            ->setUsername($config['login'])
            ->setPassword($config['pass'])
            ->setEncryption($config['encryption']);
        $this->mailer = new \Swift_Mailer($transport);

        return $this;
    }

    public static function instance($config = []):self
    {
        if(!static::$instance){
            static::$instance = new static($config);
        }
        return static::$instance;
    }


}