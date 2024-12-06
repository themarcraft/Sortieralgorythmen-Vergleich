<?php

namespace de\themarcraft\sort;

class RadixSort
{
    private int $runs = 0;

    public function getRuns()
    {
        return $this->runs;
    }

    public function sort(array $array){
        $hoechsterWert = max($array);
        $laenge = strlen((string) $hoechsterWert);

        for ($i = 0; $i < $laenge; $i++) {
            $buckets = array_fill(0, 10, []);

            foreach ($array as $num) {
                $ziffer = (int)($num / pow(10, $i)) % 10;
                $buckets[$ziffer][] = $num;
                $this->runs++;
            }

            $array = [];
            for ($j = 0; $j < 10; $j++) {
                $array = array_merge($array, $buckets[$j]);
            }
        }

        return $array;
    }
}