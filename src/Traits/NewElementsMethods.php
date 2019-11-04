<?php

namespace Nip\Form\Traits;

use Nip\Form\Elements\AbstractElement as ElementAbstract;

/**
 * Class NewElementsMethods
 * @package Nip\Form\Traits
 */
trait NewElementsMethods
{
    /**
     * @return ElementAbstract|\Nip_Form_Element_Select
     */
    public function getNewSelectElement()
    {
        return $this->getNewElement('select');
    }

    /**
     * @param $name
     * @param bool $label
     * @param string $type
     * @param bool $isRequired
     * @return $this
     */
    public function add($name, $label = false, $type = 'input', $isRequired = false)
    {
        $label = ($label) ? $label : ucfirst($name);
        $element = $this->getNewElement($type)
            ->setName($name)
            ->setLabel($label)
            ->setRequired($isRequired);
        $this->addElement($element);

        return $this;
    }

    /**
     * @param $className
     * @param $name
     * @param bool $label
     * @param bool $isRequired
     * @return $this
     */
    public function addCustom($className, $name, $label = false, $isRequired = false)
    {
        $label = ($label) ? $label : ucfirst($name);
        $element = $this->getNewElementByClass($className)
            ->setName($name)
            ->setLabel($label)
            ->setRequired($isRequired);
        $this->addElement($element);

        return $this;
    }

    /**
     * @param string $type
     * @return ElementAbstract
     */
    public function getNewElement($type)
    {
        $className = $this->getElementClassName($type);

        return $this->getNewElementByClass($className);
    }

    /**
     * @param $type
     * @return string
     */
    public function getElementClassName($type)
    {
        return 'Nip_Form_Element_'.ucfirst($type);
    }

    /**
     * @param $className
     * @return ElementAbstract
     */
    public function getNewElementByClass($className)
    {
        $element = new $className($this);

        return $this->initNewElement($element);
    }

    /**
     * @param ElementAbstract $element
     * @return ElementAbstract
     */
    public function initNewElement($element)
    {
        $element->setForm($this);

        return $element;
    }
}
