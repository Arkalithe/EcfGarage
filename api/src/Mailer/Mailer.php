<?php
namespace App\Mailer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MyMailer
{
    private $mailer;

    public function __construct(PHPMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail($subject, $body, $email)
    {
   
        try {
            $this->mailer->isSMTP();
            $this->mailer->Host = 'smtp.ethereal.email';
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = 'daija.schoen71@ethereal.email';
            $this->mailer->Password = '7UMVtvkn5GNncvK2w4';
            $this->mailer->SMTPSecure = 'tls';
            $this->mailer->Port = 587;

            $this->mailer->setFrom($email, 'Your Name');
            $this->mailer->addAddress("daija.schoen71@ethereal.email");
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;

            if (!$this->mailer->send()) {
                throw new \Exception('Unable to send email. Error: ' . $this->mailer->ErrorInfo);
            }

            return true;
        } catch (Exception $e) {
            throw new \Exception('Unable to send email. Error: ' . $e->getMessage());
        }
    }
}
