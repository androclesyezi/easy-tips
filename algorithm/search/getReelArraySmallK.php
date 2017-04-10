<?php
/**
 * 找到轮转后的有序数组中第K小的数
对于普通的有序数组来说，这个问题是非常简单的，因为数组中的第K-1个数（即A[K-1]）就是所要找的数，时间复杂度是O(1)常量。但是对于轮转后的有序数组，在不知道轮转的偏移位置，我们就没有办法快速定位第K个数了。
不过我们还是可以通过二分查找法，在log(n)的时间内找到最小数的在数组中的位置，然后通过偏移来快速定位任意第K个数。当然此处还是假设数组中没有相同的数，原排列顺序是递增排列。
在轮转后的有序数组中查找最小数的算法如下：
 */


//return the index of the min value in the Rotated Sorted Array, whose range is [low, high]
function  findIndexOfMinVaule($array, $low, $high)
{
    if ($low > $high) return -1;
    while ($low < $high) {
        $mid = floor(($low + $high)/2);
        if ($array[$mid] > $array[$high]){
            $low = $mid +1;
        }else{
            $high = $mid;
        }
    }

    //at this point, low is equal to high
    return $low;
}
//接着基于此结果进行偏移，再基于数组长度对偏移后的值取模，就可以找到第K个数在数组中的位置了：
function findKthElement($array, $k)
{
    $m=count($array);
    if ($k > $m) return -1;
    $base = findIndexOfMinVaule($array, 0, $m-1);
    $index = ($base+$k-1)%$m;
    return $index;
}

$array=[4,5,6,7,8,9,1,2,3];

echo findKthElement($array,2); //7