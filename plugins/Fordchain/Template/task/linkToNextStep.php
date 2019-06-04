<? if ($task['owner_id'] == $this->user->getId() && $task['column_id'] == 7): ?>
    <? echo($this->url->link('<button class="btn btn-red" style="float: right;">&gtClose&lt</button>', 'FordchainController', 'nextChainStep', array('plugin' => 'Fordchain', 'task_id' => $task['id'], 'project_id' => $task['project_id']),false,"js-modal-medium","",false));?>
<? elseif ($task['owner_id'] == $this->user->getId() && $task['column_id'] != 5): ?>
    <? echo($this->url->link('<button class="btn btn-green" style="float: right;">Move &gt&gt</button>', 'FordchainController', 'nextChainStep', array('plugin' => 'Fordchain', 'task_id' => $task['id'], 'project_id' => $task['project_id']),false,"js-modal-medium","",false));?>
<? endif ?>