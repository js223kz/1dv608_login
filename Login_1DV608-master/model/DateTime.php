<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-09-11
 * Time: 15:50
 */

namespace model;


class DateTime
{
    private $day;
    private $date;
    private $month;
    private $year;
    private $time;
    /**
     *
     */
    public function __construct(){
        $this->day = date("l");
        $this->date = date("d");
        $this->month = date("F");
        $this->year = date("Y");
        $this->time = date("h:i:s");
    }

    public function getDay(){
        return $this->day;
    }

    public function getDate(){
        return $this->date;
    }

    public function getMonth(){

        return $this->month;
    }

    public function getYear(){
        return $this->year;
    }

    public function getTime(){
        return $this->time;
    }

}