<?php

namespace Kanboard\Plugin\Fordchain\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Core\Event\EventManager;
use Kanboard\Event\GenericEvent;
use Kanboard\Event\TaskEvent;
use Kanboard\EventBuilder\TaskEventBuilder;
use Kanboard\Model\TaskModel;

class FordchainController extends BaseController
{
    public function project()
    {
        $project = $this->getProject() ;

        $users = $this->userModel->getActiveUsersList(false);

        $this->response->html($this->helper->layout->project('Fordchain:project/configure', ['title' => t('Fordchain'),
            'project'                                                                   => $project,
            'users'                                                                     => $users, ]));
    }

    public function nextChainStep(){
        // lanzar evento
        $task = $this->getTask();
        $user = $this->getUser();

        $event = TaskEventBuilder::getInstance($this->container)
            ->withTaskId($task['id'])
            ->withValues(['user_finishing' => $user['id']])
            ->buildEvent();

        $event = $this->dispatcher->dispatch('task.chainstepfinished', $event);
        $this->response-> html("Ok",203);
    }

    public function nextChainStepConfirm()
    {
        $task = $this->getTask();
        $user = $this->getUser();
        $key = $this->request->getStringParam('key');
        $this->response->html($this->template->render('metaMagik:config/remove', [
            'key'     => $key,
        ]));
    }

}