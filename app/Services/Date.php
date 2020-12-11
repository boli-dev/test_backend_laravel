<?php


namespace App\Services;


class Date {

    public $date;
    public $dateNumber;
    public $dateName;
    public $value;

    public function __construct(string $date, int $dateNumber, string $dateName, float $value = 0) {
        $this->date = $date;
        $this->dateName = $dateName;
        $this->dateNumber = $dateNumber;
        $this->value = $value;
    }

}
