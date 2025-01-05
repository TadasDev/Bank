<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InvestmentController extends AbstractController
{
    #[Route('/investment/connect-paysera', name: 'app_connect_paysera')]
    public function connectPaysera(): Response
    {
        return $this->render('investment/connect_paysera.html.twig');
    }

    #[Route('/investment', name: 'app_investment')]
    public function index(): Response
    {
        return $this->render('investment/index.html.twig', [
            'controller_name' => 'InvestmentController',
        ]);
    }
}
