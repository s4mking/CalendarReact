<?php

namespace App\Controller\Api;

use App\Entity\User;
use FOS\RestBundle\View\View;
use App\Repository\UserRepository;
use Entities\User as EntitiesUser;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserController extends AbstractFOSRestController
{
    public function __construct(TokenStorageInterface $tokenStorageInterface, JWTTokenManagerInterface $jwtManager)
    {
        $this->jwtManager = $jwtManager;
        $this->tokenStorageInterface = $tokenStorageInterface;
    }
    /**
     * Retrieves User account
     * @Rest\Get("/users/me", name="api_get_profile")
     * @Rest\View(serializerGroups={"user"})
     */
    public function getProfile(Request $request): View
    {
        dd($request);
        dd(($this->container->get('security.token_storage')->getToken()));
        $decodedJwtToken = $this->jwtManager->decode($this->tokenStorageInterface->getToken());

        return View::create($this->getUser(), Response::HTTP_OK);
    }


    /**
     * Modify User account
     * @Rest\Put("/users/me", name="api_put_profile")
     * @Rest\View(serializerGroups={"user"})
     */
    public function updateProfile(Request $request): View
    {
        dd($request);
        dd(($this->container->get('security.token_storage')->getToken()));
        $decodedJwtToken = $this->jwtManager->decode($this->tokenStorageInterface->getToken());

        return View::create($this->getUser(), Response::HTTP_OK);
    }

    /**
     * Put password
     * @Rest\Put("/users/me/password", name="api_put_password")
     * @Rest\View(serializerGroups={"user"})
     */
    public function updatePassword(Request $request): View
    {
        dd($request);
        dd(($this->container->get('security.token_storage')->getToken()));
        $decodedJwtToken = $this->jwtManager->decode($this->tokenStorageInterface->getToken());

        return View::create($this->getUser(), Response::HTTP_OK);
    }


    /**
     * Retrieves an Article resource
     * @Rest\Get("/users/{id}")
     * @Rest\View(serializerGroups={"user"})
     * @ParamConverter()
     */
    public function getUserTest($id, UserRepository $repo)
    {
        $user = $repo->findById($id);
        return View::create($user, Response::HTTP_OK);
    }
}
