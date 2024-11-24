<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetBooksByHardExampleAction extends AbstractController
{
    public function __invoke(BookRepository $bookRepository): array
    {
        return $bookRepository->findByExampleField(1);
    }

}