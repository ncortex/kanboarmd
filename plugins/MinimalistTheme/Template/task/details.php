<section id="task-summary">
    <h2><?= $this->text->e($task['title']) ?></h2>

    <?= $this->hook->render('template:task:details:top', array('task' => $task)) ?>

    <?= $metadata = $this->task->taskMetadataModel->getAll($task['id']); ?>

    <div class="task-summary-container color-<?= $task['color_id'] ?>">
        <div class="task-summary-columns">
            <div class="task-summary-column">
                <ul class="no-bullet">
                    <li>
                        <strong><?= t('Status:') ?></strong>
                        <span>
                        <?php if ($task['is_active'] == 1): ?>
                            <?= t('open') ?>
                        <?php else: ?>
                            <?= t('closed') ?>
                        <?php endif ?>
                        </span>
                    </li>
                    <li>
                        <strong><?= t('Content:') ?></strong> <span><?= $task['category_name'] ?></span>
                    </li>
                    <?php if (! empty($task['reference'])): ?>
                        <li>
                            <strong><?= t('Reference:') ?></strong> <span><?= $this->task->renderReference($task) ?></span>
                        </li>
                    <?php endif ?>
                    <?php if ($project['is_public']): ?>
                        <li>
                            <small>
                                <?= $this->url->icon('external-link', t('Public link'), 'TaskViewController', 'readonly', array('task_id' => $task['id'], 'token' => $project['token']), false, '', '', true) ?>
                            </small>
                        </li>
                    <?php endif ?>
                    <?php if ($project['is_public'] && !$editable): ?>
                        <li>
                            <small>
                                <?= $this->url->icon('th', t('Back to the board'), 'BoardViewController', 'readonly', array('token' => $project['token'])) ?>
                            </small>
                        </li>
                    <?php endif ?>

                    <?= $this->hook->render('template:task:details:first-column', array('task' => $task)) ?>
                </ul>
            </div>
            <div class="task-summary-column">
                <ul class="no-bullet">
                    <?php if (! empty($task['category_name'])): ?>
                        <li>
                            <strong><?= t('Category:') ?></strong>
                            <span><?= $this->text->e($task['category_name']) ?></span>
                        </li>
                    <?php endif ?>
                    <li>
                        <strong><?= t('Column:') ?></strong>
                        <span><?= $this->text->e($task['column_title']) ?></span>
                    </li>

                    <?= $this->hook->render('template:task:details:second-column', array('task' => $task)) ?>
                </ul>
            </div>
            <div class="task-summary-column">
                <ul class="no-bullet">
                    <?= $this->hook->render('template:task:details:third-column', array('task' => $task)) ?>
                </ul>
            </div>
            <div class="task-summary-column">
                <ul class="no-bullet">
                    <?php if ($task['date_due']): ?>
                        <li>
                            <strong><?= t('Due date:') ?></strong>
                            <span><?= $this->dt->datetime($task['date_due']) ?></span>
                        </li>
                    <?php endif ?>
                    <li>
                        <strong><?= t('Created:') ?></strong>
                        <span><?= $this->dt->datetime($task['date_creation']) ?></span>
                    </li>
                    <?php if ($task['date_completed']): ?>
                        <li>
                            <strong><?= t('Completed:') ?></strong>
                            <span><?= $this->dt->datetime($task['date_completed']) ?></span>
                        </li>
                    <?php endif ?>
                    <?php if ($task['date_moved']): ?>
                        <li>
                            <strong><?= t('Moved:') ?></strong>
                            <span><?= $this->dt->datetime($task['date_moved']) ?></span>
                        </li>
                    <?php endif ?>

                    <?= $this->hook->render('template:task:details:fourth-column', array('task' => $task)) ?>
                </ul>
            </div>
        </div>
        <?php if (! empty($tags)): ?>
            <div class="task-tags">
                <ul>
                    <?php foreach ($tags as $tag): ?>
                        <li class="task-tag <?= $tag['color_id'] ? "color-{$tag['color_id']}" : '' ?>"><?= $this->text->e($tag['name']) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>
    </div>

    <?php if (! empty($task['external_uri']) && ! empty($task['external_provider'])): ?>
        <?= $this->app->component('external-task-view', array(
            'url' => $this->url->href('ExternalTaskViewController', 'show', array('project_id' => $task['project_id'], 'task_id' => $task['id'])),
        )) ?>
    <?php endif ?>

    <?= $this->hook->render('template:task:details:bottom', array('task' => $task)) ?>
</section>