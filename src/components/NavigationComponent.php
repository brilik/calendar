<?php

namespace Brilik\Calendar\components;

class NavigationComponent
{
    private string $class = '';
    private string $ariaLabel = '';
    private string $listClass = '';
    private string $btnLeftHref = '';
    private string $btnLeftClass = '';
    private string $btnLeftContent = '';
    private string $btnRightHref = '';
    private string $btnRightClass = '';
    private string $btnRightContent = '';
    private string $titleClass = '';
    private string $titleContent = '';

    /**
     * @param string $string
     * @return $this
     */
    public function setNavClass(string $string): self
    {
        $this->class = $string;

        return $this;
    }

    /**
     * @param string $ariaLabel
     * @return NavigationComponent
     */
    public function setNavAriaLabel(string $ariaLabel): self
    {
        $this->ariaLabel = $ariaLabel;

        return $this;
    }

    /**
     * @param string $listClass
     * @return NavigationComponent
     */
    public function setListClass(string $listClass): self
    {
        $this->listClass = $listClass;

        return $this;
    }

    /**
     * @param string $btnLeftHref
     * @return NavigationComponent
     */
    public function setBtnLeftHref(string $btnLeftHref): self
    {
        $this->btnLeftHref = $btnLeftHref;

        return $this;
    }

    /**
     * @param string $btnLeftClass
     * @return NavigationComponent
     */
    public function setBtnLeftClass(string $btnLeftClass): self
    {
        $this->btnLeftClass = $btnLeftClass;

        return $this;
    }

    /**
     * @param string $btnLeftContent
     * @return NavigationComponent
     */
    public function setBtnLeftContent(string $btnLeftContent): self
    {
        $this->btnLeftContent = $btnLeftContent;

        return $this;
    }

    /**
     * @param string $btnRightHref
     * @return NavigationComponent
     */
    public function setBtnRightHref(string $btnRightHref): self
    {
        $this->btnRightHref = $btnRightHref;

        return $this;
    }

    /**
     * @param string $btnRightClass
     * @return NavigationComponent
     */
    public function setBtnRightClass(string $btnRightClass): self
    {
        $this->btnRightClass = $btnRightClass;

        return $this;
    }

    /**
     * @param string $btnRightContent
     * @return NavigationComponent
     */
    public function setBtnRightContent(string $btnRightContent): self
    {
        $this->btnRightContent = $btnRightContent;

        return $this;
    }

    /**
     * @param string $string
     * @return $this
     */
    public function setTitleClass(string $string): self
    {
        $this->titleClass = $string;

        return $this;
    }

    /**
     * @param string $titleContent
     * @return NavigationComponent
     */
    public function setTitleContent(string $titleContent): self
    {
        $this->titleContent = $titleContent;

        return $this;
    }

    public function toString(): string
    {
        return '<nav class="' . $this->class . '" aria-label="' . $this->ariaLabel . '">
            <ul class="' . $this->listClass . '">
                <li>
                    <a href="?date=' . $this->btnLeftHref . '" class="' . $this->btnLeftClass . '" role="button">
                     <span aria-hidden="true">&laquo;</span>&nbsp;' . $this->btnLeftContent . '</a>
                </li>
                <li>
                    <span class="' . $this->titleClass . '">' . $this->titleContent . '</span>
                </li>
                <li>
                    <a href="?date=' . $this->btnRightHref . '" class="' . $this->btnRightClass . '" role="button">
                    ' . $this->btnRightContent . '&nbsp;<span aria-hidden="true" >&raquo;</span></a>
                </li>
            </ul>
        </nav>';
    }
}
