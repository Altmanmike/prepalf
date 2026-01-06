<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $pRepo, Request $request, EntityManagerInterface $entityManager): Response
    {
        $products = $pRepo->findAll();       
        //dd($products);
        
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setName(htmlspecialchars(trim($form->get('name')->getData())));
            $product->setPrice(htmlspecialchars(trim($form->get('price')->getData())));
            $product->setStock(htmlspecialchars(trim($form->get('stock')->getData())));            
            foreach ($form->get('tags')->getData() as $t) {                
                $product->addTag($t);
            }
            $entityManager->persist($product);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_home');
        }
        
        return $this->render('home/index.html.twig', [
            'products' => $products,
            'form' => $form->createView(),
        ]);
    }
}