<?php
    ini_set('SMTP' , 'smtp.example.com');
    ini_set('smtp_port' , '25');
    ini_set('username' , 'example@example.com');
    ini_set('password' , 'password');
    ini_set('sendmail_from' , 'example@example.com');
   
    var_dump($_POST);
    var_dump($_SESSION);
    die(1);
    function spamcheck($field)
    {
        var_dump($field);
        die('2');
        //filter_var() sanitizes the e-mail
        //address using FILTER_SANITIZE_EMAIL
        $field=filter_var($field, FILTER_SANITIZE_EMAIL);
        
        //filter_var() validates the e-mail
        //address using FILTER_VALIDATE_EMAIL
        if(filter_var($field, FILTER_VALIDATE_EMAIL))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function sendMail($toEmail, $fromEmail, $subject, $message)
    {
        $validFromEmail = spamcheck($fromEmail);
        if($validFromEmail)
        {
            mail($toEmail, $subject, $message, "From: $fromEmail");
        }
    }
    
    $email = isset($_POST['emailInput']) ? $_POST['emailInput'] : false;
    
    if($email != false)
    {
        $yourEmail = "example@example.com";
        $subject = "Link";
        $message = "The link and some message";
        $success = sendMail($email, $yourEmail, $subject, $message);
    }
