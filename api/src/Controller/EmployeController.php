<?php

namespace App\Controller;

use App\Entity\Employe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/employes')]
class EmployeController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('', name: 'add_employe', methods: ['POST'])]
    public function addEmploye(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {

        $data = json_decode($request->getContent(), true);

        $employe = $serializer->deserialize(json_encode($data), Employe::class, 'json');


        $errors = $validator->validate($employe);

        if (count($errors) > 0) {

            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }

            return new JsonResponse(['errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
        }


        $this->entityManager->persist($employe);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Employé ajouté avec succès', 'employe' => $data], JsonResponse::HTTP_CREATED);
    }
}
