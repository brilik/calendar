<?php
/*
 * Copyright (c) 2023. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace App\Library\Calendar\traits;

use App\Library\Calendar\components\modal\ButtonOpenModalComponent;

/**
 * todo Next version:
 *  1. Modal content is duplicate, so u need add content using date in setModalContent(date, html).
 *  2. Use DTO for set of attributes button and modal.
 */
trait ActionClickPopover
{
    private string $modalContent = '<p>And here\'s some amazing content. It\'s very engaging. Right?</p>';
    private ButtonOpenModalComponent $button;
    /** todo Next version:
     *   1. Need to be able to add events to the calendar.
     * @var bool
     */
    public bool $popoverByClickDay = false;

    /** Set HTML content in the modal.
     *
     * @param  string  $html
     *
     * @return void
     */
    public function setModalContent(string $html = ''): void
    {
        $this->modalContent = $html;
    }

    /** Get HTML button which open modal.
     *
     * @param  ButtonOpenModalComponent  $button
     *
     * @return string
     */
    private function getButtonOpenModal(ButtonOpenModalComponent $button): string
    {
        return $button->toString();
    }

    /** Return HTML of modal. Requires bootstrap.bundle.min.js for it.
     *  todo Next version:
     *   1. Need use the components/modal/ModalContentComponent for set attributes in HTML.
     * @param  string  $title
     *
     * @return string
     * @requires bootstrap.bundle.min.js
     */
    private function getModalHtml(string $title = 'Popover click'): string
    {
        return '<div data-popover id="popover-click" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                    <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-white">' . $title . '</h3>
                    </div>
                    <div class="px-3 py-2">' . $this->modalContent . '</div>
                    <div data-popper-arrow></div>
                </div>';
    }
}
