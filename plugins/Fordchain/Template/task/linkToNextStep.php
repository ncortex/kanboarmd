<? if ($task['owner_id'] == $this->user->getId() && $task['column_id'] == 8): ?>
    <? echo($this->url->link('<button class="btn btn-red" style="float: right;">&gtClose&lt</button>', 'FordchainController', 'nextChainStep', array('plugin' => 'Fordchain', 'task_id' => $task['id'], 'project_id' => $task['project_id']),false,"js-modal-medium","",false));?>
<? elseif ($task['owner_id'] == $this->user->getId() && $task['column_id'] != 5 && $task['column_id'] != 9): ?>
    <?= $this->modal->small('move','<div class="btn btn-red" style="float: right;">Move&gt&gt</div>', 'FordchainController', 'nextChainStepConfirm', array('plugin' => 'Fordchain', 'task_id' => $task['id'], 'project_id' => $task['project_id']),false,"popover");?>
<? endif ?>

