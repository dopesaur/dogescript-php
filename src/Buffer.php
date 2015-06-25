<?php namespace Doge;

class Buffer {
    
    protected $data;
    
    public function __construct ($data = []) {
        $this->data = $data;
    }
    
    public function append ($data) {
        $this->data[] = $data;
    }
    
    public function data () {
        return $this->data;
    }
    
    public function isEmpty () {
        return empty($this->data);
    }
    
    public function count () {
        return count($this->data);
    }
    
    public function clear () {
        $this->data = [];
    }
    
    public function get ($index) {
        if (!isset($this->data[$index])) {
            return;
        }
        
        return $this->data[$index];
    }
    
}