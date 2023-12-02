<?php

namespace App\Exceptions;

use Exception;

class QuantityException extends Exception
{
    protected $productTitle;
    protected $optionTitle;
    protected $optionValue;
    protected $remainingQuantity;

    public function __construct($productTitle, $optionTitle, $optionValue, $remainingQuantity)
    {
        $message = "{$productTitle} {$optionTitle}: {$optionValue} на складе недостаточно, остаток: {$remainingQuantity} ед.
        Уменьшите количество товара";
        parent::__construct($message);

        $this->productTitle = $productTitle;
        $this->optionTitle = $optionTitle;
        $this->optionValue = $optionValue;
        $this->remainingQuantity = $remainingQuantity;
    }

    public function getProductTitle()
    {
        return $this->productTitle;
    }

    public function getOptionTitle()
    {
        return $this->optionTitle;
    }

    public function getOptionValue()
    {
        return $this->optionValue;
    }

    public function getRemainingQuantity()
    {
        return $this->remainingQuantity;
    }
}
