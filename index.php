<?php

    class Closure {
        protected $_callback;
        
        protected $_args = array();
        
        public function setCallback($callback) {
            $this->_callback = $callback;
        }
        
        public function addArgument($value) {
            $this->_args[] = $value;
        }
        
        public function call() {
            $args = func_get_args();
            $args = array_merge($this->_args, $args);
            return call_user_func_array($this->_callback, $args);
        }
    }
    
    function sum($a, $b, $c) {
        return $a + $b + $c;
    }
    
    $closure = new Closure();
    $closure->setCallback('sum');
    $closure->addArgument(10);
    
    echo $closure->call(2, 5);
    
?>