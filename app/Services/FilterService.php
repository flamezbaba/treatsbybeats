<?php

namespace App\Services;

class FilterService
{
    public static function filAmount($amount)
    {
        return preg_replace('/[^0-9+.]/', '', $amount);
    }

    public static function makeMoneyWhole($amount)
    {
        $a = round($amount);
        $last = substr($a, -1);
        $rem = substr($a, 0, -1);

        if ($last == 0) {
            $real = $rem . '' . $last;
        } else {
            $real = $rem . '0';
        }

        return intval($real);
    }

    public static function dateToOfficial($date)
    {
        // return date('D Y-M-d', strtotime($date));
        if ($date == null) {
            return '';
        }
        return date('D, M d Y', strtotime($date));
    }

    public static function dateTimeToOfficial($date)
    {
        if ($date == null) {
            return '';
        }
        return date('D Y-m-d H:i', strtotime($date));
    }

    public static function dateObj($date)
    {
        if (!strtotime($date)) {
            return $obj = [
                'raw' => null,
                'sqlDate' => null,
                'sqlDateTime' => null,
                'withDay' => null,
                'withDayTime' => null,
            ];
        }

        $obj = [
            'raw' => $date,
            'sqlDate' => date('Y-m-d', strtotime($date)),
            'sqlDateTime' => date('Y-m-d H:i:s', strtotime($date)),
            'withDay' => date('D M d, Y', strtotime($date)),
            'withDayTime' => date('D M d, Y h:i A', strtotime($date)),
        ];
        return (object) $obj;
    }
}
