<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Laravel\Set\LaravelSetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $dir = getcwd();

    $parameters = $containerConfigurator->parameters();
    $services   = $containerConfigurator->services();

    $parameters->set(Option::BOOTSTRAP_FILES, [
        $dir.'/rector-bootstrap.php',
    ]);

    $parameters->set(Option::PATHS, [
        $dir.'/app',
    ]);

    $parameters->set(Option::SKIP, [
        $dir.'/app/Http/Livewire',
    ]);

    if (file_exists($neon = $dir.'/phpstan.neon')) {
        $parameters->set(Option::PHPSTAN_FOR_RECTOR_PATH, $neon);
    }

    $parameters->set(Option::AUTO_IMPORT_NAMES, true);
    $parameters->set(Option::IMPORT_SHORT_CLASSES, true);
    $parameters->set(Option::IMPORT_DOC_BLOCKS, false);

    $containerConfigurator->import(LevelSetList::UP_TO_PHP_81);

    $containerConfigurator->import(SetList::PRIVATIZATION);
    $services->remove(\Rector\Privatization\Rector\Class_\RepeatedLiteralToClassConstantRector::class);
    $services->remove(\Rector\Privatization\Rector\Property\ChangeReadOnlyPropertyWithDefaultValueToConstantRector::class);
    $services->remove(\Rector\Privatization\Rector\Class_\ChangeReadOnlyVariableWithDefaultValueToConstantRector::class);

    $containerConfigurator->import(SetList::EARLY_RETURN);

    $containerConfigurator->import(SetList::CODING_STYLE);
    $services->remove(\Rector\CodingStyle\Rector\ClassConst\VarConstantCommentRector::class);
    $services->remove(\Rector\CodingStyle\Rector\ClassMethod\UnSpreadOperatorRector::class);
    $services->remove(\Rector\CodingStyle\Rector\Encapsed\WrapEncapsedVariableInCurlyBracesRector::class);
    $services->remove(\Rector\CodingStyle\Rector\FuncCall\ConsistentPregDelimiterRector::class);

    $containerConfigurator->import(LaravelSetList::LARAVEL_80);
    $containerConfigurator->import(LaravelSetList::LARAVEL_CODE_QUALITY);
    $containerConfigurator->import(LaravelSetList::LARAVEL_ARRAY_STR_FUNCTION_TO_STATIC_CALL);
};
