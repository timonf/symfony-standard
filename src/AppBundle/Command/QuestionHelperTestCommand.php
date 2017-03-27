<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

/**
 * Some class to reproduce the given problem in #21789
 * @see https://github.com/symfony/symfony/issues/21789
 */
class QuestionHelperTestCommand extends Command
{
    protected function configure()
    {
        $this->setName('app:test');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $exampleVersions = [
            '3.0.0',
            '2.2.0',
            '2.1.3',
        ];

        $exampleTowns = [
            'a' => 'berlin',
            'b' => 'copenhagen',
            'c' => 'amsterdam',
        ];

        $output->writeln('<info>Choice Questions</info>');
        $output->writeln(sprintf('Your value is "%s".', $this->askChoices($exampleVersions, $input, $output)));
        $output->writeln(sprintf('Your value is "%s".', $this->askChoices($exampleTowns, $input, $output)));
    }

    protected function askChoices($choices, $input, $output)
    {
        $dialog = new QuestionHelper();
        $helperSet = new HelperSet(array(new FormatterHelper()));
        $dialog->setHelperSet($helperSet);

        $question = new ChoiceQuestion('Please select!', $choices);

        return $dialog->ask($input, $output, $question);
    }
}
