<?php

  /**
   * 冒泡排序
   * 基本思路
   * 将被排序的记录数组R[1..n]垂直排列，
   * 每个记录R[i]看作是重量为R[i].key的气泡。
   * 根据轻气泡不能在重气泡之下的原则，
   * 从下往上扫描数组R：
   * 凡扫描到违反本原则的轻气泡，就使其向上"飘浮"。
   * 如此反复进行，
   * 直到最后任何两个气泡都是轻者在上，重者在下为止。
   * @param  array $value 待排序数组
   * @return array
   */
  function bubble($value = [])
  {
      $length = count($value) - 1;
      // 外循环
      for ($j = 0; $j < $length; ++$j) {
          // 内循环
          for ($i = 0; $i < $length; ++$i) {
              // 如果后一个值小于前一个值，则互换位置
              if ($value[$i + 1] < $value[$i]) {
                  $tmp = $value[$i + 1];
                  $value[$i + 1] = $value[$i];
                  $value[$i] = $tmp;
              }
          }
      }

      return $value;
  }

function bubbleSort(&$arr)
{
    $num = count($arr); //元素数据个数
    for($i = 0; $i < $num-1; ++$i)
    {
        for($j = 0; $j < $num-1-$i; ++$j)
        {
            if($arr[$j] > $arr[$j+1]) {  //如果前面的数大于后面的数，交换位置
                $temp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $temp;
            }
        }
    }
}

  /**
   * 优化冒泡排序
   *
   * @param  array $value 待排序数组
   * @return array
   */
  function bubble_better($value = [])
  {
    $flag   = true; // 标示 排序未完成
    $length = count($value)-1; // 数组长度
    $index  = $length; // 最后一次交换的索引位置 初始值为最后一位
    while ($flag) {
      $flag = false; // 假设排序已完成
      for ($i=0; $i < $index; $i++) {
        if ($value[$i] > $value[$i+1]) {
          $flag  = true; // 如果还有交换发生 则排序未完成
          $last  = $i; // 记录最后一次发生交换的索引位置
          $tmp   = $value[$i];
          $value[$i] = $value[$i+1];
          $value[$i+1] = $tmp;
        }
      }
      $index = $last;
    }

    return $value;
  }
