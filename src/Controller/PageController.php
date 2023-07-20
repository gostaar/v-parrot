<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Garage;
use App\Entity\Horaire;
use App\Entity\Voiture;
use App\Repository\HoraireRepository;
use App\Repository\VoitureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PageController extends AbstractController
{
    #[Route('/page_contact', name: 'page_contact')]
    public function contact(): Response
    {
        return $this->render('page/contact.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/page_cgu', name: 'page_cgu')]
    public function cgu(): Response
    {
        return $this->render('page/cgu.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/horaire/{id}', name: 'horaire')]
    public function horaire(Environment $twig, Horaire $horaire, HoraireRepository $horaires): Response
    {
        return new Response($twig->render('page/horaire.html.twig', [
            'horaire' => $horaire,
            'horaires' => $horaires->findAll(), 
            'jours' => $horaire->getJour(),
            'am' => $horaire->getAm(),
            'pm' => $horaire->getPm()
        ])); 
    }

    #[Route('/', name: 'home')]
    public function garage(Garage $garage, Voiture $voiture, VoitureRepository $voitures): Response
    {
        return $this->render('page/garage.html.twig', [
            'garage' => $garage,
            'voiture' => $voiture,
            'voitures' => $voitures->findAll(),

            'equipements' => $voiture->getEquipements(),
            'caracteristique' => $voiture->getCaracteristiques(),
            'galerie' => $voiture->getGalerieImage(),

        ]);
    }

    #[Route('/voiture', name: 'voiture_index')]
    public function voiture(Environment $twig, Voiture $voiture, VoitureRepository $voitureRepository): Response
    {
        return new Response($twig->render('partials/voiture.html.twig', [
            'voiture' => $voiture,
            'voitures' => $voitureRepository->findAll(),
            
             'equipements' => $voiture->getEquipements(),
            'caracteristique' => $voiture->getCaracteristiques(),
            'galerie' => $voiture->getGalerieImage(),
        ]));
    }
    
    #[Route('/voiture/{id}', name: 'voiture')]
    public function detailsVoiture(Environment $twig, Voiture $voiture, VoitureRepository $voitureRepository): Response
    {
        return new Response($twig->render('partials/detailsVoiture.html.twig', [
            'voiture' => $voiture,
            'voitures' => $voitureRepository->findAll(),
            'equipements' => $voiture->getEquipements(),
            'caracteristique' => $voiture->getCaracteristiques(),
            'galerie' => $voiture->getGalerieImage(),
        ]));
    }

}
