<?php

namespace App\Controller\Api;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryController extends AbstractController 
{
    #[Route('api/category/new', name:"api_category_add", methods:['POST'])]
    public function addCategory():JsonResponse
    {
        
    }
}