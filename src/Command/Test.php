<?php

namespace Pitchart\GeorgeAbilbot\Command;

use Pitchart\GeorgeAbilbot\Service\Twitter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Test extends Command implements ContainerAwareInterface
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
        $this->setName('test')
            ->setDescription('Tests Twitter communication')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Twitter $twitter */
        $twitter = $this->container->get('twitter');
        $messages = array(
            'Aah… Monde de merde.', 'Excuse-moi de te dire ça, mon pauvre José, mais tu confonds un peu tout. Tu fais un amalgame entre la coquetterie et la classe. Tu es fou.',
            'Si tu veux mon opinion, ça fait un peu… has been.', 'Si tu veux me parler, envoie-moi un... fax !', 'C’est ça, la puissance intellectuelle. Bac + 2, les enfants.',
            'Hop hop hop ! Et notre répétition de scie musicale ?', 'En tout cas s’il cherchait pour du trouble, il est venu à la bonne place.'
        );
        $message = $messages[rand(0, count($messages)-1)];
        var_dump($twitter->publish($message));
    }

}