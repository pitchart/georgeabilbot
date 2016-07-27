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
use Symfony\Component\Console\Input\InputOption;
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
            ->addOption('count', 'c', InputOption::VALUE_OPTIONAL, 'The number of tweets to display', 20)
            ->addOption('lang', 'l', InputOption::VALUE_OPTIONAL, 'The language of tweets to search', null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Twitter $twitter */
        $twitter = $this->container->get('twitter');

        $results = $twitter->search($input->getArgument('query'), $input->getOption('count'), $input->getOption('lang'));
        if ($results) {
            foreach ($results->statuses as $tweet) {
                $created = \DateTime::createFromFormat('D M d H:i:s P Y', $tweet->created_at);
                $output->writeln(sprintf('<info>%s | %s</info> => <comment>@%s</comment> : %s', $created->format('d-m-Y H:i:s'), $tweet->id_str, $tweet->user->screen_name, $tweet->text));
            }
        }
    }

}