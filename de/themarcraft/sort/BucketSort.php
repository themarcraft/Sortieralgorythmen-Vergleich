<?php

namespace de\themarcraft\sort;

class BucketSort
{
    private int $runs = 0;

    public function getRuns()
    {
        return $this->runs;
    }
    public function sort(array $array){
        $max = max($array); // Größter Wert im Array
        $min = min($array); // Kleinster Wert im Array

        $bucket_count = ceil(sqrt(count($array)));  // Anzahl der Buckets, in die der Array aufgeteilt wird

        $buckets = array_fill(0, $bucket_count, []); // Erstelle ein neues Array aus bestimmten Werten aus dem array

        foreach ($array as $value) {
            $bucket_index = floor(($value - $min) / ($max - $min) * $bucket_count);
            $buckets[$bucket_index][] = $value;
            $this->runs++;
        }

        foreach ($buckets as &$bucket) {
            sort($bucket);
        }

        return array_reduce($buckets, 'array_merge', []);
    }
}