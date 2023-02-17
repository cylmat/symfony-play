<?php

namespace App\AppBundle\Command;

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Bundle\MakerBundle\Maker\MakeEntity as MakerMakeEntity;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

final class MakeEntityWrapper extends AbstractMaker
{
    public static function getCommandName(): string
    {
        return 'make:entity:2';
    }

    public static function getCommandDescription(): string
    {
        return 'Creates or updates a Doctrine entity class, and optionally an API Platform resource';
    }

    public function __construct(
        private readonly MakerMakeEntity $makeEntity
    ) {
    }

    public function configureCommand(Command $command, InputConfiguration $inputConf): void
    {
        $this->makeEntity->configureCommand($command, $inputConf);
    }

    public function configureDependencies(DependencyBuilder $dependencies, InputInterface $input = null): void
    {
        $this->makeEntity->configureDependencies($dependencies, $input);
    }

    /** @SuppressWarnings(PHPMD.ShortVariable) */
    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator): void
    {
        $this->makeEntity->generate($input, $io, $generator);
    }
}
