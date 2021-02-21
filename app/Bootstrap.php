<?php

declare(strict_types=1);

namespace App;

use Nette\Configurator;


class Bootstrap
{
    public static function boot(): Configurator
    {
        $configurator = new Configurator;

        if (getenv('NETTE_DEVEL') === '1') {
            $configurator->setDebugMode(true);
        }

        $configurator->enableTracy(__DIR__ . '/../var/log');

        setlocale(LC_ALL, 'cs_CZ.utf8');
        $configurator->setTimeZone('Europe/Prague');
        $configurator->setTempDirectory(__DIR__ . '/../var/temp');

        $configurator->createRobotLoader()
            ->addDirectory(__DIR__)
            ->register();

        $configurator->addConfig(__DIR__ . '/Config/common.neon');
        $configurator->addConfig(__DIR__ . '/Config/local.neon');

        return $configurator;
    }
}
