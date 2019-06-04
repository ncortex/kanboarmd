<? if ($task['owner_id'] == $this->user->getId()): ?>
    <? echo($this->url->link('Move >>', 'FordchainController', 'nextChainStep', array('plugin' => 'Fordchain', 'task_id' => $task['id'], 'project_id' => $task['project_id']),false,"js-modal-medium","",false)); var_dump($task)?>
<? endif ?>