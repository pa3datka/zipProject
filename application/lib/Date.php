<?php


namespace application\lib;

/**
 * Class Date
 * @package application\lib
 */
class Date
{
    /**
     * @var int
     */
    public $presentTime;
    public $pastTime;

    /**
     * Date constructor.
     * @param $pastTime
     * @param null $presentTime
     */
    public function __construct($pastTime, $presentTime = null)
    {
        $this->pastTime = $pastTime;
        if ($presentTime === null) {
            $this->presentTime = time();
        } else $this->presentTime = $presentTime;
    }

    /**
     * @return int
     */
    public function dateDiffDay()
    {
       $date1 = date_create(date('Ymd',$this->pastTime));
       $date2 = date_create(date('Ymd',$this->presentTime));
       return date_diff($date1, $date2)->d;
    }

    /**
     * @return int
     */
    public function dateDiffSecond()
    {
       return $this->presentTime - $this->pastTime;
    }
}