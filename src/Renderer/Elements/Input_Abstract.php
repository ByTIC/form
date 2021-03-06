<?php

/**
 * Class Nip_Form_Renderer_Elements_Input_Abstract
 */
abstract class Nip_Form_Renderer_Elements_Input_Abstract extends \Nip\Form\Renderer\Elements\AbstractElementRenderer
{
    /**
     * @return string
     */
    public function generateElement()
    {
        $return = '<input ';
        $return .= $this->renderAttributes();
        $return .= ' />';

        return $return;
    }

    /**
     * @return array
     */
    public function getElementAttribs()
    {
        $attribs = parent::getElementAttribs();
        $attribs[] = 'type';
        $attribs[] = 'value';
        $attribs[] = 'placeholder';
        $attribs[] = 'size';

        return $attribs;
    }
}
