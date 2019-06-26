<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();  
        $product = new Product();
        $form = $this->createFormBuilder($product, ['attr'=>['id'=>'formSearch']])
                    ->add('name', TextType::class, ['required'=>false])
                    ->add('price', NumberType::class,  ['required'=>false])
                    ->add('save', SubmitType::class, ['label' => 'Rechercher'])
                    ->getForm();
                    

        $form->handleRequest($request);

        if( $request->isXmlHttpRequest() && $request->isMethod('POST') ){
            $product = $form->getData();

            return new JsonResponse(['name'=>$product->getName(),'price'=>$product->getPrice()]);
        }

        /*if( $form->isSubmitted() && $form->isValid() ){
            $product = $form->getData();
            $products = $em->getRepository(Product::class)->findAll();
            return $this->render('home/index.html.twig', ['products'=>$products,'form'=>$form->createView()]);
        }*/


        return $this->render('home/index.html.twig', ['form'=> $form->createView()]);
    }
}
