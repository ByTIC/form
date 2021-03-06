<?php

namespace Nip\Form\Elements\Traits;

use Nip\Form\Renderer\Elements\AbstractElementRenderer;

/**
 * Trait HasRendererTrait
 * @package Nip\Form\Elements\Traits
 */
trait HasRendererTrait
{
    protected $_isRendered = false;

    /**
     * @param boolean $isRendered
     * @return $this
     */
    public function setRendered($isRendered)
    {
        $this->_isRendered = (bool)$isRendered;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRendered()
    {
        return (bool)$this->_isRendered;
    }

    /**
     * @return bool
     */
    public function hasCustomRenderer()
    {
        return false;
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return $this->getRenderer()->render($this);
    }

    /**
     * @return AbstractElementRenderer
     */
    public function getRenderer()
    {
        return $this->getForm()->getRenderer()->getElementRenderer($this);
    }

    /**
     * @return mixed
     */
    public function renderElement()
    {
        return $this->getRenderer()->renderElement();
    }

    /**
     * @return mixed
     */
    public function renderErrors()
    {
        return $this->getRenderer()->renderErrors();
    }

    /**
     * @param null|string|array $extraClasses
     * @return mixed
     */
    public function renderLabel($extraClasses = null)
    {
        return $this->getRenderer()->renderLabel($extraClasses);
    }

    /**
     * @param bool $value
     */
    public function setRenderLabel(bool $value)
    {
        $this->setOption('render_label', $value);
    }

    /**
     * @return bool
     */
    public function isRenderLabel()
    {
        return $this->getOption('render_label') !== false;
    }
}
