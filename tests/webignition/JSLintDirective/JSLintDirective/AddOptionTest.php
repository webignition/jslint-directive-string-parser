<?php

use webignition\JSLintDirective\JSLintDirective;

class AddOptionTest extends PHPUnit_Framework_TestCase  {
    
    public function testAddValidOption() {
        $directive = new JSLintDirective();
        $this->assertTrue($directive->addOption('evil', true));
    }
    
    public function testAddInvalidOption() {
        $directive = new JSLintDirective();
        $this->assertFalse($directive->addOption('nonsense', true));
    }
    
    public function testOptionKeysAreSorted() {
        $directive = new JSLintDirective();
        $this->assertTrue($directive->addOption('evil', true));        
        $this->assertTrue($directive->addOption('anon', true));
        $this->assertTrue($directive->addOption('nomen', true));
        
        $this->assertEquals(array(
            'anon' => true,
            'evil' => true,
            'nomen' => true,
        ), $directive->getOptions());
    }
    
}