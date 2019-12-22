<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CsvImportCommand extends Command
{
    protected static $defaultName = 'app:csv-import';

    protected function configure()
    {
        $this
            ->setDescription('CSV import')
            ->addArgument('test', InputArgument::OPTIONAL, 'Test mode')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $test = $input->getArgument('test');

        if ($test) {
            $io->note(sprintf('You passed an argument: %s', $test));
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return 0;
    }
}
