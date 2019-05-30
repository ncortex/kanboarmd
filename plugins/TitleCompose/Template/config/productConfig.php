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
    <h2><?= t('Configurar productos de'. $cliente['title']) ?></h2>
</div>

<form id="metadata-type-creation-form" method="post" action="<?= $this->url->href('TitleComposeController', 'config', ['plugin' => 'TitleCompose']) ?> ">
    <?= $this->form->label("Nuevo producto", 'client_name') ?>
    <?= $this->form->text('client_name', $values, $errors, ['required']) ?>


    <div class="form-actions">
        <button type="submit" class="btn btn-blue"><?= t('Create') ?></button>
    </div>

    <?= $this->form->csrf() ?>
</form>
<hr>

<?php if (!empty($productos)): ?>
    <div class="row">
        <div class="column">
            <table
                class="metadata-table table-striped table-scrolling"
            >
                <thead>
                <tr>
                    <th><?= t('Product Name') ?></th>
                    <th><?= t('Action') ?></th>
                </tr>
                </thead>
                <?php
                foreach ($productos as $producto):
                    $key = $producto['id']
                    ?>
                    <tr data-metadata-id="<?= $producto['id'] ?>">
                        <td>
                            <i class="fa fa-arrows-alt draggable-row-handle ui-sortable-handle" title="Change metadata position"></i>&nbsp;
                            <?= $producto['title'] ?>
                        </td>
                        <td>
                            <?= $this->url->link(t('Editar productos'), 'TitleComposeController', 'configproducts', ['plugin' => 'TitleCompose']) ?>                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else: ?>
    <div class="listing">
        <?= t('No clients have been defined yet.') ?>
    </div>
<?php endif ?>

