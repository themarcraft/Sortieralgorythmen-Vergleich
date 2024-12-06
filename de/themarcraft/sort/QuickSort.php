<?php

namespace de\themarcraft\sort;

class QuickSort
{

    private int $runs = 0;

    public function getRuns()
    {
        return $this->runs;
    }

    public function sort(array $array) : array
    {
        if (count($array) <= 1) {
            return $array;
        }

        $current = array_shift($array);
        $kleiner = [];
        $groesser = [];

        foreach ($array as $val) {
            if ($val < $current) {
                $kleiner[] = $val;
            } elseif ($val > $current) {
                $groesser[] = $val;
            }
            $this->runs++;
        }

        return array_merge($this->sort($kleiner), [$current], $this->sort($groesser));
    }
}