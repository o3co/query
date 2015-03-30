<?php
namespace O3Co\Query\Query\Expr;

class Constant 
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}

