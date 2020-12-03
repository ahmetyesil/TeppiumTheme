<?php

namespace TeppiumTheme\Containers;

use Plenty\Plugin\Templates\Twig;

class TeppiumThemeContainer
{
    public function call(Twig $twig):string
    {
        return $twig->render('TeppiumTheme::Theme');
    }
}