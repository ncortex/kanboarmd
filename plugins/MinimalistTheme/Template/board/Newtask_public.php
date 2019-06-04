<div data-task-id="<?= $task['id'] ?>" class="task-board color-<?= $task['color_id'] ?> <?= $task['date_modification'] > time() - $board_highlight_period ? 'task-board-recent' : '' ?>">
    <div class="task-board-header">
        <?= $this->url->link('#'.$task['id'], 'TaskViewController', 'readonly', array('task_id' => $task['id'], 'token' => $project['token'])) ?>


        <?php if (! empty($task['traductor'])): ?>
            <span class="task-board-assignee">
                <?= $this->text->e($task['traductor']) ?>
            </span>
        <?php endif ?>

        <?php if (! empty($task['revisor'])): ?>
            <span class="task-board-assignee">
                <?= $this->text->e($task['revisor']) ?>
            </span>
        <?php endif ?>


        <?= $this->render('board/task_avatar', array('task' => $task)) ?>
    </div>

    <?= $this->hook->render('template:board:public:task:before-title', array('task' => $task)) ?>
    <div class="task-board-title">
        <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'readonly', array('task_id' => $task['id'], 'token' => $project['token'])) ?>
    </div>
    <?= $this->hook->render('template:board:public:task:after-title', array('task' => $task)) ?>
num palabras
    <?= $this->render('board/task_footer', array(
        'task' => $task,
        'not_editable' => $not_editable,
        'project' => $project,
    )) ?>
</div>
