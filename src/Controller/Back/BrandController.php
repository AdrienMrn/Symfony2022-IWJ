<?php

namespace App\Controller\Back;

use App\Entity\Brand;
use App\Form\BrandType;
use App\Repository\BrandRepository;
use App\Security\BrandVoter;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/brand')]
class BrandController extends AbstractController
{
    #[Route('/', name: 'brand_index', methods: ['GET'])]
    public function index(BrandRepository $brandRepository): Response
    {
        return $this->render('back/brand/index.html.twig', [
            'brands' => $brandRepository->findBy([], ['position' => 'ASC']),
        ]);
    }

    #[Route('/new', name: 'brand_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $brand = new Brand();
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($brand);
            $entityManager->flush();

            return $this->redirectToRoute('back_brand_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/brand/new.html.twig', [
            'brand' => $brand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'brand_show', methods: ['GET'])]
    public function show(Brand $brand): Response
    {
        return $this->render('back/brand/show.html.twig', [
            'brand' => $brand,
        ]);
    }

    #[Route('/{id}/edit', name: 'brand_edit', methods: ['GET', 'POST'])]
    #[IsGranted(BrandVoter::EDIT, 'brand')]
    //#[Security("is_granted('edit', brand)")]
    public function edit(Request $request, Brand $brand, EntityManagerInterface $entityManager): Response
    {
        //$this->denyAccessUnlessGranted(BrandVoter::EDIT, $brand);

        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('back_brand_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/brand/edit.html.twig', [
            'brand' => $brand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'brand_delete', methods: ['POST'])]
    public function delete(Request $request, Brand $brand, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$brand->getId(), $request->request->get('_token'))) {
            $entityManager->remove($brand);
            $entityManager->flush();
        }

        return $this->redirectToRoute('back_brand_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/{position}', name: 'brand_move', methods: ['GET'], requirements: ['position' => 'up|down'])]
    public function move($position, Brand $brand, EntityManagerInterface $entityManager): Response
    {
        $position = $position === 'up' ? $brand->getPosition()-1 : $brand->getPosition()+1;
        $brand->setPosition($position);
        $entityManager->flush();


        return $this->redirectToRoute('back_brand_index', [], Response::HTTP_SEE_OTHER);
    }
}
