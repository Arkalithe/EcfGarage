<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;

use Lcobucci\JWT\Validation\Constraint\IssuedBy;
use Lcobucci\JWT\Validation\Constraint\PermittedFor;

class JwtAuthorizationListener
{
    private Configuration $config;

    public function __construct()
    {
        $this->config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText('test')
        );
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest(); 
        $path = $request->getPathInfo();
        $excludedRoutes = ['/api/login', '/api/horaires', '/api/docs', '/api/employes', '/api/employes/add'];
        
        if (in_array($path, $excludedRoutes)) {
            return;
        }
        
        $tokenString = $request->cookies->get('jwt_token');

        if (!$tokenString) {
            
            $event->setResponse(new JsonResponse(['message' => 'Token not provided'], JsonResponse::HTTP_UNAUTHORIZED));
            return;
        }

        try {
            $token = $this->config->parser()->parse($tokenString);
            $constraints = [new IssuedBy('https://127.0.0.1:8000'), new PermittedFor('https://localhost:3000')];
            $this->config->validator()->assert($token, ...$constraints);

            if ($token instanceof \Lcobucci\JWT\Token\Plain) {
                $role = $token->claims()->get('role');
                $userIdFromToken = $token->claims()->get('id');
                $requestUserId = $request->query->get('id'); 

                if ($userIdFromToken === $requestUserId) {
                    $request->attributes->set('user_role', $role);
                } else {
                    throw new \RuntimeException('User ID does not match the one provided in the request');
                }
            } else {
                throw new \RuntimeException('Invalid token type');
            }
        } catch (\Exception $e) {
            $event->setResponse(new JsonResponse(['message' => 'Invalid token'], JsonResponse::HTTP_UNAUTHORIZED));
            return;
        }
    }
}
