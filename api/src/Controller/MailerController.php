<?php
namespace App\Controller;

use App\Mailer\MyMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class MailerController extends AbstractController
{
    private $myMailer;

    public function __construct(MyMailer $myMailer)
    {
        $this->myMailer = $myMailer;
    }

    #[Route('/api/send-email', name: 'end_email', methods: ['POST'])]
    public function sendEmail(Request $request): Response
    {

        $nom = $request->request->get('nom');
        $prenom = $request->request->get('prenom');
        $email = $request->request->get('email');
        $phone = $request->request->get('phone');
        $message = $request->request->get('message');

        var_dump($nom);
        var_dump($prenom);
        var_dump($email);
        var_dump($phone);
        var_dump($message);

        $subject = 'Nouveau message de ' . $nom . ' ' . $prenom;
        $body = 'Nom: ' . $nom . "\n";
        $body .= 'Prenom: ' . $prenom . "\n";
        $body .= 'Email: ' . $email . "\n";
        $body .= 'Telephone: ' . $phone . "\n";
        $body .= 'Message: ' . $message . "\n";

        try {
            $this->myMailer->sendEmail($subject, $body, $email);
            return new JsonResponse(['message' => 'Email envoyé avec succès!'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'Échec de l\'envoi de l\'email. Veuillez réessayer plus tard.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
