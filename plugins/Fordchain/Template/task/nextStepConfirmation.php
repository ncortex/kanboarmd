<div class="page-header">
    <h2><?= t('Move task to next column') ?></h2>
</div>

<div class="confirm">
    <p class="alert alert-info">
        <?= t('Are you sure?') ?>
    </p>

    <div class="form-actions">
        <?= $this->url->link(t('Yes'), 'FordchainController', 'nextChainStep', ['plugin' => 'Fordchain', 'task_id' => $task_id['id'], 'project_id' => $task['project_id']], true, 'btn btn-green') ?>
    </div>
</div>
