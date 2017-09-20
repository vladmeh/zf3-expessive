<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace App\Command;


use Doctrine\ORM\EntityManager;
use Monolog\Logger;

use Symfony\Bridge\Monolog\Handler\ConsoleHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class HelloWorldCommand extends Command
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager, $name = null)
    {
        $this->entityManager = $entityManager;
        parent::__construct($name);
    }

    /**
     * Configures the command
     */
    protected function configure()
    {
        $this->setName('hello')
            ->setDescription('Says hello');
    }

    /**
     * Executes the current command
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Hello World!");

        // Do something with the entityManager
        $this->entityManager->find('Blog\Entity\BlogEntity');

        /*$logger = new Logger('collect-product-data');
        $logger->pushHandler(new ConsoleHandler($output));
        $logger->debug('Log something');*/
    }

}