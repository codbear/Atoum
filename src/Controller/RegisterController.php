<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    public function register(Request $request, UserPasswordEncoderInterface $encoder, UserRepository $repository): Response
    {

        $body = json_decode($request->getContent(), true);

        $email = $body['username'];
        $firstName = $body['firstName'];
        $lastName = $body['lastName'];
        $password = $body['password'];

        $isEmailAlreadyInUse = $repository->findOneByEmail($email) !== null;

        if ($isEmailAlreadyInUse) {
            return new Response('Email already exists', 409);
        }

        $user = new User();
        $user
            ->setEmail($email)
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setPassword($encoder->encodePassword($user, $password));

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response('User created.', 200);
    }
}
