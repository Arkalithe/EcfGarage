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
        $this->hashPasswordIfNeeded($employe);
    }

    public function preUpdate(Employe $employe): void
    {
        if ($employe->isPasswordChanged()) {
            $this->hashPasswordIfNeeded($employe);
        }
        $this->hashPasswordIfNeeded($employe);
    }

    private function hashPasswordIfNeeded(Employe $employe): void
    {
        if ($employe->getPassword()) {
            try {

                $hashedPassword = $this->passwordEncoder->hashPassword($employe, $employe->getPassword());
                $employe->setPassword($hashedPassword);
            } catch (\Exception $e) {

            }
        }
    }
}
