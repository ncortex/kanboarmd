<?php

namespace Kanboard\Plugin\Fordchain\Helper;

use Kanboard\Core\Base;

/**
 * Fordchain helper
 *
 */
class FordchainHelper extends Base
{
    public function renderFordAssigneeField(array $users, array $values, array $errors = array(), array $attributes = array(), $name='owner_id', $label="Assignee")
    {
            if (isset($values['project_id']) && ! $this->helper->projectRole->canChangeAssignee($values)) {
                return '';
            }

            $attributes = array_merge(array('tabindex="3"'), $attributes);

            $html = $this->helper->form->label(t($label), $name);
            $html .= $this->helper->form->select($name, $users, $values, $errors, $attributes);

            return $html;
    }

    public function aaa(){
        return "<P>sss</P>";
    }

}
