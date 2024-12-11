<?php

namespace App\Controller;

use App\Entity\Projet;
// use App\Entity\Projet;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjetController extends AbstractController
{
    #[Route('/projet', name: 'projet_index')]
    public function index(ProjetRepository $projetRepository): Response
    {
        $projets = $projetRepository->findAll();
        return $this->render('projet/index.html.twig', [
            'projets' => $projets,
        ]);
    }

    #[Route('/projet/{titre}', name: 'projet_show')]
    public function show(string $titre, ProjetRepository $projetRepository): Response
    {
        $projet = $projetRepository->findOneBy(['titre' => $titre]);

        return $this->render('projet/show.html.twig', [
            'projet' => $projet,
        ]);
    }

    #[Route('/ajouter', name: 'projet_ajouter', methods:['GET', 'POST'])]
    public function new(Request $request, ProjetRepository $projetRepository): Response {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $projetRepository->save($projet, true);
            return $this->redirectToRoute('projet_index');
        }
        return $this->render('projet/ajouter.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    // #[Route('/home', name: 'home_page', methods:['GET', 'POST'])]
}
