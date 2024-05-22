<?php
namespace App\EventListener;

use App\Entity\Employe;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordHashListener
{
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function prePersist(Employe $employe, LifecycleEventArgs $event): void
    {
        $this->hashPasswordIfNeeded($employe);
    }

    public function preUpdate(Employe $employe, LifecycleEventArgs $event): void
    {
        $this->hashPasswordIfNeeded($employe);
    }

    private function hashPasswordIfNeeded(Employe $employe): void
    {
        if ($employe->isPasswordChanged() && $employe->getPlainPassword()) {
            try {

                $hashedPassword = $this->passwordEncoder->hashPassword($employe, $employe->getPassword());
                $employe->setPassword($hashedPassword);
                $employe->eraseCredentials();
            } catch (\Exception $e) {

            }
        }
    }
}
