<div class="input-addon-item">
    <div class="dropdown">
        <a href="#" class="dropdown-menu dropdown-menu-link-icon" title="<?= t('Date filters') ?>"><i class="fa fa-date fa-fw"></i><i class="fa fa-caret-down"></i></a>
        <ul>
            <li><a href="#" class="filter-helper" data-unique-filter="due:today"><?= t('Hoy') ?></a></li>
            <li><a href="#" class="filter-helper" data-unique-filter="due:tomorrow"><?= t('Mañana') ?></a></li>
            <li><a href="#" class="filter-helper" data-unique-filter="category:none"><?= t('Esta semana') ?></a></li>
            <li><a href="#" class="filter-helper" data-unique-filter="category:none"><?= t('Este mes') ?></a></li>
            <li><a href="#" class="filter-helper" data-unique-filter="category:none"><?= t('Rango') ?></a></li>
            <?php foreach ($categories_list as $category): ?>
                <li><a href="#" class="filter-helper" data-unique-filter='category:"<?= $this->text->e($category) ?>"'><?= $this->text->e($category) ?></a></li>
            <?php endforeach ?>
        </ul>
    </div>
</div>