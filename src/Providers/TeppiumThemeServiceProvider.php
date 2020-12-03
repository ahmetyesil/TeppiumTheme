<?php

namespace TeppiumTheme\Providers;

use IO\Extensions\Functions\Partial;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;
use IO\Helper\ComponentContainer;
use IO\Helper\TemplateContainer;
use IO\Helper\ResourceContainer;
use IO\Services\ItemSearch\Helper\ResultFieldTemplate;

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

        $dispatcher->listen('IO.Resources.Import', function (ResourceContainer $container)
        {
            $container->addScriptTemplate('TeppiumTheme::ThemeScript');
        }, self::PRIORITY);

        /* Footer überschreiben  */
        $dispatcher->listen('IO.init.templates', function(Partial $partial)
        {
            $partial->set('footer', 'TeppiumTheme::ThemeFooter');
            $partial->set( 'page-design', 'TeppiumTheme::PageDesign.PageDesign' );
        }, 0);

    }
}