<?php

namespace Pitchart\GeorgeAbilbot\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Info extends Command
{
    protected function configure()
    {
        $this->setName('info')->setDescription('Displays information about application');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(<<<'EOF'
<info>  __  __                 _            _                               _        _
 |  \/  |               | |          | |                             | |      | |
 | \  / | ___  _ __   __| | ___    __| | ___   _ __ ___   ___ _ __ __| | ___  | |
 | |\/| |/ _ \| '_ \ / _` |/ _ \  / _` |/ _ \ | '_ ` _ \ / _ \ '__/ _` |/ _ \ | |
 | |  | | (_) | | | | (_| |  __/ | (_| |  __/ | | | | | |  __/ | | (_| |  __/ |_|
 |_|  |_|\___/|_| |_|\__,_|\___|  \__,_|\___| |_| |_| |_|\___|_|  \__,_|\___| (_)
</info>
EOF

        );

        $this->getApplication()->find('list')->run($input, $output);
    }


}