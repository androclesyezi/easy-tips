<?php

//使对象可以像数组一样进行foreach循环，要求属性必须是私有。(Iterator模式的PHP5实现，写一类实现Iterator接口)（腾讯）

class Test implements Iterator{
    private $item = array('id'=>1,'name'=>'php');

    public function rewind(){
        reset($this->item);
    }

    public function current(){
        return current($this->item);
    }

    public function key(){
        return key($this->item);
    }

    public function next(){
        return next($this->item);
    }

    public function valid(){
        return($this->current()!==false);
    }
}
//测试
$t=new Test;
foreach($t as $k=>$v){
    echo$k,'--->',$v,'<br/>';
}
?>