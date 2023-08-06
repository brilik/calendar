<?php

namespace VitoBryliano\Calendar;

use VitoBryliano\Calendar\components\modal\ButtonOpenModalComponent;
use VitoBryliano\Calendar\components\NavigationComponent;
use VitoBryliano\Calendar\interface\ICalendar;
use VitoBryliano\Calendar\traits\ActionClickPopover;
use VitoBryliano\Calendar\traits\WeekDaysNamePanelTrait;
use Breadthe\SimpleCalendar\Calendar;
use Carbon\Carbon;

/**
 * todo Next version:
 *  1. Need add translate for month and for week days name (Carbon::setLocale('uk_UA');).
 */
final class TailWindCalendar extends Calendar implements ICalendar
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

    /** Return HTML of the Calendar.
     * @return string
     */
    public function render(): string
    {
        $navigation = $this->navigation ? $this->getNavigationHtml() : '';
        $popover = $this->popoverByClickDay ? $this->getModalHtml('My custom click') : '';

        return $navigation . $this->getTableHtml() . $popover;
    }

    /** Return HTML of table.
     * @return string
     */
    private function getTableHtml(): string
    {
        $table = '
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>';

        foreach ($this->weekDaysName as $day) {
            $table .= '<th scope="col" class="px-6 py-3">' . $day . '</th>';
        }

        $table .= '</tr></thead><tbody>';
        $table .= '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">';
        $prevDate = null;

        foreach ($this->grid() as $date):
            // init of variables for current month
            $btn = new ButtonOpenModalComponent();
            $btn->setClass('text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800')
                ->setBtnContent($date->day);
            // if item date equals today
            if ($date->eq($this->currentDate)) {
                $btn->setClass('text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700');
            }
            // if isn't current month
            if ($date->month < $this->currentDate->month || $date->month > $this->currentDate->month) {
                $btn->setClass('p-3 w-full text-gray-300')
                    ->disabled('cursor-not-allowed');
            } else {
                // if is end week
                if ($date->weekNumberInMonth > $prevDate->weekNumberInMonth) {
                    $table .= '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"></tr>';
                }
            }

            $prevDate = $date;
            $table .= '<td class="p-4 text-center">' . $this->getButtonOpenModal($btn) . '</td>';
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
            ->setNavClass('pt-4')
            ->setNavAriaLabel('Table navigation')
            ->setListClass('flex items-center justify-between py-5')
            ->setBtnLeftHref($this->startOfPrevMonth->format('Y-m-d'))
            ->setBtnLeftClass('font-medium text-gray-600 dark:text-gray-500 hover:underline')
            ->setBtnLeftContent($this->startOfPrevMonth->format('F'))
            ->setBtnRightHref($this->startOfNextMonth->format('Y-m-d'))
            ->setBtnRightClass('font-medium text-gray-600 dark:text-gray-500 hover:underline')
            ->setBtnRightContent($this->startOfNextMonth->format('F'))
            ->setTitleClass('text-3xl text-gray-900 dark:text-white')
            ->setTitleContent($this->currentDate->format('F Y'))
            ->toString();
    }
}
