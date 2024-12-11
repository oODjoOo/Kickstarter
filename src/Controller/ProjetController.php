<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
// use App\Entity\Projet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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

    

    // #[Route('/home', name: 'home_page', methods:['GET', 'POST'])]
}
