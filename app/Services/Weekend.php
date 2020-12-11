<?php


namespace App\Services;



class Weekend extends Date {

    public function __construct(string $date, int $dateNumber, string $dateName) {
        parent::__construct($date, $dateNumber, $dateName);
    }

}
