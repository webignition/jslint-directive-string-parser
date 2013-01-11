<?php

use webignition\JSLintDirective\JSLintDirective;

class HasOptionTest extends PHPUnit_Framework_TestCase  {
    
    public function testHasOptions() {
        $directive = new JSLintDirective();
        $directive->addOption('fragment', true);
        $directive->addOption('nomen', true);
        
        $this->assertTrue($directive->hasOption('fragment'));
        $this->assertTrue($directive->hasOption('nomen'));
        $this->assertFalse($directive->hasOption('eqeq'));
    } 
    
    
    public function testHasOptionsIsCaseInsensitive() {
        $directive = new JSLintDirective();
        $directive->addOption('fragment', true);
        
        $this->assertTrue($directive->hasOption('fragment'));
        $this->assertTrue($directive->hasOption('FRAGMENT'));
        $this->assertTrue($directive->hasOption('fragment'));
    }     
    
}