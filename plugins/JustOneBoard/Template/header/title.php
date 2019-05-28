<h1>
    <span class="logo">
        <?= $this->url->link('K<span>B</span>', 'BoardViewController', 'show', array('project_id' => 1), false, '', t('Dashboard')) ?>
    </span>
    <span class="title">
        <?php if (! empty($project) && ! empty($task)): ?>
            <?= $this->url->link($this->text->e($project['name']), 'BoardViewController', 'show', array('project_id' => $project['id'])) ?>
        <?php else: ?>
            <?= $this->text->e($title) ?>
        <?php endif ?>
    </span>
</h1>
