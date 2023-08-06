<?php

namespace VitoBryliano\Calendar\traits;

trait WeekDaysNamePanelTrait
{
    private array $weekDaysName;

    public function __construct()
    {
        $this->weekDaysName = $this->getWeekDaysName();
    }

    /** Get default English text starting at Monday.
     * @return array []
     */
    private function getWeekDaysName(): array
    {
        return ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sut', 'Sun'];
    }

    /**
     * Set text for translate it.
     * @param array $weekDaysName ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sut', 'Sun']
     */
    public function setWeekDaysName(array $weekDaysName): void
    {
        $this->weekDaysName = $weekDaysName;
    }
}
