<?php

class sorterClass
{
    const splitToken = ",";

    public function validate($val): bool
    {
        return preg_match('/^\d+(?:,-?\d+)+$/', $val);
    }

    public function sortAndEch($val)
    {
        $arrToSort = explode(self::splitToken, $val);
        $sortedArray = $this->mergeSort($arrToSort);

        echo implode(self::splitToken, $sortedArray);
    }

    private function mergeSort(array $arr): array
    {
        if (count($arr) == 1) return $arr;

        $mid = count($arr) / 2;
        $left = array_slice($arr, 0, $mid);
        $right = array_slice($arr, $mid);

        $left = self::mergeSort($left);
        $right = self::mergeSort($right);

        return self::merge($left, $right);
    }

    private function merge(array $left, $right): array
    {
        $res = array();

        while (count($left) > 0 && count($right) > 0) {
            if ($left[0] > $right[0]) {
                $res[] = $right[0];
                $right = array_slice($right, 1);
            } else {
                $res[] = $left[0];
                $left = array_slice($left, 1);
            }
        }

        while (count($left) > 0) {
            $res[] = $left[0];
            $left = array_slice($left, 1);
        }

        while (count($right) > 0) {
            $res[] = $right[0];
            $right = array_slice($right, 1);
        }

        return $res;
    }

}