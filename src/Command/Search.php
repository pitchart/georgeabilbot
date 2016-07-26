<?php
/**
 * Created by PhpStorm.
 * User: jvitte
 * Date: 26/07/16
 * Time: 13:35
 */

namespace Pitchart\GeorgeAbilbot\Command;


use Pitchart\GeorgeAbilbot\Service\Twitter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Search extends Command implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    protected function configure()
    {
        $this->setName('search')
            ->setDescription('Search Twitter')
            ->addArgument('query', InputArgument::REQUIRED, 'The search query.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Twitter $twitter */
        $twitter = $this->container->get('twitter');
        $query = $input->getArgument('query');

        $results = $twitter->search($query);
        if ($results) {
            foreach ($results->statuses as $tweet) {
                $output->writeln(sprintf('<info>%s</info> => <comment>@%s</comment> : %s', $tweet->id_str, $tweet->user->screen_name, $tweet->text));
            }
        }
    }

}
{

}