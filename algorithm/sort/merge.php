<?php
/**
 * php算法实战.
 *
 * 排序算法-归并排序
 *
 * @author TIGERB <https://github.com/TIGERB>
 */

 /**
  * 合并两个有序数组为一个有序数组
  *
  * @param  array $value 待排序数组
  *
  * @return array
  */
  function merge_array($arr_1, $arr_2)
  {
    $length_1 = count($arr_1);
    $length_2 = count($arr_2);
    // 归并算法
    // arr_1[$i]和arr_2[$j]比较
    // <= 则 arr_3[$k] = arr_1[$i] 且 ++$i ++$k
    // >= 则 arr_3[$k] = arr_2[$j] 且 ++$j ++$k
    // 直到 $i >= $length_1 或 $j >= $length_2
    //
    // 接着，如果先$i >= $length_1
    // 则， $arr_2[$j~$length_2] 放到 $arr_3后
    // 如果先$j >= $length_2
    // 则， $arr_1[$i~$length_1] 放到 $arr_3后
    $arr_3 = [];
    $i = 0;
    $j = 0;
    $k = 0;
    while ($i < $length_1 && $j < $length_2) {
      if ($arr_1[$i] <= $arr_2[$j]) {
        $arr_3[$k] = $arr_1[$i];
        ++$i;
        ++$k;
        continue;
      }
      $arr_3[$k] = $arr_2[$j];
      ++$j;
      ++$k;
    }
    if ($i === $length_1) {
      for ($s=$j; $s < $length_2; $s++) {
        $arr_3[] = $arr_2[$s];
      }
    }
    if ($j === $length_2) {
      for ($w=$i; $w < $length_1; $w++) {
        $arr_3[$k] = $arr_1[$w];
        ++$k;
      }
    }
    return $arr_3;
  }

  /**
   * 归并排序.
   * 将序列每相邻的两个数字进行归并操作
   *
   * @param  array $value 待排序数组
   *
   * @return array
   */
  function merge(&$value=[])
  {
    $length = count($value);
    if ($length === 1) {
      return;
    }
    $arr = [];
    for ($i=0; $i < $length; $i++) {
      if ($i%2 === 0) {
        // 合并每两个元素
        // 判断值类型 integer 直接比大小 合并
        if (is_int($value[$i]) || is_string($value[$i])) {
          if (isset($value[$i+1])) {
            if ($value[$i] < $value[$i+1]) {
              $arr[floor($i/2)][] = $value[$i];
              $arr[floor($i/2)][] = $value[$i+1];
              continue;
            }
            $arr[floor($i/2)][] = $value[$i+1];
            $arr[floor($i/2)][] = $value[$i];
            continue;
          }
          $arr[floor($i/2)][] = $value[$i];
          continue;
        }
        // 判断值类型 array 遍历元素比大小 合并
        // 把两个有序数组合并成一个有序数组
        // 归并算法详情请看 merge-array
        if (is_array($value[$i])) {
          if (isset($value[$i+1])) {
            $length_arr = count($value[$i]);
            $length_arr_last = count($value[$i+1]);
            $arr_tmp = [];
            $s = 0;
            $w = 0;
            $k = 0;
            while ($s < $length_arr && $w < $length_arr_last) {
              if ($value[$i][$s] <= $value[$i+1][$w]) {
                $arr_tmp[$k] = $value[$i][$s];
                ++$s;
                ++$k;
                continue;
              }
              $arr_tmp[$k] = $value[$i+1][$w];
              ++$w;
              ++$k;
              continue;
            }
            if ($s === $length_arr) {
              for ($j=$w; $j < $length_arr_last; $j++) {
                $arr_tmp[$k] = $value[$i+1][$j];
                ++$k;
              }
            }
            unset($j);
            if ($w === $length_arr_last) {
              for ($j=$s; $j < $length_arr; $j++) {
                $arr_tmp[$k] = $value[$i][$j];
                ++$k;
              }
            }
            unset($j);
            $arr[floor($i/2)] = $arr_tmp;
            continue;
          }
          $arr[floor($i/2)] = $value[$i];
          continue;
        }
      }
    }
    $value = $arr;
    merge($value);

    return $value[0];



      //merge函数将指定的两个有序数组(arr1,arr2)合并并且排序
//我们可以找到第三个数组,然后依次从两个数组的开始取数据哪个数据小就先取哪个的,然后删除掉刚刚取过///的数据
      function al_merge($arrA,$arrB)
      {
          $arrC = array();
          while(count($arrA) && count($arrB)){
              //这里不断的判断哪个值小,就将小的值给到arrC,但是到最后肯定要剩下几个值,
              //不是剩下arrA里面的就是剩下arrB里面的而且这几个有序的值,肯定比arrC里面所有的值都大所以使用
              $arrC[] = $arrA['0'] < $arrB['0'] ? array_shift($arrA) : array_shift($arrB);
          }
          return array_merge($arrC, $arrA, $arrB);
      }
//归并排序主程序
      function al_merge_sort($arr){
          $len = count($arr);
          if($len <= 1)
              return $arr;//递归结束条件,到达这步的时候,数组就只剩下一个元素了,也就是分离了数组
          $mid = intval($len/2);//取数组中间
          $left_arr = array_slice($arr, 0, $mid);//拆分数组0-mid这部分给左边left_arr
          $right_arr = array_slice($arr, $mid);//拆分数组mid-末尾这部分给右边right_arr
          $left_arr = al_merge_sort($left_arr);//左边拆分完后开始递归合并往上走
          $right_arr = al_merge_sort($right_arr);//右边拆分完毕开始递归往上走
          $arr = al_merge($left_arr, $right_arr);//合并两个数组,继续递归
          return $arr;
      }
      $arr = array(12, 5, 4, 7, 8, 3, 4, 2, 6, 4, 9);
      print_r(al_merge_sort($arr));
  }
