<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/product")
 * @IsGranted("ROLE_PRODUCTOR")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository, UserInterface $user): Response
    {
        
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findBy(['user' => $user]),
        ]);
    }

    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserInterface $user): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Product $product, UserInterface $user): Response
    {
        if ($user === $product->getUser()) {

            $form = $this->createForm(ProductType::class, $product);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
    
                return $this->redirectToRoute('product_index');
            }
    
            return $this->render('product/edit.html.twig', [
                'product' => $product,
                'form' => $form->createView(),
            ]);
        }
        return $this->redirectToRoute('product_index');
    }

    /**
     * @Route("/{id}", name="product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($user === $product->getUser()) {
            if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($product);
                $entityManager->flush();
            }

            return $this->redirectToRoute('product_index');
        }
        return $this->redirectToRoute('product_index');
    }
}
