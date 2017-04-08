<?php
$data = array(4,6,7,8,14,55,67,145,218,237,284);

$num = binarysearch(4);
var_dump($num);
function binarysearch($num){
	global $data;
	$count = count($data);
	$high = $count-1;
	$low = 0;
	
	while ($high >= $low){
		$mid  = floor(($high+$low)/2);
		if($num == $data[$mid]){
			return $mid;
		}elseif($num > $data[$mid]){
			$low = $mid + 1;
		}elseif($num < $data[$mid]){
			$high = $mid - 1;
		}
	}
	return false;
}

function binaryRecursive(&$arr,$low,$top,$target){
    if($low<=$top){
        $mid = floor(($low+$top)/2);
        if($arr[$mid]==$target){
            return $mid;
        }elseif($arr[$mid]<$target){
            return binaryRecursive($arr,$mid+1,$top,$target);
        }else{
            return binaryRecursive($arr,$low,$mid-1,$target);
        }
    }else{
        return false;
    }
}
$arr = array(1,3,9,23,54);
echo binaryRecursive($arr, 0, sizeof($arr), 9);

?>