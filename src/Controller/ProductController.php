<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;

class ProductController extends Controller
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
		$product = new Product();
		$product->setName('Keyboard');
		$product->setPrice(19.99);
		$product->setDescription('Bla-bla-bla');
		
		// говорим Doctrine что хотим работать с этим экземпляром Product 
		$em->persist($product);
		
		//выполняем запрос(Insert)
		$em->flush();
		
		return new Response('Saved new product with id '.$product->getId());
    }
	
	/**
     * @Route("/product/{id}", name="product_show")
     */
	 public function showAction($id)
	 {
		 $product = $this->getDoctrine()
		   ->getRepository(Product::class)
		   ->find($id);
		   
		   if (!$product)
		   {
			   throw $this->createNotFoundException('No product found for id '.$id);
		   }
		   return new Response('Check out this great product: '.$product->getName());
	 }
	 
	 
}