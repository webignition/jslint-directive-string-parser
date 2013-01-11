<?php

namespace webignition\JSLintDirective;

class JSLintDirective {
    
    
    /**
     * Collection of directive options that have been specified
     * 
     * @var array
     */
    private $options = array();
    
   
    /**
     * Collection of options that take integer values
     * 
     * @var array
     */
    private $integerOptionNames = array(
        'indent',
        'maxerr',
        'maxlen',
    );
    
    
    /**
     * Collection of options that take boolean values
     *
     * @var array
     */    
    private $booleanOptionNames = array(
        'anon',
        'bitwise',
        'browser',
        'cap',
        'continue',
        'css',
        'debug',
        'devel',
        'eqeq',
        'es5',
        'evil',
        'forin',
        'fragment',
        'newcap',
        'node',
        'nomen',
        'on',
        'passfail',
        'plusplus',
        'properties',
        'regexp',
        'rhino',
        'undef',
        'unparam',
        'sloppy',
        'stupid',
        'sub',
        'vars',
        'white',
        'widget',
        'windows'
    );
    
    
    /**
     * Collection of value option names
     * 
     * @var array
     */    
    private $validNames = array(
        'indent', // Number of spaces used for indentation, default is 4
        'maxerr', // The maximum number of warnings reported. (default is 50)
        'maxlen', // The maximum number of characters in a line.        
        'anon', // If the space may be omitted in anonymous function declarations
        'bitwise', // If bitwise operators should be allowed
        'browser', // If the standard browser globals should be predefined
        'cap', // If upper case HTML should be allowed
        'continue', // If the continue statement should be allowed
        'css', // If CSS workarounds should be tolerated
        'debug', // If debugger statements should be allowed. Set this option to false before going into production
        'devel', // If browser globals that are useful in development should be predefined
        'eqeq', // If the == and != operators should be tolerated
        'es5', // If ES5 syntax should be allowed. It is likely that programs using this option will produce syntax errors on ES3 systems
        'evil', // If eval should be allowed
        'forin', // If unfiltered for in statements should be allowed
        'fragment', // If HTML fragments should be allowed
        'newcap', // If Initial Caps with constructor functions is optional
        'node', // If Node.js globals should be predefined
        'nomen', // If names should not be checked for initial or trailing underbars.
        'on', // If HTML event handlers should be allowed
        'passfail', // If the scan should stop on first error
        'plusplus', // If ++ and -- should be allowed
        'properties', // If all property names must be declared with /*properties*/
        'regexp', //  If . and [^...] should be allowed in RegExp literals
        'rhino', // If the Rhino environment globals should be predefined
        'undef', // If variables and functions need not be declared before used. This is not available in strict mode
        'unparam', // If warnings should not be given for unused parameters
        'sloppy', // If the ES5 'use strict'; pragma is not required. Do not use this pragma unless you know what you are doing
        'stupid', // If blocking ('...Sync') methods can be used
        'sub', // If subscript notation may be used for expressions better expressed in dot notation
        'vars', // If multiple var statement per function should be allowed.
        'white', // If strict whitespace rules should be ignored
        'widget', // If the Yahoo Widgets globals should be predefined
        'windows', // If MS Windows-specific globals should be predefined
    );
    
        
    public function addOption($name, $value) {        
        $name = strtolower($name);
        
        if (!$this->isNameValid($name)) {
            return false;
        }
        
        if ($this->isBooleanOption($name)) {
            $this->options[$name] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        } elseif ($this->isIntegerOption($name)) {
            if ($name == 'indent') {
                $default = 4;
            } elseif ($name == 'maxerr') {
                $default = 50;
            } else {
                $default = 0;
            }
            
            $this->options[$name] = filter_var($value, FILTER_VALIDATE_INT, array('options' => array(
                'min_range' => 0,
                'default' => $default
            )));
        } else {
            return false;
        }        
        
        ksort($this->options);
        return true;
    }
    
    /**
     * 
     * @param string $name
     * @return boolean
     */
    public function hasOption($name) {
        return array_key_exists(strtolower($name), $this->options);
    }
    
    
    /**
     * 
     * @param string $name
     * @return mixed
     */
    public function getOption($name) {
        $name = strtolower($name);
        
        if (!$this->hasOption($name)) {
            return null;
        }
        
        return $this->options[$name];
    }
    
    /**
     * 
     * @return array
     */
    public function getOptions() {
        return $this->options;
    }
    
    
    /**
     * 
     * @param string $name
     * @return boolean
     */
    private function isNameValid($name) {
        return in_array($name, $this->validNames);
    }
    
    
    /**
     * 
     * @param string $name
     * @return boolean
     */
    private function isBooleanOption($name) {
        return in_array($name, $this->booleanOptionNames);        
    }
    
    /**
     * 
     * @param string $name
     * @return boolean
     */
    private function isIntegerOption($name) {
        return in_array($name, $this->integerOptionNames);        
    } 
    
    
    /**
     * 
     * @return string
     */
    public function __toString() {
        $optionValueStrings = array();
        $options = $this->getOptions();
        
        foreach ($options as $name => $value) {
            $optionValueStrings[] = $name.': '.$this->getStringValue($name, $value);
        }
        
        return '/*jslint '.  implode(', ', $optionValueStrings).' */';
    }
    
    
    /**
     * 
     * @param string $name
     * @param mixed $value
     * @return string
     */
    private function getStringValue($name, $value) {
        if ($this->isBooleanOption($name)) {
            return $value ? 'true' : 'false';            
        }
        
        if ($this->isIntegerOption($name)) {
            return (string)$value;
        }
        
        return $value;
    }
    
}