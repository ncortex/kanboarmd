<?php

namespace Kanboard\Plugin\TitleCompose;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Model\TaskModel;
use Kanboard\Plugin\Fordchain\Action\InitFordchain;
use Kanboard\Plugin\Fordchain\Action\NextFordchainStep;
use Kanboard\Plugin\TitleCompose\Controller\TitleComposeController;
use Kanboard\Plugin\TitleCompose\Action\composeTitle;


class Plugin extends Base
{
    public function initialize()
    {
        //Event
        $this->actionManager->register(new composeTitle($this->container));

        //Task
        $this->template->hook->attach('template:task:form:first-column', 'TitleCompose:task/new_fields');
        $this->template->hook->attach('template:config:sidebar', 'TitleCompose:config/sidebar');


        //Helper
        $this->helper->register('titleComposeHelper', '\Kanboard\Plugin\TitleCompose\Helper\TitleComposeHelper');

        //Routes
        $this->route->addRoute('ajax/products/:client_id', 'TitleComposeController', 'ajaxProductHandler', 'TitleCompose');
        $this->route->addRoute('ajax/subproducts/:product_id', 'TitleComposeController', 'ajaxSubproductHandler', 'TitleCompose');
        $this->route->addRoute('ajax/all', 'TitleComposeController', 'ajaxJsonHandler', 'TitleCompose');



        $this->setContentSecurityPolicy(array('script-src' => "'unsafe-inline' https://kanboard-4.herokuapp.com/"));

        //javascript
        $this->hook->on('template:layout:js', array('template' => 'plugins/TitleCompose/Assets/js/dependent-select.js'));

    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        return 'TitleCompose';
    }

    public function getPluginDescription()
    {
        return t('Title Compose');
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

