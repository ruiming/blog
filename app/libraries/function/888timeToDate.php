<?php
/**
 * Created by PhpStorm.
 * User: tsin
 * Date: 2016/2/3
 * Time: 19:46
 */
//$time 201504
function timeToDate($time)
{
    if(strlen($time)==6){
        return substr($time,0,4)."年".substr($time,5,2)."月";
    }
    else{
        return substr($time,0,4)."年".substr($time,6,1)."月";
    }
}