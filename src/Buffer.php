<?php namespace Doge;

/**
 * Base class for buffer
 * 
 * @package dogescript-php
 */
class Buffer {
    
    /**
     * @var array
     */
    protected $data;
    
    /**
     * @param array $data
     */
    public function __construct ($data = []) {
        $this->data = $data;
    }
    
    /**
     * Append given data to the end of data list
     * 
     * @param mixed $data
     */
    public function append ($data) {
        $this->data[] = $data;
    }
    
    /**
     * Return contained data in the buffer
     * 
     * @return array
     */
    public function data () {
        return $this->data;
    }
    
    /**
     * @return bool
     */
    public function isEmpty () {
        return empty($this->data);
    }
    
    /**
     * @return int
     */
    public function count () {
        return count($this->data);
    }
    
    /**
     * Clear the data inside of buffer
     */
    public function clear () {
        $this->data = [];
    }
    
    /**
     * Get item specified by given index
     * 
     * @param string|int $index
     * @return mixed
     */
    public function get ($index) {
        if (!isset($this->data[$index])) {
            return;
        }
        
        return $this->data[$index];
    }
    
}