<?php declare(strict_types=1);

namespace App\Router;

use Nette\Application\Routers\RouteList;
use Nette\StaticClass;

final class RouterFactory
{
    use StaticClass;

    public static function createRouter(): RouteList
    {
        $router = new RouteList;

        $router->addRoute('budovy/porovnat', 'BuildingCompare:default');
        $router->addRoute('budovy/porovnat/<compareBy>', 'BuildingCompare:compare');
        $router->addRoute('<presenter>[/<action>[/<id>]]', 'Homepage:default');

        return $router;
    }
}
