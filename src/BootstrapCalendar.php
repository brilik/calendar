<?php

namespace Brilik\Calendar;

use Brilik\Calendar\components\modal\ButtonOpenModalComponent;
use Brilik\Calendar\components\NavigationComponent;
use Brilik\Calendar\interface\ICalendar;
use Brilik\Calendar\traits\ActionClickPopover;
use Brilik\Calendar\traits\WeekDaysNamePanelTrait;
use Breadthe\SimpleCalendar\Calendar;
use Carbon\Carbon;

final class BootstrapCalendar extends Calendar implements ICalendar
{
    use ActionClickPopover, WeekDaysNamePanelTrait;

    public bool $navigation = false;
    private string $table;
    private readonly Carbon $currentDate;

    /**
     * @param string $today ISO date
     */
    public function __construct(string $today)
    {
        parent::__construct($today);

        $this->currentDate = Carbon::parse($today);
    }

    /** Return HTML of table.
     * @return string
     */
    public function render(): string
    {
        $navigation = $this->navigation ? $this->getNavigationHtml() : '';
        $popover = $this->popoverByClickDay ? $this->getModalHtml('My custom click') : '';
        $script = $this->popoverByClickDay ? '<script>
        const needleScript = document.querySelector("script[src*=\'bootstrap.bundle.js\']")
        // if (needleScript) {
            // const script = document.createElement("script")
            // script.innerHTML =
            setTimeout(() => {
                console.log(\'asd\')
                const popover = new bootstrap.Popover(document.querySelector("#popover-click"), {
                    trigger: "focus"
                })
            }, 700)
            // document.head.appendChild(script)
        // }
        </script>' : '';

        return $navigation . $this->getTableHtml() . $popover . $script;
    }

    /** Return HTML of table.
     * @return string
     */
    private function getTableHtml(): string
    {
        $table = '
        <table class="table" style="max-width: 650px">
            <thead>
            <tr>';

        foreach ($this->weekDaysName as $day) {
            $table .= '<th scope="col" class="text-center">' . $day . '</th>';
        }

        $table .= '</tr></thead><tbody>';
        $table .= '<tr>';
        $prevDate = null;

        foreach ($this->grid() as $date):
            // init of variables for current month
            $btn = new ButtonOpenModalComponent();
            $btn->setClass('btn btn-outline-secondary p-3 w-100')
                ->setBtnContent($date->day);
            // if item date equals today
            if ($date->eq($this->currentDate)) {
                $btn->setClass('btn btn-primary p-3 w-100');
            }
            // if isn't current month
            if ($date->month < $this->currentDate->month || $date->month > $this->currentDate->month) {
                $btn->setClass('btn btn-outline-secondary p-3 w-100')
                    ->disabled();
            } else {
                // if is end week
                if ($date->weekNumberInMonth > $prevDate->weekNumberInMonth) {
                    $table .= '<tr></tr>';
                }
            }

            $prevDate = $date;
            $table .= '<td class="text-center">' . $this->getButtonOpenModal($btn) . '</td>';
        endforeach;

        $table .= '</tr>';
        $table .= '</tbody></table>';

        return $table;
    }

    /** Return HTML of navigation.
     * @return string
     */
    private function getNavigationHtml(): string
    {
        return (new NavigationComponent())
            ->setNavClass('w-100')
            ->setNavAriaLabel('Table navigation')
            ->setListClass('pagination align-items-center justify-content-evenly')
            ->setBtnLeftHref($this->startOfPrevMonth->format('Y-m-d'))
            ->setBtnLeftClass('btn btn-link')
            ->setBtnLeftContent($this->startOfPrevMonth->format('F'))
            ->setBtnRightHref($this->startOfNextMonth->format('Y-m-d'))
            ->setBtnRightClass('btn btn-link')
            ->setBtnRightContent($this->startOfNextMonth->format('F'))
            ->setTitleClass('text-3xl text-gray-900 dark:text-white')
            ->setTitleContent($this->currentDate->format('F Y'))
            ->toString();
    }
}
