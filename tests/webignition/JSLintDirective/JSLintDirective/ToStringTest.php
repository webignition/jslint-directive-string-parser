<?php

use webignition\JSLintDirective\JSLintDirective;

class ToStringTest extends PHPUnit_Framework_TestCase  {
    
    public function testStringifyBooleanOptions() {
        $directive = new JSLintDirective();
        $directive->addOption('fragment', true);
        $directive->addOption('nomen', false);
        
        $this->assertEquals('/*jslint fragment: true, nomen: false */', (string)$directive);
    }  
    
    public function testStringifyIntegerOptions() {
        $directive = new JSLintDirective();
        $directive->addOption('maxlen', 12);
        $directive->addOption('indent', 77);
        
        $this->assertEquals('/*jslint indent: 77, maxlen: 12 */', (string)$directive);
    }     
    
    
    public function testStringifyMixedOptions() {
        $directive = new JSLintDirective();
        $directive->addOption('maxlen', 12);
        $directive->addOption('fragment', true);
        $directive->addOption('indent', 77);
        $directive->addOption('nomen', false);
        
        $this->assertEquals('/*jslint fragment: true, indent: 77, maxlen: 12, nomen: false */', (string)$directive);
    }    
    
}