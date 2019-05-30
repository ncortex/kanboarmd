<?php

?>
<style>
.column {
    float: left;
    width: 30%;
    padding: 10px;
}
    .row:after {
    content: "";
    display: table;
    clear: both;
}
</style>

<div class="page-header">
    <h2><?= t('Configurar clientes') ?></h2>
</div>

<form id="metadata-type-creation-form" method="get" action=".">
    <?= $this->form->label("Nuevo cliente", 'client_name') ?>
    <?= $this->form->text('client_name', $values, $errors, ['required']) ?>


    <div class="form-actions">
        <button type="submit" class="btn btn-blue"><?= t('Create') ?></button>
    </div>

    <?= $this->form->csrf() ?>
</form>
<hr>

<?php if (!empty($types)): ?>
    <div class="row">
        <?php for ($i = 1; $i <=3; $i++): ?>
            <?php $x = 0 ?>
            <div class="column">
                <table
                    id="<?= $i ?>"
                    class="metadata-table table-striped table-scrolling"
                    data-save-position-url="<?= $this->url->href('MetadataTypesController', 'movePosition', array('plugin' => 'metaMagik')) ?>"
                >
                    <thead>
                    <tr>
                        <th><?= t('Field Name') ?></th>
                        <th><?= t('Type') ?></th>
                        <th><?= t('Options') ?></th>
                        <th><?= t('Action') ?></th>
                    </tr>
                    </thead>
                    <tbody id="<?= $i ?>" class="connected">
                    <tr class="disabled">
                        <td style="border: none"></td>
                        <td style="border: none"></td>
                        <td style="border: none"></td>
                        <td style="border: none"></td>
                    </tr>
                    <?php
                    foreach ($types as $type):
                        $key = $type['id']
                        ?>
                        <?php if ($type['column_number'] == $i): ?>
                        <tr data-metadata-id="<?= $type['id'] ?>">
                            <td>
                                <i class="fa fa-arrows-alt draggable-row-handle ui-sortable-handle" title="Change metadata position"></i>&nbsp;
                                <?= $type['human_name'] ?>
                            </td>
                            <td><?= $type['data_type'] ?></td>
                            <td><?= $type['options'] ?></td>
                            <td>
                                <?= $this->modal->small('remove', t('Remove'), 'MetadataTypesController', 'confirmTask', ['plugin' => 'metaMagik', 'key' => $key], false, 'popover') ?>
                            </td>
                        </tr>
                    <?php endif ?>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php endfor ?>
    </div>
<?php else: ?>
    <div class="listing">
        <?= t('No types have been defined yet.') ?>
    </div>
<?php endif ?>

