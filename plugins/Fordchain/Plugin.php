<?php

namespace Kanboard\Plugin\Fordchain;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Model\TaskModel;
use Kanboard\Plugin\Fordchain\Action\InitFordchain;
use Kanboard\Plugin\Fordchain\Action\NextFordchainStep;
use Kanboard\Plugin\Fordchain\Controller\FordchainController;


class Plugin extends Base
{
    public function initialize()
    {
        //Helper
        //$this->helper->register('fordchainHelper', '\Kanboard\Plugin\Fordchain\Helper\FordchainHelper');

        $this->container['FordchainController'] = $this->container->factory(function ($c) {
            return new FordchainController($c);
        });

        //Project
        $this->template->hook->attach('template:project:sidebar', 'Fordchain:project/sidebar');

        //Task
        //$this->template->hook->attach('template:task:form:third-column', 'Fordchain:task/renderFordAsigns');
        $this->template->setTemplateOverride('task_creation/show', 'Fordchain:task/taskCreation');
        $this->template->setTemplateOverride('task_modification/show', 'Fordchain:task/taskEdit');
        $this->template->setTemplateOverride('task_list/task_icons', 'Fordchain:task/tasklist_icons');
        $this->template->hook->attach('template:task:details:third-column', 'Fordchain:task/detailsThirdColumn');
        $this->template->hook->attach('template:board:private:task:after-title', 'Fordchain:task/linkToNextStep');

        //Event
        $this->actionManager->register(new InitFordchain($this->container));
        $this->actionManager->register(new NextFordchainStep($this->container));
        $this->actionManager->getAction('\Kanboard\Plugin\Fordchain\Action\NextFordchainStep')->addEvent('task.chainstepfinished', 'Task ready for next step in chain');

        //Routes
        $this->route->addRoute('fordchain/eventTaskNextStep/:task_id', 'FordchainController', 'nextChainStep', "Fordchain");
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        return 'FordChain';
    }

    public function getPluginDescription()
    {
        return t('Cadena de montaje');
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

