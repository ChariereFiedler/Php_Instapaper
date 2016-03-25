<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BuildLinkCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:build_links')
            ->setDescription('Build all links not yet processed');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $repository = $em->getRepository("AppBundle:Link");
        $builder = $this->getContainer()->get('link_builder');
        $links = $repository->findAll();

        $builder->buildAll($links);

        foreach($links as $link) {
            $output->writeln("Link updated : " . $link->getTitle());
            $em->persist($link);
        }
        $em->flush();



    }
}
