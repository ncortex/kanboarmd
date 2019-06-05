<?php if ($task['creator_username']): ?>
    <li>
        <strong><?= t('Creator:') ?></strong>
        <span><?= $this->text->e($task['creator_name'] ?: $task['creator_username']) ?></span>
    </li>
<?php endif ?>
<?php if (!empty($task['translator_id'])): ?>
    <li>
        <strong><?= t('Traductor:') ?></strong>
        <span><?= $this->helper->fordchainHelper->getUsernameById($task['translator_id'])  ?></span>
        <?php if ($task['translator_id'] == $task['owner_id']): ?>
            <<
        <?php endif ?>
    </li>
<?php endif ?>
<?php if (!empty($task['reviewer_id'])): ?>
    <li>
        <strong><?= t('Revisor:') ?></strong>
        <span><?= $this->helper->fordchainHelper->getUsernameById($task['reviewer_id'])  ?></span>
        <?php if ($task['reviewer_id'] == $task['owner_id']): ?>
            <<
        <?php endif ?>
    </li>
<?php endif ?>
<?php if (!empty($task['gestor_id'])): ?>
    <li>
        <strong><?= t('Gestor:') ?></strong>
        <span><?= $this->helper->fordchainHelper->getUsernameById($task['gestor_id'])  ?></span>
        <?php if ($task['gestor_id'] == $task['owner_id']): ?>
            <<
        <?php endif ?>
    </li>
<?php endif ?>