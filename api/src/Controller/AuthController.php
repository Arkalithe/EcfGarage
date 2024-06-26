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
use Symfony\Component\HttpFoundation\Cookie;

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

        $issuedAt = new DateTimeImmutable();
        $expiresAt = $issuedAt->add(new DateInterval('PT1H'));
        $token = $config->builder()
            ->issuedBy('https://localhost:8000')
            ->permittedFor('https://localhost:3000')
            ->issuedAt($issuedAt)
            ->expiresAt($expiresAt)
            ->withClaim('mail', $employe->getMail())
            ->withClaim('id', $employe->getId())
            ->withClaim('role', $employe->getRoles())
            ->getToken($config->signer(), $config->signingKey());


        $cookie = Cookie::create('jwt_token', $token->toString())
            ->withHttpOnly(true)
            ->withExpires($expiresAt)
            ->withPath('/')
            ->withSameSite('none')
            ->withSecure(true);


        $responseData = [
            'id' => $employe->getId(),
            'role' => $employe->getRoles()
        ];

        $response = new JsonResponse($responseData);
        $response->headers->setCookie($cookie);

        return $response;
    }

    #[Route('/api/logout', name: 'app_logout', methods: ['POST'])]
    public function logout(): JsonResponse
    {
        $response = new JsonResponse(['message' => 'Deconnexion Reussie']);
       
        $cookie = Cookie::create('jwt_token', '')
            ->withHttpOnly(true)
            ->withExpires(new \DateTimeImmutable('-1 hour')) 
            ->withPath('/')
            ->withSameSite('none')
            ->withSecure(true);

        $response->headers->setCookie($cookie);

        return $response;
    }
}
