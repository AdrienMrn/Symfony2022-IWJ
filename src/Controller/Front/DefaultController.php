<?php

namespace App\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'default_index')]
    public function index(): Response
    {
        return $this->render('front/default/index.html.twig');
    }

    #[IsGranted('ROLE_SUPER_ADMIN')]
    #[Route('/test', name: 'default_test')]
    public function test(): Response
    {
        return $this->render('front/default/index.html.twig');
    }
}
