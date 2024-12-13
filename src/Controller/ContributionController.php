<?php

namespace App\Controller;

use App\Entity\Contribution;
use App\Form\ContributionType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ContributionController extends AbstractController
{
    #[Route('/contribution', name: 'app_contribution_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $contribution = new Contribution();
        $form = $this->createForm(ContributionType::class, $contribution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contribution->setDate(new \DateTime());
            $em->persist($contribution);
            $em->flush();

            return $this->redirectToRoute('projet_show'); // Redirige vers une page appropriée
        }

        return $this->render('contribution/index.html.twig', [
            'form' => $form->createView(), // Important !
        ]);
    }
}
