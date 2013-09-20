<?php

namespace Application\Classes;

use Application\Entity\User as UserEntity;

class Email
{

    public function __construct()
    {

    }

    /**
     * Send the activation email
     *
     * @param \UserModule\Entity\User $from
     * @param \UserModule\Entity\User $to
     * @param string                  $subject
     * @param string                  $emailContent
     *
     * @return mixed
     */
    public function sendEmail(UserEntity $from, UserEntity $to, $subject, $emailContent)
    {

        $transport = \Swift_SmtpTransport::newInstance('', 465, 'ssl')
                        ->setUsername('')->setPassword('');
        $mailer    = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance($subject)
            ->setFrom(array('culiacan@cloudadmin.mx' => 'Apoyo Culiacán'))
            ->setTo(array($to->getEmail() => $to->getFullName()))
            ->setBody($emailContent, 'text/html');

        return $mailer->send($message);

    }

}