<?php

namespace App\Controller;

use App\Entity\Employe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[Route('/api/employes/')]
class EmployeController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('all', name: 'get_all_employes', methods: ['GET'])]
    public function getAllEmployes(): JsonResponse
    {
        $employes = $this->entityManager->getRepository(Employe::class)->findAll();

        return $this->json($employes, Response::HTTP_OK, [], ['groups' => 'read']);
    }

    #[Route('{id}', name: 'get_employe', methods: ['GET'])]
    public function getEmploye(int $id): JsonResponse
    {
        $employe = $this->entityManager->getRepository(Employe::class)->find($id);

        if (!$employe) {
            return new JsonResponse(['error' => 'Employé non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse(['employe' => $employe], JsonResponse::HTTP_OK);
    }

    #[Route('add', name: 'add_employe', methods: ['POST'])]
    public function addEmploye(Request $request, ValidatorInterface $validator, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {

        $data = json_decode($request->getContent(), true);

        $errors = $validator->validate($data, null, ['groups' => 'registration']);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
    
            return new JsonResponse(['errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
        }

        $employe = new Employe();
        $employe->setMail($data['mail']);
        $employe->setPassword($data['password']);
        $employe->setLastname($data['lastname']);
        $employe->setFirstname($data['firstname']);
        $employe->setRoles((array) $data['roles']);

        $hashedPassword = $passwordHasher->hashPassword($employe, $employe->getPassword());
        $employe->setPassword($hashedPassword);

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

    #[Route('{id}', name: 'update_employe', methods: ['PUT'])]
    public function updateEmploye(int $id, Request $request, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {
        $employe = $this->entityManager->getRepository(Employe::class)->find($id);

        if (!$employe) {
            return new JsonResponse(['error' => 'Employé non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $serializer->deserialize(json_encode($data), Employe::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $employe]);

        $errors = $validator->validate($employe);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
        }

        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Employé mis à jour avec succès', 'employe' => $data], JsonResponse::HTTP_OK);
    }

    #[Route('{id}', name: 'delete_employe', methods: ['DELETE'])]
    public function deleteEmploye(int $id): JsonResponse
    {
        $employe = $this->entityManager->getRepository(Employe::class)->find($id);

        if (!$employe) {
            return new JsonResponse(['error' => 'Employé non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($employe);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Employé supprimé avec succès'], JsonResponse::HTTP_OK);
    }
}
