<?php

namespace Kanboard\Plugin\MinimalistTheme;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        $this->hook->on('template:layout:css', array('template' => 'plugins/MinimalistTheme/kanboardcss.css'));
        $this->template->setTemplateOverride('board/task_public','MinimalistTheme:board/Newtask_public');
        $this->template->setTemplateOverride('board/task_private','MinimalistTheme:board/Newtask_private');
        $this->template->setTemplateOverride('board/task_footer','MinimalistTheme:board/task_footer');
        $this->template->setTemplateOverride('board/table_column','MinimalistTheme:board/table_column');
        $this->template->setTemplateOverride('proyect_header/header','MinimalistTheme:proyect_header/header');
        $this->template->setTemplateOverride('task/details','MinimalistTheme:task/details');
        $this->template->setTemplateOverride('task/dropdown','MinimalistTheme:task/dropdown');
        $this->template->setTemplateOverride('task/sidebar','MinimalistTheme:task/sidebar');

        $this->template->hook->attach('template:project:header:after', 'MinimalistTheme:proyect_header/new_task');
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        return 'MinimalistTheme';
    }

    public function getPluginDescription()
    {
        return t('Tema');
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

