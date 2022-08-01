<?php

namespace Bj\Test;

class Math {
    protected $currentAction = null;
    protected $inputValue = 0;
    protected $total = 0;
    protected $nextAction = null;

    /**
     * Define Calculation Formular
     */
    protected $matchingFormular = [
        '' => '$this->total = $this->inputValue;',
        'add' => '$this->total += $this->inputValue;',
        'sub' => '$this->total -= $this->inputValue;',
        'multiply' => '$this->total *= $this->inputValue;',
        'divide' => '$this->total /= $this->inputValue;',
        'pow' => '$this->total = pow($this->total,$this->inputValue);'
    ];

    /**
     * Get Command line Input
     */
    protected function getInput() {
        $handle     = fopen ("php://stdin","r");
        $input      = fgets($handle);
        return $input;
    }

    /**
     * Set $currentAction and $inputValue
     */
    protected function setActionAndValue($input) {
        $exploded   = explode(' ', trim($input));
        if(count($exploded) == 2) {
            list($this->currentAction, $this->inputValue) = $exploded;
        } else {
            $this->printError();
        }
    }

    /**
     * Check $currentAction is valid or not
     * Thrown error if not valid
     * Calculate if valid
     */
    protected function calculate() {
        if(empty($this->matchingFormular[$this->currentAction]) && $this->currentAction != 'apply') {
            $this->printError();
        } else {
            $equation = $this->matchingFormular[$this->nextAction];
            eval($equation);
            $this->nextAction = $this->currentAction;
        }
    }

    /**
     * Throw error
     */
    protected function printError() {
        $arrayKeys = array_keys($this->matchingFormular);
        $methodsString = implode(', ', $arrayKeys);
        echo "not available action [ please enter $methodsString ]. ( eg. add 2 )\n";
    }

    /**
     * run init
     */
    public function init($params = null) {
        do {
            if($params) {
                $exploded = explode("\n", trim($params));
                foreach($exploded as $input) {
                    $this->setActionAndValue($input);  
                    $this->calculate();
                }
            } else {
                $input = $this->getInput();
                $this->setActionAndValue($input);
                $this->calculate();
            }
        } while ($this->currentAction != 'apply');
        echo $this->total;
        return $this->total;
    }
}