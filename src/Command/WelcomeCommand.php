<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Helper\ProgressBar;



#[AsCommand(
    name: 'app:welcome',
    description: 'Sends a welcome message to the user.',
)]
class WelcomeCommand extends Command
{
    protected function configure()
    {
        $this
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'The name of the user.'
            )
            ->addOption(
                'greeting',
                'g',
                InputOption::VALUE_OPTIONAL,
                'Custom greeting message',
                'Hello'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = $input->getArgument('name');
        $greeting = $input->getOption('greeting');

        if (!$name) {
            $name = $io->ask('Please enter your name');
        }

        

        $progressBar = new ProgressBar($output);
        $progressBar->start();
        sleep(1);
        $progressBar->setProgress(50);
        sleep(1);
        $progressBar->setProgress(100);
        $progressBar->finish();

        $output->writeln("$greeting, $name!");


        return Command::SUCCESS;
    }
}
