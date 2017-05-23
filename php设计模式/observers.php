<?php
/**
 * 观察者模式
 */
 
 
class Paper{ /* 主题    */
    private $_observers = array();
 
    public function register($sub){ /*  注册观察者 */
        $this->_observers[] = $sub;
    }
 
     
    public function trigger(){  /*  外部统一访问    */
        if(!empty($this->_observers)){
            foreach($this->_observers as $observer){
                $observer->update();
            }
        }
    }
}
 
/**
 * 观察者要实现的接口
 */
interface Observerable{
    public function update();
}
 
class Subscriber implements Observerable{
    public function update(){
        echo "Callback\n";
    }
}
 


/*  测试    */
$paper = new Paper();
$paper->register(new Subscriber());
//$paper->register(new Subscriber1());
//$paper->register(new Subscriber2());
$paper->trigger();