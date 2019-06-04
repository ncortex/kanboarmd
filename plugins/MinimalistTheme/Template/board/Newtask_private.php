<? $metadata = $this->task->taskMetadataModel->getAll($task['id']);  ?>
<div class="
        task-board
        <?= $task['is_draggable'] ? 'draggable-item ' : '' ?>
        <?= $task['is_active'] == 1 ? 'task-board-status-open '.($task['date_modification'] > (time() - $board_highlight_period) ? 'task-board-recent' : '') : 'task-board-status-closed' ?>
        color-<?= $task['color_id'] ?>"
     data-task-id="<?= $task['id'] ?>"
     data-column-id="<?= $task['column_id'] ?>"
     data-swimlane-id="<?= $task['swimlane_id'] ?>"
     data-position="<?= $task['position'] ?>"
     data-owner-id="<?= $task['owner_id'] ?>"
     data-category-id="<?= $task['category_id'] ?>"
     data-due-date="<?= $task['date_due'] ?>"
     data-task-url="<?= $this->url->href('TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>">

    <div class="task-board-sort-handle" style="display: none;"><i class="fa fa-arrows-alt"></i></div>

    <?php if ($this->board->isCollapsed($task['project_id'])): ?>
        <div class="task-board-collapsed">
            <div class="task-board-saving-icon" style="display: none;"><i class="fa fa-spinner fa-pulse"></i></div>
            <strong><?= '#'.$task['id'] ?></strong>
            <?php if (! empty($task['assignee_username'])): ?>
                <span title="<?= $this->text->e($task['assignee_name'] ?: $task['assignee_username']) ?>">
                    <?= $this->text->e($this->user->getInitials($task['assignee_name'] ?: $task['assignee_username'])) ?>
                </span> -
            <?php endif ?>
            <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id']), false, '', $this->text->e($task['title'])) ?>
        </div>
    <?php else: ?>
        <div class="task-board-expanded">
            <div class="task-board-saving-icon" style="display: none;"><i class="fa fa-spinner fa-pulse fa-2x"></i></div>
            <div class="task-board-header">
                <?= $this->render('task/dropdown', array('task' => $task, 'redirect' => 'board')) ?>

                <?php if (! empty($task['owner_id'])): ?>
                    <span class="task-board-assignee">
                        <?= $this->text->e($task['assignee_name'] ?: $task['assignee_username']) ?>
                    </span>
                <?php endif ?>

                <?= $this->render('board/task_avatar', array('task' => $task)) ?>
            </div>

            <?= $this->hook->render('template:board:private:task:before-title', array('task' => $task)) ?>
            <div class="task-board-title">
                <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
            </div>
            <?php if (! empty($task['date_due'])): ?>
                <div class="task-board-icons-row">
                    <span class="task-date
                    <?php if (time() > $task['date_due']): ?>
                         task-date-overdue
                    <?php elseif (date('G',$task['date_due']) >= 8 && date('G',$task['date_due']) <=17): ?>
                         task-date-today
                    <?php endif ?>
                    ">
                    <i class="fa fa-calendar"></i>
                        <?= $this->dt->datetime($task['date_due']) ?>
                    </span>
                </div>
            <?php endif ?>

            <?php var_dump($task); if (!empty($task['description'])): ?>
                <div class="task-board-icons-row">
                    <span class="task-words">
                        <? echo($task['description']) ?>
                    </span>
                </div>
            <?php endif ?>
            <?= $this->hook->render('template:board:private:task:after-title', array('task' => $task)) ?>
            <?php if (! empty($task['Fuzzy'])): ?>
                <div class="task-board-icons-row">
                    <span class="task-date
                    <?php if (time() > $task['date_due']): ?>
                         task-date-overdue
                    <?php elseif (date('G',$task['date_due']) >= 8 && date('G',$task['date_due']) <=17): ?>
                         task-date-today
                    <?php endif ?>
                    ">
                    <i class="fa fa-calendar"></i>
                        <?= $this->dt->datetime($task['date_due']) ?>
                    </span>
                </div>
            <?php endif ?>
            <?= $this->render('board/task_footer', array(
                'task' => $task,
                'not_editable' => $not_editable,
                'project' => $project,
            )) ?>
            <?
            echo $metadata['translator_name'] . ' - ' . $metadata['reviewer_name'];
            ?>
        </div>
    <?php endif ?>
</div>
