<?php

include('de/themarcraft/sort/ArrayUtils.php');
include('de/themarcraft/sort/RadixSort.php');
include('de/themarcraft/sort/QuickSort.php');
include('de/themarcraft/sort/InsertionSort.php');
include('de/themarcraft/sort/BucketSort.php');

use de\themarcraft\sort\ArrayUtils;
use de\themarcraft\sort\BucketSort;
use de\themarcraft\sort\InsertionSort;
use de\themarcraft\sort\QuickSort;
use de\themarcraft\sort\RadixSort;

function run($arrayLength)
{
    ArrayUtils::fillArray($arrayLength);

    $radixSort = new RadixSort();
    $quickSort = new QuickSort();
    $insertionSort = new InsertionSort();
    $bucketSort = new BucketSort();
    $array = ArrayUtils::getArray();

    /**
     * Radix Sort
     */

    $beginn = microtime(true);

    $radixSort->sort($array);

    $dauer = microtime(true) - $beginn;
    echo "Dauer des Radix Sort Algorithmus: $dauer Sek. | ".$radixSort->getRuns()."\n";

    $data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "radixsort.json"));
    $data[] = [$arrayLength, $radixSort->getRuns()];
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "radixsort.json", json_encode($data));

    /**
     * Bucket Sort
     */

    $beginn = microtime(true);

    $bucketSort->sort($array);

    $dauer = microtime(true) - $beginn;
    echo "Dauer des Bucket Sort Algorithmus: $dauer Sek. | ".$bucketSort->getRuns()."\n";

    $data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "bucketsort.json"));
    $data[] = [$arrayLength, $bucketSort->getRuns()];
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "bucketsort.json", json_encode($data));

    /**
     * Quick Sort
     */

    $beginn = microtime(true);

    $quickSort->sort($array);

    $dauer = microtime(true) - $beginn;
    echo "Dauer des Quick Sort Algorithmus: $dauer Sek. | ".$quickSort->getRuns()." \n";

    $data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "quicksort.json"));
    $data[] = [$arrayLength, $quickSort->getRuns()];
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "quicksort.json", json_encode($data));

    if ($arrayLength <= 100000){


        /**
         * Insertion Sort
         */

        $beginn = microtime(true);

        $insertionSort->sort($array);

        $dauer = microtime(true) - $beginn;
        echo "Dauer des Insertion Sort Algorithmus: $dauer Sek. | ".$insertionSort->getRuns()." \n";

        $data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "insertionsort.json"));
        $data[] = [$arrayLength, $insertionSort->getRuns()];
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "insertionsort.json", json_encode($data));
    }
}

for ($i = 0; $i < 10000000; $i += 10000) {
    if ($i == 0) {
        $data = [[0, 0]];
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "radixsort.json", json_encode($data));
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "quicksort.json", json_encode($data));
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "insertionsort.json", json_encode($data));
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "bucketsort.json", json_encode($data));
    }else{
        run($i);
    }
}


?>