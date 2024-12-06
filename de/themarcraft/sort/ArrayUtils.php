<?php

namespace de\themarcraft\sort;

class ArrayUtils
{
    public static function fillArray(int $length)
    {
        $arr = [];
        for ($i = 0; $i < $length; $i++) {
            $arr[] = rand(1, 100000000);
        }
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/array.txt', json_encode($arr));
    }

    public static function getArray() : array
    {
        return json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/array.txt'));
    }
}