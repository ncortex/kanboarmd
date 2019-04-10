<?php

namespace Kanboard\Plugin\Datefilters;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\Datefilters\Filter\TaskDueDateRangeFilter;

class Plugin extends Base
{
    public function initialize()
    {
        //$this->template->hook->attach('template:project-header:filters_select', 'Datefilters:project_header/dateFiltersButton');
        $this->template->setTemplateOverride('project_header/search', 'Datefilters:project_header/newSearch');

        $this->container->extend('taskLexer', function($taskLexer) {
            $taskLexer->withFilter(TaskDueDateRangeFilter::getInstance());
            return $taskLexer;
        });

    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        return 'Datefilters';
    }

    public function getPluginDescription()
    {
        return t('Add filters by date range');
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

