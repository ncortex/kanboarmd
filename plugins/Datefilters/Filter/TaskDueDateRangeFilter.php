<?php

namespace Kanboard\Plugin\Datefilters\Filter;

use Kanboard\Core\Filter\FilterInterface;
use Kanboard\Filter\BaseFilter;
use Kanboard\Model\TaskModel;

/**
 * Filter tasks by modification date
 *
 * @package filter
 * @author  Kamil Ściana
 */
class TaskDueDateRangeFilter extends BaseFilter implements FilterInterface
{
    /**
     * Get search attribute
     *
     * @access public
     * @return string[]
     */
    public function getAttributes()
    {
        return array('dueRange');
    }

    /**
     * Apply filter
     *
     * @access public
     * @return FilterInterface
     */
    public function apply()
    {
        $this->query->gte(TaskModel::TABLE.'.date_due', is_numeric($this->value[0]) ? $this->value[0] : strtotime($this->value[0]));
        $this->query->lte(TaskModel::TABLE.'.date_due', is_numeric($this->value[1]) ? $this->value[1] : strtotime($this->value[1]));
        return $this;

        $this->applyDateFilter(TaskModel::TABLE.'.date_due');
        return $this;
    }
}
