<?php

namespace App\Controller;

use App\Entity\Horaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/horaires/')]
class HorairesController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('all', name: 'get_all_horaires', methods: ['GET'])]
    public function getAllHoraires(): JsonResponse
    {
        $horaires = $this->entityManager->getRepository(Horaire::class)->findAll();

        return $this->json($horaires, Response::HTTP_OK, [], ['groups' => 'read']);
    }

    #[Route('{id}', name: 'get_horaire', methods: ['GET'])]
    public function getHoraire(int $id): JsonResponse
    {
        $horaire = $this->entityManager->getRepository(Horaire::class)->find($id);

        if (!$horaire) {
            return new JsonResponse(['error' => 'Horaire non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse(['horaire' => $horaire], JsonResponse::HTTP_OK);
    }

    #[Route('add', name: 'add_horaire', methods: ['POST'])]
    public function addHoraire(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $horaire = $serializer->deserialize(json_encode($data), Horaire::class, 'json');

        $errors = $validator->validate($horaire);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
        }

        $this->entityManager->persist($horaire);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Horaire ajouté avec succès', 'horaire' => $data], JsonResponse::HTTP_CREATED);
    }

    #[Route('{id}', name: 'update_horaire', methods: ['PUT'])]
    public function updateHoraire(int $id, Request $request, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {
        $horaire = $this->entityManager->getRepository(Horaire::class)->find($id);

        if (!$horaire) {
            return new JsonResponse(['error' => 'Horaire non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $serializer->deserialize(json_encode($data), Horaire::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $horaire]);

        $errors = $validator->validate($horaire);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
        }

        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Horaire mis à jour avec succès', 'horaire' => $data], JsonResponse::HTTP_OK);
    }

    #[Route('{id}', name: 'delete_horaire', methods: ['DELETE'])]
    public function deleteHoraire(int $id): JsonResponse
    {
        $horaire = $this->entityManager->getRepository(Horaire::class)->find($id);

        if (!$horaire) {
            return new JsonResponse(['error' => 'Horaire non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($horaire);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Horaire supprimé avec succès'], JsonResponse::HTTP_OK);
    }
}
