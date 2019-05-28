<?php

namespace Kanboard\Plugin\TitleCompose\Helper;

use Kanboard\Core\Base;

/**
 * Fordchain helper
 *
 */
class TitleComposeHelper extends Base
{
    public function renderComposeTitleScript($format = '%d %d %s', array $values=['project_number','package_number','extra_number'], $name='form-title')
    {

        $title=vsprintf($format, $values);
        //$attributes = array_merge(array('tabindex="3"'), $attributes);

        //$html = $this->helper->form->label(t('Assignee'), $name);
        //$html .= $this->helper->form->select($name, $users, $values, $errors, $attributes);

        return '<p>html'.$title.'</p>';
    }

    public function renderExtraFields(array $values, array $errors)
    {
        $html = $this->helper->form->label('Project number', 'project_number');
        $html .= $this->helper->form->text('project_number',$values, $errors, ['style="display:inline_block;"'], 'form-input-small');

        $html .= $this->helper->form->label('Package number', 'package_number');
        $html .= $this->helper->form->text('package_number', $values, $errors, [], 'form-input-small');

        $html .= $this->helper->form->label('Extra number', 'extra_number');
        $html .= $this->helper->form->text('extra_number', $values, $errors, [], 'form-input-small');

        $html .= $this->renderComposeTitleScript();

        echo $html;
    }

    public function renderClientFields(array $values, array $errors){
        $html = "<a onclick='initClient();'>Load</a>";

        $html .= $this->helper->form->label('Client', 'client_id', [ 0 => "onclick=initClient();"]);
        $html .= $this->helper->form->select('client_id', ["1" => "uno", "2" => "dos" ], $values, $errors, [ 0 => "onchange=clientChange();", 1 => "onload=initClient(this);" ], 'form-input-small');

        $html .= $this->helper->form->label('Product', 'product_id');
        $html .= $this->helper->form->select('product_id', ["1" => "2" ], $values, $errors, [], 'form-input-small');

        $html .= $this->helper->form->label('Subproduct', 'subproduct_id');
        $html .= $this->helper->form->select('subproduct_id', ["1" => "2" ], $values, $errors, [], 'form-input-small');

        $html .= "<script type='text/javascript'>console.log('GGG')</script>";

        echo $html;
    }

}
