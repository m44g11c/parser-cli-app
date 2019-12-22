<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\Product;
use League\Csv\Reader;
use League\Csv\Statement;

class CsvImportCommand extends Command
{
  protected static $defaultName = 'app:csv-import';

  protected function configure()
  {
    $this
      ->setDescription('CSV import')
      ->addArgument('test', InputArgument::OPTIONAL, 'Test mode');
  }

  protected function execute(InputInterface $input, OutputInterface $output): int
  {
    $io = new SymfonyStyle($input, $output);
    $test = $input->getArgument('test');

    if ($test) {
      $io->note(sprintf('You passed an argument: %s', $test));
    }

    $reader = Reader::createFromPath('%kernel.root_dir%/../data/stock.csv');
    $reader->setHeaderOffset(0);
    $records = (new Statement())->process($reader);

    $io->title('Importing...');
    $io->progressStart(iterator_count($records));

    $kernel = $this->getApplication()->getKernel();
    $container = $kernel->getContainer();
    $em = $container->get('doctrine')->getManager();

    foreach ($records as $record) {

      $record['Cost in GBP']  = floatval($record['Cost in GBP']);
      $record['Stock']  = intval($record['Stock']);

      $product = new Product();
      $product->setProductCode($record['Product Code']);
      $product->setProductName($record['Product Name']);
      $product->setProductDescription($record['Product Description']);
      $product->setStock($record['Stock']);
      $product->setCostinGBP($record['Cost in GBP']);
      $product->setDiscontinued($record['Discontinued']);

      $em->persist($product);
      $em->flush();
    }

    $io->progressFinish();

    $io->success('Import complete.');

    return 0;
  }
}
