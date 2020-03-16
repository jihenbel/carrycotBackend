<?php


namespace App\Manager;


use App\Entity\Carrycot;

class CarrycotManager extends AbstractManager
{

    public function saveCarrycot(Carrycot $carrycot, $data)
    {
        $carrycot->setName($data['name']);
        $carrycot->setDescription($data['description']);
        $carrycot->setPrice($data['price']);
        $carrycot->setImagePath($data['imagePath']);

        $this->persist($carrycot);
        $this->flush();
    }
}
