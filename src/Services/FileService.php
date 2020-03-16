<?php


namespace App\Services;


use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;

class FileService
{

    /**
     * @param $file File
     * @param $directory
     * @param $filename
     * @return \Exception|FileException
     */
    public function move($file, $directory, $filename)
    {
        try {
            $file->move(
                $directory,
                $filename
            );
        } catch (FileException $exception) {
            return $exception;
        }
    }
}
