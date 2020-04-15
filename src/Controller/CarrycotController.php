<?php

namespace App\Controller;

use App\Entity\Carrycot;
use App\Manager\CarrycotManager;
use App\Services\FileService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CarrycotController extends AbstractFOSRestController
{
    /**
     * @Route("/carrycot", name="carrycot")
     * @param Request $request
     */
    public function index(Request $request, CarrycotManager $carrycotManager, FileService $fileService)
    {
        $data = $request->request;
        $image = $request->files->get('file');
        if ($image) {
            /**
             * @var File $image
             */
            $originalImageName = $request->files->get('file')->getClientOriginalName();
            $newImageName = uniqid() . '-' . $originalImageName;

            $fileService->move($image, $this->getParameter('images_directory'), $newImageName);
            $carrycot = new Carrycot();
            $data = [
                'name' => $data->get('name'),
                'description' => $data->get('description'),
                'price' => $data->get('price'),
                'imagePath' => $newImageName
            ];

            $carrycotManager->saveCarrycot($carrycot, $data);
        }
        return $this->json($carrycot) ;
    }

    /**
     * @Rest\Get("/carrycots")
     */
    public function getAll(EntityManagerInterface $entityManager)
    {
        $carrycots = $entityManager->getRepository(Carrycot::class)->findAll();
        return $this->json($carrycots);
    }
}
