<?php

namespace App\Library\Calendar\components\modal;

class ButtonOpenModalComponent
{
    private string $class;
    private string $btnContent;
    private string $disabled = '';

    /**
     * @param string $class
     * @return ButtonOpenModalComponent
     */
    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @param string $btnContent
     * @return ButtonOpenModalComponent
     */
    public function setBtnContent(string $btnContent): self
    {
        $this->btnContent = $btnContent;

        return $this;
    }

    /**
     * @param string $class
     * @return ButtonOpenModalComponent
     */
    public function disabled(string $class = 'disabled'): self
    {
        $this->disabled = ' ' . $class;

        return $this;
    }

    public function toString(): string
    {
        $disabled = $this->disabled ? 'disabled' : '';

        return '<button type="button"
                        data-popover-target="popover-click"
                        data-popover-trigger="click"
                        ' . $disabled . '
                        class="' . $this->class . $this->disabled . '">' . $this->btnContent . '</button>';
    }
}
