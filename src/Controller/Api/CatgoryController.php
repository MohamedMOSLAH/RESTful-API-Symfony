<?php

namespace App\Controller\Api;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController 
{
    #[Route('api/category/new', name:"api_category_add", methods:['POST'])]
    public function addCategory(SerializerInterface $serializer, Request $request, EntityManagerInterface $entityManager):JsonResponse
    {
        $category = $serializer->deserialize( $request->getContent(), Category::class, "json" );

        $entityManager->persist($category);
        $entityManager->flush();

    }
}