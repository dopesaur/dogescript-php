<?php namespace Doge;

class Statement {
    
    protected $token;
    protected $operands;
    
    public function __construct ($token = '', $operands = []) {
        $this->token = $token;
        $this->operands = $operands;
    }
    
    public function setToken ($token) {
        $this->token = $token;
    }
    
    public function addOperand ($operand) {
        $this->operands[] = $operand;
    }
    
    public function getToken () {
        return $this->token;
    }
    
    public function getOperands () {
        return $this->operands;
    }
    
    public function toArray () {
        $callback = function ($operand) {
            $isStatement = $operand instanceof Statement;
            
            return $isStatement ? $operand->toArray() : $operand;
        };
        
        return [$this->token, array_map($callback, $this->operands)];
    }
    
}