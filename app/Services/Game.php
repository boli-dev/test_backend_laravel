<?php


namespace App\Services;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\This;

class Game {

    public $total;
    public $baseline;
    public $date1;
    public $date2;

    public $randomValues;

    public function __construct(int $total, int $baseline, string $date1, string $date2) {
        $this->total = $total;
        $this->baseline = $baseline;
        $this->date1 =$date1;
        $this->date2 = $date2;

        $this->randomValues = array();
    }

    private function getDayNameOfWeek(string $date){
        return Carbon::parse($date)->englishDayOfWeek;
    }

    private function getDayNumberOfWeek(string $date){
        return Carbon::parse($date)->dayOfWeekIso;
    }

    public function getRangeOfDates() {
        $array = array();
        foreach (Carbon::parse($this->date1)->range($this->date2) as $date) {
            array_push($array, new Date(
                $date->format('d-m-Y'),
                $this->getDayNumberOfWeek($date),
                $this->getDayNameOfWeek($date)
            ));
        }

        return $array;
    }

    public function getTheWeekends() {
        $array = array();
        foreach ($this->getRangeOfDates() as &$date) {
            if(!Carbon::parse($date->date)->isWeekday()) {
                array_push($array, new Weekend(
                    $date->date,
                    $date->dateNumber,
                    $date->dateName
                ));
            }
        }

        return $array;
    }

    public function getDatesWithoutWeekends() {
        $array = array();
        foreach ($this->getRangeOfDates() as &$date) {
            if(Carbon::parse($date->date)->isWeekday()) {
                array_push($array, $date);
            }
        }

        return $array;
    }

    private function getRandomNumbers() {
        $somme = 0;
        $randomValueArray = array();
        $array = array();

        for ($i = 0; $i < sizeof($this->getDatesWithoutWeekends()); $i++) {
            $randomValue = mt_rand(1, 1000);
            $somme += $randomValue;
            array_push($randomValueArray , $randomValue);
        }

        $somme = floatval($somme);
        foreach ($randomValueArray as $value) {
            array_push( $array, floatval($value) / $somme);
        }

        return $array;
    }

    public function getMinValuePerDay() {
        return floatval($this->total) * floatval($this->baseline)
            / (floatval(sizeof($this->getDatesWithoutWeekends()))*100);
    }

    private function getMAxValuePerDay() {
        $bool = mt_rand(0, 1);
        return $bool === 0
            ? (floatval(100 - $this->baseline) * floatval($this->total)/100) + ($this->total / 100)
            : (floatval(100 - $this->baseline) * floatval($this->total)/100) - ($this->total / 100);
    }

    public function getValuesPerDay() {
        $maxValue = $this->getMAxValuePerDay();
        $minValue = $this->getMinValuePerDay();

        foreach ($this->getRandomNumbers() as &$number) {
            $theValue = $number * $maxValue + $minValue;
            $valueWithTwoDecimal = number_format($theValue, 2,'.','');
            array_push($this->randomValues, $valueWithTwoDecimal);
        }

        return $this->randomValues;
    }

    public function getSommeOfValues() {
        if(!array_key_exists(0, $this->randomValues)){
            $this->getValuesPerDay();
        }
        return number_format(array_sum($this->randomValues));
    }

    public function checkAboveOrBelow1P() {
        $min = number_format(( $this->total - $this->total / 100));
        $max = number_format(( $this->total / 100) + $this->total);

        if ($this->getSommeOfValues() === $min ){
            return "below";
        } else if ($this->getSommeOfValues() === $max) {
            return "above";
        } else {
            return false;
        }
    }

    public function finalTouch() {
        $array = array();
        if(!array_key_exists(0, $this->randomValues)){
            $this->getValuesPerDay();
        }
        foreach ($this->getDatesWithoutWeekends() as $key => &$date) {
            array_push($array, new Date(
                $date->date,
                $date->dateNumber,
                $date->dateName,
                $this->randomValues[$key]
            ));
        }

        $collapseEveryThing = Arr::collapse([$array, $this->getTheWeekends()]);
        return Arr::shuffle($collapseEveryThing);

    }

}
