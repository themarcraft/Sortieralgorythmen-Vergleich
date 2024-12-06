<?php

namespace de\themarcraft\sort;

class InsertionSort
{
    private int $runs = 0;

    public function getRuns()
    {
        return $this->runs;
    }

    public function sort(array $array)
    {
        $n = count($array);

        for ($i = 1; $i < $n; $i++) {
            $current = $array[$i];
            $j = $i - 1;

            while ($j >= 0 && $array[$j] > $current) {
                $array[$j + 1] = $array[$j];
                $j = $j - 1;
                $this->runs++;
            }
            $array[$j + 1] = $current;
        }

        return $array;
    }
}