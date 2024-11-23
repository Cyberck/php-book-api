<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetBooksByCategoryAction extends AbstractController
{
    public function __invoke(Request $request, BookRepository $bookRepository): void
    {
        $categoryId = $request->get("categoryId");

        var_dump($categoryId);
        exit;
    }

}