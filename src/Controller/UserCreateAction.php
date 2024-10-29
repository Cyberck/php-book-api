<?php

declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Component\User\UserFactory;
use App\Component\User\UserManager;
use App\Entity\User;
use App\Repository\UserRepository; // UserRepository import qilinadi
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UserCreateAction extends AbstractController
{
    public function __construct(
        private readonly UserFactory $userFactory,
        private readonly UserManager $userManager,
        private readonly ValidatorInterface $validator,
        private readonly UserRepository $userRepository // UserRepository qabul qilinadi
    ) {
    }

    public function __invoke(User $data): User
    {
        // Email mavjudligini tekshirish
        $existingUser = $this->userRepository->findOneBy(['email' => $data->getEmail()]);
        if ($existingUser) {
            // Xato xabari berish
            throw new \RuntimeException("Bu email oldin ro'yxatdan o'tgan.", Response::HTTP_CONFLICT);
        }

        $this->validator->validate($data);

        $user = $this->userFactory->create(
            $data->getEmail(),
            $data->getPassword(),
            $data->getAge(),
            $data->getPhone(),
            $data->getGender()
        );

        $this->userManager->save($user, true);
        return $user;
    }
}
