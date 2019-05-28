<?php

if ($this->projectRole->canCreateTaskInColumn(1, 5)) {
    $this->task->getNewBoardTaskButton([0], 5);
}
?>