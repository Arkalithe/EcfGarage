<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Entity\Caracteristique;
use App\Entity\Equipement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/voitures')]
class VoitureController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/all', name: 'get_all_voitures', methods: ['GET'])]
    public function getAllVoitures(): JsonResponse
    {
        $voitures = $this->entityManager->getRepository(Voiture::class)->findAll();

        return $this->json($voitures, Response::HTTP_OK, [], ['groups' => 'read']);
    }

    #[Route('/{id}', name: 'get_voiture', methods: ['GET'])]
    public function getVoiture(int $id): JsonResponse
    {
        $voiture = $this->entityManager->getRepository(Voiture::class)->find($id);

        if (!$voiture) {
            return new JsonResponse(['error' => 'Voiture non trouvée'], JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse(['voiture' => $voiture], JsonResponse::HTTP_OK);
    }

    #[Route('/add', name: 'add_voiture', methods: ['POST'])]
    public function addVoiture(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $voiture = $serializer->deserialize(json_encode($data), Voiture::class, 'json');

        $errors = $validator->validate($voiture);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
        }

        $this->entityManager->persist($voiture);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Voiture ajoutée avec succès', 'voiture' => $data], JsonResponse::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'update_voiture', methods: ['PUT'])]
    public function updateVoiture(int $id, Request $request, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {
        $voiture = $this->entityManager->getRepository(Voiture::class)->find($id);

        if (!$voiture) {
            return new JsonResponse(['error' => 'Voiture non trouvée'], JsonResponse::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $serializer->deserialize(json_encode($data), Voiture::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $voiture]);

        $errors = $validator->validate($voiture);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
        }

        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Voiture mise à jour avec succès', 'voiture' => $data], JsonResponse::HTTP_OK);
    }

    #[Route('/{id}', name: 'delete_voiture', methods: ['DELETE'])]
    public function deleteVoiture(int $id): JsonResponse
    {
        $voiture = $this->entityManager->getRepository(Voiture::class)->find($id);

        if (!$voiture) {
            return new JsonResponse(['error' => 'Voiture non trouvée'], JsonResponse::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($voiture);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Voiture supprimée avec succès'], JsonResponse::HTTP_OK);
    }

    #[Route('/{voitureId}/add_caracteristique/{caracteristiqueId}', name: 'add_caracteristique_to_voiture', methods: ['POST'])]
    public function addCaracteristiqueToVoiture(int $voitureId, int $caracteristiqueId): JsonResponse
    {
        $voiture = $this->entityManager->getRepository(Voiture::class)->find($voitureId);
        $caracteristique = $this->entityManager->getRepository(Caracteristique::class)->find($caracteristiqueId);

        if (!$voiture || !$caracteristique) {
            return new JsonResponse(['error' => 'Voiture ou Caracteristique non trouvée'], Response::HTTP_NOT_FOUND);
        }

        $voiture->addCaracteristique($caracteristique);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Caracteristique ajoutée à la voiture avec succès'], Response::HTTP_OK);
    }

    #[Route('/{voitureId}/add_equipement/{equipementId}', name: 'add_equipement_to_voiture', methods: ['POST'])]
    public function addEquipementToVoiture(int $voitureId, int $equipementId): JsonResponse
    {
        $voiture = $this->entityManager->getRepository(Voiture::class)->find($voitureId);
        $equipement = $this->entityManager->getRepository(Equipement::class)->find($equipementId);

        if (!$voiture || !$equipement) {
            return new JsonResponse(['error' => 'Voiture ou Equipement non trouvée'], Response::HTTP_NOT_FOUND);
        }

        $voiture->addEquipement($equipement);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Equipement ajouté à la voiture avec succès'], Response::HTTP_OK);
    }

}
