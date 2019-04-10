<?php

namespace Kanboard\Plugin\Fordchain\Action;

use Kanboard\Action\Base;
use Kanboard\Event\TaskEvent;
use Kanboard\Model\TaskModel;

class NextFordchainStep extends Base
{
    /**
     * Get automatic action description
     *
     * @access public
     * @return string
     */
    public function getDescription()
    {
        return t('Mover al siguiente paso');
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
            'task.chainstepfinished',
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
            'dest_column_id' => t('Destination column')
            //'category_id' => t('Category'),
            //'color_id' => t('Color'),
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
        $nuevo_owner = $data['task']['owner_id'] ;
        if($data['task']['fordchainStep'] == 1){
            $nuevo_owner = $data['task']['translator_id'] ;
        }
        if($data['task']['fordchainStep'] == 2){
            $nuevo_owner = $data['task']['reviewer_id'] ;
        }
        if($data['task']['fordchainStep'] == 3){
            $nuevo_owner = $data['task']['gestor_id'] ;
        }

        $values = array(
            'id' => $data['task']['id'],
            'column_id' => intval($this->getParam('dest_column_id')),
            'owner_id' => $nuevo_owner,
            'fordchainStep' => $data['task']['fordchainStep']+1,
        );


        $new_metadata = array_merge([
            "translator_name" => $this->helper->user->getFullname($this->userModel->getById($data['task']['translator_id'])),
            "reviewer_name" => $this->helper->user->getFullname($this->userModel->getById($data['task']['reviewer_id'])),
            "gestor_name" => $this->helper->user->getFullname($this->userModel->getById($data['task']['gestor_id'])),
        ],$this->taskMetadataModel->getAll($data['task']['id']));
        $this->taskMetadataModel->save($data['task']['id'], $new_metadata);


        return $this->taskModificationModel->update($values, true);
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
        return $data['task']['column_id'] == intval($this->getParam('src_column_id')) && $data['task']['translator_id'] != 0 && $data['task']['reviewer_id'] != 0 ;
    }
}
