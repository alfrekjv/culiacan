<?php

namespace ContactModule\Classes;

class ContactHelper {
 
    protected $emailHelper;
    protected $config;
    
    public function __construct() {}
    
    public function setEmailHelper($helper)
    {
        $this->emailHelper = $helper;
    }
    
    public function setConfig($config) {
        $this->config = $config;
    }
    
    public function sendContactEmail($name, $email, $subject, $message, $aboutType, $phone)
    {
        $fromUser = new \UserModule\Entity\User(array(
            'firstname' => $this->config['fromName'], 'email' => $this->config['fromEmail']
        ));
        
        if(empty($phone)) {
            $phone = 'N/A';
        }
        
        // Iterate over the admins and sent out their emails
        $toUser = new \UserModule\Entity\User(array(
            'firstname' => $this->config['toName'], 'email' => $this->config['toEmail']
        ));
        
        $body = <<<BODY
Hey {$toUser->getFullName()},

A user has filled in the contact form.

Name: {$name}
Email: {$email}
Subject: {$subject}
About type: {$aboutType}
Phone: {$phone}

Message:
{$message}

Regards,
{$fromUser->getFullName()}
BODY;
        
        // Dispatch email out.
        $this->emailHelper->sendEmail($fromUser, $toUser, 'New Contact Message', nl2br($body));
    }
        
    

    
}