<?php

namespace App\Controller;

use App\Entity\Employe;
use DateTimeImmutable;
use DateInterval;
use Doctrine\ORM\EntityManagerInterface;


use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/api/login', name: 'app_login', methods: ['POST'])]
    public function login(Request $request): JsonResponse
    {

         $data = json_decode($request->getContent(), true);


         $userRepository = $this->entityManager->getRepository(Employe::class);
         $employe = $userRepository->findOneBy(['mail' => $data['mail']]);
 

         if (!$employe || !$this->passwordHasher->isPasswordValid($employe, $data['password'])) {
             return new JsonResponse(['message' => 'Identifiants invalides'], JsonResponse::HTTP_UNAUTHORIZED);
         }


        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText('Test')
        );

        // Création du token JWT
        $issuedAt = new DateTimeImmutable();
        $expiresAt = $issuedAt->add(new DateInterval('PT1H'));
        $token = $config->builder()
            ->issuedBy('http://localhost:8000')
            ->permittedFor('http://localhost:3636')
            ->issuedAt($issuedAt) 
            ->expiresAt($expiresAt)
            ->withClaim('mail', $employe->getMail())
            ->withClaim('role', $employe->getRole())
            ->getToken($config->signer(), $config->signingKey());

        return new JsonResponse(['token' => $token->toString()]);
    }
}
