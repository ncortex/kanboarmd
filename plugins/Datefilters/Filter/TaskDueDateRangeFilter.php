<?php

namespace Kanboard\Plugin\Datefilters\Filter;

use Kanboard\Core\Filter\FilterInterface;
use Kanboard\Model\TaskModel;
use Kanboard\Filter\BaseDateRangeFilter;

/**
 * Filter tasks by modification date
 *
 * @package filter
 * @author  Kamil Ściana
 */
class TaskDueDateRangeFilter extends BaseDateRangeFilter implements FilterInterface
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
        $this->applyDateFilter(TaskModel::TABLE.'.date_due');
        return $this;
    }
}
