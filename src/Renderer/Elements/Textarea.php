<?php

class Nip_Form_Renderer_Elements_Textarea extends \Nip\Form\Renderer\Elements\AbstractElementRenderer
{
    public function generateElement()
    {
        $return = '<textarea ';
        $return .= $this->renderAttributes();
        $return .= ' >' . $this->getElement()->getValue() . '</textarea>';
        return $return;
    }

    public function getElementAttribs()
    {
        $attribs = parent::getElementAttribs();
        $attribs[] = 'rows';
        $attribs[] = 'cols';
        return $attribs;
    }
}
