<?php

namespace ContactModule\Classes;

use UserModule\Entity\User as UserEntity;

class EmailHelper
{

    public function __construct()
    {

    }

    /**
     * Send the activation email
     *
     * @param \UserModule\Entity\User $from
     * @param \UserModule\Entity\User $to
     * @param string $subject
     * @param string $emailContent
     * @return mixed
     */
    public function sendEmail(UserEntity $from, UserEntity $to, $subject, $emailContent)
    {

        $transport = \Swift_SmtpTransport::newInstance("mail.cloudadmin.mx", 465, 'ssl')
                     ->setUsername('culiacan@cloudadmin.mx')
                     ->setPassword('');

        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance($subject)
                   ->setFrom(array($from->getEmail() => $from->getFullName()))
                   ->setTo(array($to->getEmail() => $to->getFullName()))
                   ->setBody($emailContent, 'text/html');

        return $mailer->send($message);
    }

}