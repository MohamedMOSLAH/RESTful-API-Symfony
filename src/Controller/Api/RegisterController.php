<?php

namespace App\Controller\Api;

use App\Entity\User;
use JMS\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class RegisterController extends AbstractController {

    #[Route('/api/register', name: 'api_register')]
    public function register(ValidatorInterface $validator, SerializerInterface $serializer, 
    Request $request, UserPasswordHasherInterface $userPasswordHasher, 
    EntityManagerInterface $entityManager): Response
    {

        if($this->getUser()){
            return new JsonResponse($serializer->serialize(['message' => "you must logout into get register page"], 'json'), Response::HTTP_UNAUTHORIZED, [], true);
        }

        $newUser = $serializer->deserialize($request->getContent(), User::class, 'json');

        $error = $validator->validate($newUser);

        if($error->count() > 0){
            return new JsonResponse($serializer->serialize($error, 'json'), Response::HTTP_BAD_REQUEST, [], true);
        }

        $getPassword = $newUser->getPassword();



        $user = new User();
        $newUser->setPassword($userPasswordHasher->hashPassword($user, $getPassword));

        $entityManager->persist($newUser);
        $entityManager->flush();

        // do anything else you need here, like send an email


        return new JsonResponse($serializer->serialize(['message' => "your account has been created"], "json"), Response::HTTP_OK, ['accept' => 'application/json'], true );
    }
}