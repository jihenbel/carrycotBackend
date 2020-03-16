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
//            try {
//                $image->move(
//                    $this->getParameter('images_directory'),
//                    $newImageName
//                );
//            } catch (FileException $exception) {
//                return $exception;
//            }
            $carrycot = new Carrycot();
            $data = [
                'name' => $data->get('name'),
                'description' => $data->get('description'),
                'price' => $data->get('price'),
                'imagePath' => $request->files->get('file')
            ];

            $carrycotManager->saveCarrycot($carrycot, $data);
//            $carrycot->setName($data->get('name'));
//            $carrycot->setDescription($data->get('description'));
//            $carrycot->setPrice($data->get('price'));
//            $carrycot->setImagePath($request->files->get('file'));
//
//            $entityManager->persist($carrycot);
//        $entityManager->flush();
        }
        return $this->json($request->files->get('file')) ;
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
