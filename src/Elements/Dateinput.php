<?php

class Nip_Form_Element_Dateinput extends Nip_Form_Element_Input
{
    protected $_type = 'dateinput';
    protected $_locale = 'ct_EN';
    protected $_format = 'Y-m-d';
    protected $_hasTime = false;

    public function init()
    {
        parent::init();
        $this->setAttrib('type', 'date');

        if (app()->has('locale') == false) {
            return;
        }
        $localeObj = app('locale');
        if (!($localeObj instanceof \Nip\Locale\Locale)) {
            return;
        }
        $this->setLocale($localeObj->getCurrent());
        $this->setFormat($localeObj->getOption(['time', 'dateFormat']));
    }

    public function getLocale()
    {
        return $this->_locale;
    }

    public function setLocale($format)
    {
        $this->_locale = $format;
    }

    public function getFormat()
    {
        return $this->_format;
    }

    public function setFormat($format)
    {
        $this->_format = $format;
    }

    public function setTime($time)
    {
        $this->_hasTime = (bool)$time;
    }

    public function hasTime()
    {
        return $this->_hasTime;
    }

    public function getData($data, $source = 'abstract')
    {
        if ($source != 'model') {
            return parent::getData($data, $source);
        }

        if ($data instanceof DateTime) {
            $this->setValue($data->format('Y-m-d'));
            return $this;
        }

        if ($data && $data != '0000-00-00' && $data != '0000-00-00 00:00:00') {
            $dateUnix = strtotime($data);
            if ($dateUnix && $dateUnix !== false && $dateUnix > -62169989992) {
                $this->setValue(date('Y-m-d', $dateUnix));

                return $this;
            }
        }
        $this->setValue('');

        return $this;
    }

    public function validate()
    {
        parent::validate();
        if (!$this->isError() && $this->getValue()) {
            $this->validateFormat();
        }
    }

    /**
     * @param string $requester
     * @return null
     */
    public function getValue($requester = 'abstract')
    {
        $value = parent::getValue($requester);
        if ($requester == 'model') {
            if ($value) {
                $unixTime = $this->getUnix();
                $value = date('Y-m-d', $unixTime);
            }
        }

        return $value;
    }

    /**
     * @param false $format
     * @return false|int
     */
    public function getUnix($format = false)
    {
        $format = 'Y-m-d';
        $value = $this->getValue();
        $date = ($value) ? date_create_from_format($format, $this->getValue()) :false;
        if ($date instanceof DateTime) {
            return $date->getTimestamp();
        }

        return false;
    }

    public function validateFormat($format = false)
    {
        $format = 'Y-m-d';
        $value = $this->getValue();

        if ($value) {
            $unixTime = $this->getUnix('Y-m-d');
            if ($unixTime) {
                $this->setValue(date($format, $unixTime));

                return true;
            }
            $message = $this->getForm()->getMessageTemplate('bad-' . $this->getName());
            $message = $message ? $message : 'I couldn\'t parse the ' . strtolower($this->getLabel()) . ' you entered';
            $this->addError($message);
        }
        return false;
    }
}
