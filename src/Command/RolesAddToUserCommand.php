<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'roles:add-to-user',
    description: "User'ga rol qo'shish",
    aliases: ['r:add']
)]
class RolesAddToUserCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $idQuestion = new Question("Id kiriting: ");

        $questionHelper = $this->getHelper('question');
        $id = $questionHelper->ask($input, $output, $idQuestion);

        while (!$id) {
            $id = $questionHelper->ask($input, $output, $idQuestion);

            if ($id) {
                $io->info("Kiritilgan id: " . $id);
            } else {
                $io->warning("id kiritish majburiy!!!");
            }
        }

        return Command::SUCCESS;
    }
}
