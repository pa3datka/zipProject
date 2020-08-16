<?php


namespace application\lib;


class Date
{
    public $presentTime;
    public $pastTime;

    public function __construct($pastTime, $presentTime = null)
    {
        $this->pastTime = $pastTime;
        if ($presentTime === null) {
            $this->presentTime = time();
        } else $this->presentTime = $presentTime;
    }

    public function dateDiffDay()
    {
       $date1 = date_create(date('Ymd',$this->pastTime));
       $date2 = date_create(date('Ymd',$this->presentTime));
       return date_diff($date1, $date2)->d;
    }

    public function dateDiffSecond()
    {
       return $this->presentTime - $this->pastTime;
    }
}