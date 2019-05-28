<?php

if ($this->projectRole->canCreateTaskInColumn(1, 5)) {
    $html = '<div class="board-add-icon">';
    $html .= $this->helper->modal->largeIcon(
        'plus',
        t('Add a new task'),
        'TaskCreationController',
        'show', array(
            'project_id'  => 1,
            'column_id'   => 5,
            'swimlane_id' => 1,
        )
    );
    $html .= '</div>';

    return $html;
}
?>