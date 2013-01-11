<?php

namespace webignition\JSLintDirective;

class Parser {
    
    const DIRECTIVE_START_TOKEN = '/*jslint';
    
    /**
     *
     * @var boolean
     */
    private $isExpectingLabelToken = false;
    
    /**
     *
     * @var boolean
     */
    private $isExpectingValueToken = false;
    
    
    /**
     *
     * @var string
     */
    private $currentToken = null;
    
    
    /**
     *
     * @var string
     */
    private $currentLabel = null;
    
    
    
    
    public function parse($jsLintDirectiveString) {
        $tokens = explode(' ', trim($jsLintDirectiveString));
        $tokenCount = count($tokens);
        if ($tokenCount === 0) {
            return false;
        }
        
        if (!$this->isDirectiveStartToken($tokens[0])) {
            return false;
        } 
        
        $jsLintDirective = new JSLintDirective();
        
        for ($tokenIndex = 1; $tokenIndex < $tokenCount - 1; $tokenIndex++) {
            $this->isExpectingLabelToken = $tokenIndex % 2 == 1;
            $this->isExpectingValueToken = !$this->isExpectingLabelToken;
            $this->currentToken = $tokens[$tokenIndex];
            
            if (!$this->isCurrentTokenValid()) {
                return $jsLintDirective;
            }
            
            if ($this->isExpectingLabelToken) {
                $this->currentLabel = substr($tokens[$tokenIndex], 0, strlen($tokens[$tokenIndex]) - 1);
            }
            
            if ($this->isExpectingValueToken) {
                if (!$this->hasCurrentLabel()) {
                    return $jsLintDirective;
                }

                $jsLintDirective->addOption($this->currentLabel, str_replace(',', '', $this->currentToken));
            }
        }
        
        return $jsLintDirective;
    }
    
    
    /**
     * 
     * @return boolean
     */
    private function hasCurrentLabel() {
        return !is_null($this->currentLabel);
    }
    
    
    /**
     * 
     * @return boolean
     */
    private function isCurrentTokenValid() {        
        if ($this->isExpectingLabelToken && !$this->isCurrentTokenLabel()) {
            return false;
        }
        
        if ($this->isExpectingValueToken && !$this->isCurrentTokenValue()) {
            return false;
        }
        
        return true;
    }
    
    
    /**
     * 
     * @param string $token
     * @return boolean
     */
    private function isDirectiveStartToken($token) {
        return $token == self::DIRECTIVE_START_TOKEN;
    }
    
    
    /**
     * 
     * @return boolean
     */
    private function isCurrentTokenLabel() {
        return preg_match('/^[a-zA-z0-9]+:$/', $this->currentToken) > 0;
    }
    
    
    /**
     * 
     * @return boolean
     */
    private function isCurrentTokenValue() {
        return preg_match('/^[a-zA-z0-9]+,?/', $this->currentToken) > 0;
    }
    
    
/*jslint bitwise: true, continue: true, debug: true, eqeq: true, es5: true, evil: true, forin: true, newcap: true, nomen: true, plusplus: true, regexp: true, undef: true, unparam: true, sloppy: true, stupid: true, sub: true, todo: true, vars: true, white: true, css: true, on: true, fragment: true, passfail: true, browser: true, devel: true, node: true, rhino: true, windows: true, safe: true, adsafe: true, indent: 10, maxerr: 12, maxlen: 11 */    
    
    
}