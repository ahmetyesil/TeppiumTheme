<?php

namespace TeppiumTheme\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Events\Dispatcher;
use IO\Helper\TemplateContainer;
use IO\Helper\ResourceContainer;

/**
 * Class TeppiumThemeServiceProvider
 * @package TeppiumTheme\Providers
 */
class TeppiumThemeServiceProvider extends ServiceProvider
{
    const PRIORITY = 99;

    public function register()
    {
        
    }

    public function boot(Dispatcher $dispatcher)
    {
       	// Override template
        $dispatcher->listen('IO.tpl.home', function (TemplateContainer $container) {
            $container->setTemplate('TeppiumTheme::Homepage.Homepage');
            return false;
        }, self::PRIORITY);

        $dispatcher->listen('IO.Resources.Import', function (ResourceContainer $resourceContainer)
        {
            // The script is imported in the Footer.twig of Ceres
            $resourceContainer->addStyleTemplate('TeppiumTheme::Theme');
        }, self::PRIORITY);

    }
}