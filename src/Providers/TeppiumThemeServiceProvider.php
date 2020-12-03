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

    public function boot(Twig $twig, Dispatcher $dispatcher)
    {

        /* Skripte einbinden  */
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

        /* SingleItem überschreiben */
        $dispatcher->listen('IO.Component.Import', function (ComponentContainer $container)
        {
            if ($container->getOriginComponentTemplate()=='Ceres::Item.Components.SingleItem')
            {
                $container->setNewComponentTemplate('TeppiumTheme::Item.Components.SingleItem');
            }
        }, self::PRIORITY);

        /* ResultFields SingleItemWrapper überschreiben  */
        $dispatcher->listen( 'IO.ResultFields.*', function(ResultFieldTemplate $templateContainer) {
            $templateContainer->setTemplates([
                ResultFieldTemplate::TEMPLATE_SINGLE_ITEM => 'TeppiumTheme::ResultFields.SingleItemWrapper'
            ]);
        }, 0);

        /* ListItem JSON überschreiben */
        $dispatcher->listen( 'IO.ResultFields.*', function(ResultFieldTemplate $templateContainer) {
            $templateContainer->setTemplates([
                ResultFieldTemplate::TEMPLATE_LIST_ITEM => 'TeppiumTheme::ResultFields.ListItem'
            ]);
        }, 0);

        /* Überschreiben der ItemImageCarousel */
        $dispatcher->listen('IO.Component.Import', function(ComponentContainer $container){
            if( $container->getOriginComponentTemplate() == 'Ceres::Item.Components.ItemImageCarousel')
            {
                $container->setNewComponentTemplate('TeppiumTheme::Item.ItemImageCarousel');
            }
        }, self::PRIORITY);

        /* Überschreiben der ContactForm.twig */
        $dispatcher->listen('IO.Component.Import', function(ComponentContainer $container){
            if( $container->getOriginComponentTemplate() == 'Ceres::Customer.Components.Contact.ContactForm')
            {
                $container->setNewComponentTemplate('TeppiumTheme::Customer.Components.Contact.ContactForm');
            }
        }, self::PRIORITY);

        /* Überschreiben der ShippingProfileSelect */
        $dispatcher->listen('IO.Component.Import', function(ComponentContainer $container){
            if( $container->getOriginComponentTemplate() == 'Ceres::Checkout.Components.ShippingProfileSelect')
            {
                $container->setNewComponentTemplate('TeppiumTheme::Checkout.Components.ShippingProfileSelect');
            }
        }, self::PRIORITY);

        /* Überschreiben der Summen im Checkout - Checkout Totals einmal anpassen und überall anfragen! */
        $dispatcher->listen('IO.Component.Import', function(ComponentContainer $container){
            if( $container->getOriginComponentTemplate() == 'Ceres::Basket.Components.BasketTotals')
            {
                $container->setNewComponentTemplate('TeppiumTheme::Basket.Components.BasketTotals');
            }
        }, self::PRIORITY);

        /* KategorieAnsicht bei Auswahl der Navigation überschreiben  */
        $dispatcher->listen('IO.Component.Import', function(ComponentContainer $container){
            if( $container->getOriginComponentTemplate() == 'Ceres::ItemList.Components.CategoryItem')
            {
                $container->setNewComponentTemplate('TeppiumTheme::ItemList.Components.CategoryItem');
            }
        }, self::PRIORITY);

        /* Überschreiben der CategoryItem  */
        $dispatcher->listen('IO.tpl.category.item', function(TemplateContainer $container){

            $container->setTemplate('TeppiumTheme::Category.Item.CategoryItem');

        }, self::PRIORITY);

        /* Überschreiben der Bestätigungsseite */
        $dispatcher->listen('IO.tpl.confirmation', function (TemplateContainer $container)
        {
            $container->setTemplate('TeppiumTheme::Checkout.OrderConfirmation');

        }, self::PRIORITY);

        /* Überschreiben der SingleItemWrapper - Somit lässt sich das SingleItemView überschreiben und auch die Komponente VariationSelect */
        $dispatcher->listen('IO.tpl.item', function(TemplateContainer $container)
        {
            $container->setTemplate('TeppiumTheme::Item.SingleItemWrapper');
            return false;
        }, self::PRIORITY);

        /* Überschreiben der Variationen */
        $dispatcher->listen('IO.Component.Import', function(ComponentContainer $container){
            if( $container->getOriginComponentTemplate() == 'Ceres::Item.Components.VariationSelect')
            {
                $container->setNewComponentTemplate('TeppiumTheme::Item.Components.VariationSelect');
            }
        }, self::PRIORITY);


        /* Überschreiben der Login Seite */
        $dispatcher->listen('IO.Component.Import', function(ComponentContainer $container){
            if( $container->getOriginComponentTemplate() == 'Ceres::Customer.Components.LoginView')
            {
                $container->setNewComponentTemplate('TeppiumTheme::Customer.Components.LoginView');
            }
        }, self::PRIORITY);

        /* Überschreiben der Login Seite - GuestView */
        $dispatcher->listen('IO.Component.Import', function(ComponentContainer $container){
            if( $container->getOriginComponentTemplate() == 'Ceres::Customer.Components.GuestLogin')
            {
                $container->setNewComponentTemplate('TeppiumTheme::Customer.Components.GuestLogin');
            }
        }, self::PRIORITY);

    }
}