<?php
/**
 * Created by PhpStorm.
 * User: mmwebaze
 * Date: 11/7/2016
 * Time: 8:40 AM
 */

namespace AppBundle\Util;


class ArrayImploder
{
    public static function implodeArray($arrayToImplode = array(), $separator = ";"){

        return implode($separator, $arrayToImplode);
    }
}