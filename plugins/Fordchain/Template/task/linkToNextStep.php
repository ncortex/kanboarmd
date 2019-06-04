<? if ($task['owner_id'] == $this->user->getId()): ?>
    <? echo($this->url->link('<button class="btn btn-green">Move &gt&gt</button>', 'FordchainController', 'nextChainStep', array('plugin' => 'Fordchain', 'task_id' => $task['id'], 'project_id' => $task['project_id']),false,"js-modal-medium","",false));?>
<? endif ?>