<?php
/**
 * Created by PhpStorm.
 * User: yezi
 * Date: 2017/4/6
 * Time: 下午6:23
 */

function Merge(&$arr, $left, $mid, $right)
{
    $i = $left;
    $j = $mid + 1;
    $k = 0;
    $temp = array();
    while ($i <= $mid && $j <= $right) {
        if ($arr[$i] <= $arr[$j]) $temp[$k++] = $arr[$i++]; else        $temp[$k++] = $arr[$j++];
    }
    while ($i <= $mid) $temp[$k++] = $arr[$i++];
    while ($j <= $right) $temp[$k++] = $arr[$j++];
    for ($i = $left, $j = 0; $i <= $right; $i++, $j++) $arr[$i] = $temp[$j];
}

function MergeSort(&$arr, $left, $right)
{
    if ($left < $right) {
        $mid = floor(($left + $right) / 2);
        MergeSort($arr, $left, $mid);
        MergeSort($arr, $mid + 1, $right);
        Merge($arr, $left, $mid, $right);
    }
}

