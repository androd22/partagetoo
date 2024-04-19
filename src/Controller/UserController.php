<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{

    #[Route('/inscription.html', name: 'user_register', methods: ['GET', 'POST'])]
    public function register(Request $request, EntityManagerInterface $em) : Response
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('password')->getData();
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', "Vous êtes bien inscrit !");
            $this->redirectToRoute('default_home');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form
        ]);
    }

}