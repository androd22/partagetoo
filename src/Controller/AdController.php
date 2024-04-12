<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdController extends AbstractController
{
    #[Route('/ad/{id}', name: 'ad_show', methods: ['GET'])]
    public function show($id, AdRepository $adRepository): Response
    {
        $ad = $adRepository->find($id);
        return  $this->render('ad/show.html.twig', [
            'ad' => $ad
        ]);
    }

}