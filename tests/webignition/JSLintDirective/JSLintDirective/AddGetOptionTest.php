<?php

use webignition\JSLintDirective\JSLintDirective;

class AddGetOptionTest extends PHPUnit_Framework_TestCase  {
    
    public function testAddedIntegerOptionReturnsInteger() {
        $directive = new JSLintDirective();
        $directive->addOption('maxlen', 10);
        
        $this->assertTrue(is_int($directive->getOption('maxlen')));
        $this->assertEquals(10, $directive->getOption('maxlen'));
    }
    
    
    public function testAddedBooleanOptionReturnsBoolean() {
        $directive = new JSLintDirective();
        $directive->addOption('stupid', true);
        $directive->addOption('css', false);
        
        $this->assertTrue($directive->getOption('stupid'));
        $this->assertFalse($directive->getOption('css'));        
    }
    
    public function testGenericIntegerOptionDefaultsToZero() {
        $directive = new JSLintDirective();
        $directive->addOption('maxlen', -1);
        
        $this->assertTrue(is_int($directive->getOption('maxlen')));
        $this->assertEquals(0, $directive->getOption('maxlen'));        
    }
    
    public function testIndentOptionDefaultsTo4() {
        $directive = new JSLintDirective();
        $directive->addOption('indent', -1);
        
        $this->assertTrue(is_int($directive->getOption('indent')));
        $this->assertEquals(4, $directive->getOption('indent'));        
    }    
    
    public function testMaxErrOptionDefaultsTo50() {
        $directive = new JSLintDirective();
        $directive->addOption('maxerr', -1);
        
        $this->assertTrue(is_int($directive->getOption('maxerr')));
        $this->assertEquals(50, $directive->getOption('maxerr'));        
    }        
}