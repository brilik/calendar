<?php

namespace VitoBryliano\Calendar\interface;

interface ICalendar
{
    public function __construct(string $today);

    public function render();
}
