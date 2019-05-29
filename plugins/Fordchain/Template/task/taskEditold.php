<div class="page-header">
    <h2><?= $this->text->e($project['name']) ?> &gt; <?= $this->text->e($task['title']) ?></h2>
</div>
<form method="post" id="formTaskCreation" action="<?= $this->url->href('TaskModificationController', 'update', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>" autocomplete="off">
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
            <?= $this->task->renderAssigneeField($users_list, $values, $errors, ['disabled="disabled"'], "gestor_id", "Project Manager") ?>
            <?= $this->task->renderAssigneeField($users_list, $values, $errors, [], "translator_id", "Traductor") ?>
            <?= $this->task->renderAssigneeField($users_list, $values, $errors, [], "reviewer_id", "Revisor") ?>

            <?= $this->hook->render('template:task:form:second-column', array('values' => $values, 'errors' => $errors)) ?>
        </div>

        <div class="task-form-secondary-column">
            <?= $this->task->renderStartDateField($values, $errors) ?>
            <?= $this->task->renderDueDateField($values, $errors) ?>
            <?= $this->task->renderReferenceField($values, $errors) ?>
            <?= $this->task->renderColorField($values) ?>

            <?= $this->hook->render('template:task:form:third-column', array('values' => $values, 'errors' => $errors)) ?>
        </div>

        <div class="task-form-bottom">
            <?= $this->modal->submitButtons() ?>
        </div>
    </div>
</form>
