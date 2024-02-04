<?php
// Algorithm quick sort
function quickSort(array $array){
    if(count($array) < 2){
        return $array;
    } else {
        $pivot = $array[0];
        $less = [];
        $greater = [];

        for($i = 1; $i < count($array); $i++){
            if($array[$i] <= $pivot) {
                $less[] = $array[$i];
            }

            if($array[$i] > $pivot) {
                $greater[] = $array[$i];
            }
        }

        return array_merge(quickSort($less), [$pivot] , quickSort($greater));
    }
}

$unsortedArray = [15, 3, 7, 11, 6, 18, 2, 13, 9, 20, 5, 1, 10, 17, 4, 12, 8, 14, 19, 16];
$sortedArray = quickSort($unsortedArray);
print_r($sortedArray);