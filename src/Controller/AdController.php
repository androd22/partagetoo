<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/publish')]
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

    #[Route('/add', name: 'ad_add', methods: ['GET','POST'])]
    public function add(Request $request, EntityManagerInterface $em, SluggerInterface $slugger):Response
    {
        $ad = new Ad();
        $ad->setCreatedAt(new \DateTimeImmutable());
        $ad->setUpdatedAt(new \DateTimeImmutable());

        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $imageFile = $form->get('image')->getData();
            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
            $imageFile->move(
                $this->getParameter('kernel.project_dir').'/public/images/post',
                $newFilename);
            $ad->setImage($newFilename);
            $em->persist($ad);
            $em->flush();

            $this->addFlash('success', "votre annonce a bien été créée");
           return  $this->redirectToRoute('default_home');
        }

        return $this->render('ad/add.html.twig', [
            'form' => $form
        ]);
    }

}