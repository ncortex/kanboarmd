<?php

namespace Kanboard\Plugin\Fordchain\Action;

use Kanboard\Action\Base;
use Kanboard\EventBuilder\TaskEventBuilder;
use Kanboard\Model\TaskModel;

class InitFordchain extends Base
{
    /**
     * Get automatic action description
     *
     * @access public
     * @return string
     */
    public function getDescription()
    {
        return t('Inicializar Cadena');
    }

    /**
     * Get the list of compatible events
     *
     * @access public
     * @return array
     */
    public function getCompatibleEvents()
    {
        return array(
            TaskModel::EVENT_CREATE_UPDATE ,
        );
    }

    /**
     * Get the required parameter for the action (defined by the user)
     *
     * @access public
     * @return array
     */
    public function getActionRequiredParameters()
    {
        return array(
            'src_column_id' => t('Source column'),
            'dest_column_id' => t('Destination column'),


        );
    }

    /**
     * Get the required parameter for the event
     *
     * @access public
     * @return string[]
     */
    public function getEventRequiredParameters()
    {
        return array(
            'task_id',
            'task' => array(
                'column_id',
            ),
        );
    }

    /**
     * Execute the action
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool            True if the action was executed or false when not executed
     */
    public function doAction(array $data)
    {
        $values = array(
            'id' => $data['task']['id'],
            'column_id' => intval($this->getParam("dest_column_id")),
            'owner_id' => $data['task']['gestor_id'],
            'fordchainStep' => 1,
        );

        $this->taskMetadataModel->save($data['task']['id'], ["gestor_name" => $this->helper->user->getFullname($this->userModel->getById($data['task']['gestor_id']))]);
        $res = $this->taskModificationModel->update($values, true);

        // Si ya se han establecido el rtraductor y el revisor, pasar al siguiente paso automaticamnete
        if($data['task']['translator_id'] != 0 && $data['task']['reviewer_id'] != 0){
            $event = TaskEventBuilder::getInstance($this->container)
                ->withTaskId($data['task']['id'])
                ->withValues(['user_finishing' => $data['task']['gestor_id']])
                ->buildEvent();
            $this->dispatcher->dispatch('task.chainstepfinished', $event);
        }
        return $res;
    }

    /**
     * Check if the event data meet the action condition
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool
     */
    public function hasRequiredCondition(array $data)
    {
        //var_dump($data);die();        //var_dump($metadata);die();
        return $data['task']['column_id'] == intval($this->getParam('src_column_id')) && $data['task']['owner_id'] == 0 && !empty($data['task']['gestor_id']);
        // $data['task']['column_id'] == intval($this->getParam('src_column_id')) &&
    }
}
