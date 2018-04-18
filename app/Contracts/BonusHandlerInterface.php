<?php

namespace App\Contracts;

interface BonusHandlerInterface
{
    /**
     * Check that this bonus is available for given price
     *
     * @param float $price
     * @return bool
     */
    public function check($price);

    /**
     * Calculate quantity ob applied bonuses for given price
     *
     * @param float $price
     * @return int
     */
    public function calculateQuantity($price);
}
