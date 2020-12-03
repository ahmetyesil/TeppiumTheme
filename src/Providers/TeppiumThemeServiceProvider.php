<?php

namespace TeppiumTheme\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Events\Dispatcher;
use IO\Helper\TemplateContainer;

/**
 * Class TeppiumThemeServiceProvider
 * @package TeppiumTheme\Providers
 */
class TeppiumThemeServiceProvider extends ServiceProvider
{
    const PRIORITY = 0;

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
    }
}