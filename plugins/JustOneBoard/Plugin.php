<?php

namespace Kanboard\Plugin\JustOneBoard;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\JustOneBoard\Controller\DashboardController;

class Plugin extends Base
{
    public function initialize()
    {
        $this->template->setTemplateOverride('header/board_selector','JustOneBoard:header/Noboard_selector');
        $this->template->setTemplateOverride('header','JustOneBoard:header');
        $this->template->setTemplateOverride('header/title','JustOneBoard:header/title');
        $this->template->setTemplateOverride('header/user_dropdown','JustOneBoard:header/user_dropdown');
        $this->template->setTemplateOverride('proyect_header/dropdown','JustOneBoard:proyect_header/dropdown');
        $this->template->setTemplateOverride('dashboard/layout','JustOneBoard:dashboard/layout');

        $this->hook->on('template:layout:js', array('template' => 'plugins/JustOneBoard/Assets/redirect.js'));

        $this->container['BoardViewController'] = $this->container->factory(function ($c) {
            return new DashboardController($c);
        });

    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        return 'Just One Board';
    }

    public function getPluginDescription()
    {
        return t('My plugin is awesome');
    }

    public function getPluginAuthor()
    {
        return 'Jose Linares';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/kanboard/plugin-myplugin';
    }
}

