<div class="page-header">
    <h2><?= $this->text->e($project['name']) ?> &gt; <?= t('New task') ?></h2>
</div>
<form method="post" id="formTaskCreation" action="<?= $this->url->href('TaskCreationController', 'save', array('project_id' => $project['id'])) ?>" autocomplete="off">
    <?= $this->form->csrf() ?>

    <div class="task-form-container">
        <div class="task-form-main-column">
            <?= $this->task->renderTitleField($values, $errors) ?>
            <?= $this->task->renderDescriptionField($values, $errors) ?>
            <?= $this->task->renderCategoryField($categories_list, $values, $errors) ?>
            <?= $this->task->renderTagField($project) ?>


            <?= $this->hook->render('template:task:form:first-column', array('values' => $values, 'errors' => $errors)) ?>
        </div>

        <div class="task-form-secondary-column">
            <div style="display: none"> <?= $this->task->renderAssigneeField($users_list, $values, $errors, array(), "owner_id") ?> </div>
            <?= $this->task->renderAssigneeField($users_list, $values, $errors, [], "gestor_id", "Project Manager") ?>
            <?= $this->task->renderAssigneeField($users_list, $values, $errors, [], "translator_id", "Traductor") ?>
            <?= $this->task->renderAssigneeField($users_list, $values, $errors, [], "reviewer_id", "Revisor") ?>

            <?= $this->hook->render('template:task:form:second-column', array('values' => $values, 'errors' => $errors, 'users_list' => $users_list)) ?>
        </div>

        <div class="task-form-secondary-column">
            <?= $this->task->renderStartDateField($values, $errors) ?>
            <?= $this->task->renderDueDateField($values, $errors) ?>
            <?= $this->task->renderReferenceField($values, $errors) ?>
            <?= $this->task->renderColorField($values) ?>

            <?= $this->hook->render('template:task:form:third-column', array('values' => $values, 'errors' => $errors)) ?>

        </div>

        <div class="task-form-bottom">
            <?php if (! isset($duplicate)): ?>
                <?= $this->form->checkbox('another_task', t('Create another task'), 1, isset($values['another_task']) && $values['another_task'] == 1) ?>
            <?php endif ?>

            <?= $this->modal->submitButtons() ?>
        </div>
    </div>
</form>