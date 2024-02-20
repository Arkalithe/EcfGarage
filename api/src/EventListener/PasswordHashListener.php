<?php
namespace App\EventListener;

use App\Entity\Employe;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordHashListener
{
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function prePersist(Employe $employe): void
    {
        $this->hashPassword($employe);
    }

    public function preUpdate(Employe $employe): void
    {
        $this->hashPassword($employe);
    }

    private function hashPassword(Employe $employe): void
    {
        if (!$employe->getPassword()) {
            return;
        }

        $hashedPassword = $this->passwordEncoder->hashPassword($employe, $employe->getPassword());
        $employe->setPassword($hashedPassword);
    }
}
