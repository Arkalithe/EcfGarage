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
        
        if ($request->attributes->get('_route') !== 'app_login') {
            return;
        }
        
        $tokenString = $request->cookies->get('jwt_token');

        if (!$tokenString) {
            
            $event->setResponse(new JsonResponse(['message' => 'Token not provided'], JsonResponse::HTTP_UNAUTHORIZED));
            return;
        }

        try {
            $token = $this->config->parser()->parse($tokenString);
            $constraints = [new IssuedBy('http://127.0.0.1:8000'), new PermittedFor('http://localhost:3636')];
            $this->config->validator()->assert($token, ...$constraints);
        } catch (\Exception $e) {
            
            $event->setResponse(new JsonResponse(['message' => 'Invalid token'], JsonResponse::HTTP_UNAUTHORIZED));
            return;
        }
    }
}
