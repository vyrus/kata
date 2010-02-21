<?php

    class Obj implements Obj_Interface {
        protected $_ctx;
        
        public function setContext(Obj_Context_Interface $ctx) {
            $this->_ctx = $ctx;
        }
        
        public function getContext() {
            return $this->_ctx;
        }
        
        public function method_1() {
            $_this = $this->getContext()->getThis();
            $_this->method_2();
        }
        
        public function method_2() {
            return true;
        }
    }
    
    interface Obj_Interface {
        public function setContext(Obj_Context_Interface $ctx);
        
        public function getContext();
                
        public function method_1();
        
        public function method_2();
    }
    
    class Obj_Mock implements Obj_Interface {
        public function setContext(Obj_Context_Interface $ctx) {
            $this->_ctx = $ctx;
        }
        
        public function getContext() {
            return $this->_ctx;
        }
        
        public function method_1() {
            $this->method_2();
        }
        
        public function method_2() {
            return true;
        }
    }
    
    interface Obj_Context_Interface {
        public function getThis();
    }
    
    class Obj_Context implements Obj_Context_Interface {
        protected $_this;
        
        public function setThis(Obj_Interface $obj) {
            $this->_this = $obj;
        }
        
        public function getThis() {
            return new $this->_this;
        }
    }
    
    $obj = new Obj();
    
    $mock = new Obj_Mock();
    
    $ctx = new Obj_Context();
    $ctx->setThis($mock);
    
    $obj->setContext($ctx);
    $obj->method_1();
    
?>