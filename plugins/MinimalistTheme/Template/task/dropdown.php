<div class="dropdown">
    <a href="#" class="dropdown-menu dropdown-menu-link-icon"><strong>#<?= $task['id'] ?> <i class="fa fa-caret-down"></i></strong></a>
    <ul>
        <?php if ($this->projectRole->canUpdateTask($task)): ?>
            <li>
                <?= $this->modal->large('edit', t('Edit the task'), 'TaskModificationController', 'edit', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
            </li>
        <?php endif ?>
        <li>
            <?= $this->modal->medium('external-link', t('Add external link'), 'TaskExternalLinkController', 'find', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
        </li>
        <?php if ($this->projectRole->canRemoveTask($task)): ?>
            <li>
                <?= $this->modal->confirm('trash-o', t('Remove'), 'TaskSuppressionController', 'confirm', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
            </li>
        <?php endif ?>
        <?php if (isset($task['is_active']) && $this->projectRole->canChangeTaskStatusInColumn($task['project_id'], $task['column_id'])): ?>
        <li>
            <?php if ($task['is_active'] == 1): ?>
                <?= $this->modal->confirm('times', t('Close this task'), 'TaskStatusController', 'close', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
            <?php else: ?>
                <?= $this->modal->confirm('check-square-o', t('Open this task'), 'TaskStatusController', 'open', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
            <?php endif ?>
        </li>
        <?php endif ?>

        <?= $this->hook->render('template:task:dropdown', array('task' => $task)) ?>
    </ul>
</div>
