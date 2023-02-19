<?php

namespace App\Controller;

use App\Repository\MEPRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MEPController extends AbstractController
{
    #[Route('/{id}/mep', name: 'app_mep')]
    public function getMEP(MEPRepository $MEPRepository, $id): JsonResponse
    {
        $mep = $MEPRepository->findOneById($id);
        if (!$mep) {
            return $this->json(["Can't found any MEP with this ID"]);
        }

        $name = explode(' ', $mep->getFullName());

        return $this->json([
            'MEP' => [
                'id' => $mep->getIdNumber(),
                'firstName' => $name[0],
                'lastName' => $name[1],
                'country' => $mep->getCountry(),
                'politicalGroup' => $mep->getPoliticalGroup()
            ]
        ]);
    }

    #[Route('/mep', name: 'app_all_mep')]
    public function getAllMEP(MEPRepository $MEPRepository): JsonResponse
    {
        $MEPs = $MEPRepository->findAll();
        $response = [];

        foreach ($MEPs as $MEP) {
            $name = explode(' ', $MEP->getFullName());
            $response[] = [
                'id' => $MEP->getIdNumber(),
                'firstName' => $name[0],
                'lastName' => $name[1],
                'country' => $MEP->getCountry(),
                'politicalGroup' => $MEP->getPoliticalGroup()
            ];
        }

        return $this->json($response);
    }

}
