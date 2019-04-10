<?php

namespace Kanboard\Plugin\Fordchain\Helper;

use Kanboard\Core\Base;

/**
 * Fordchain helper
 *
 */
class FordchainHelper extends Base
{
    public function renderFordAssigneeField(array $users, array $values, array $errors = array(), array $attributes = array(), $name='owner_id')
    {
        //$attributes = array_merge(array('tabindex="3"'), $attributes);

        //$html = $this->helper->form->label(t('Assignee'), $name);
        //$html .= $this->helper->form->select($name, $users, $values, $errors, $attributes);

        return '<p>html'.$name.'</p>';
    }

    public function aaa(){
        return "<P>sss</P>";
    }

}
