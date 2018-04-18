<?php

namespace App\Services\BonusHandlers;

use App\Models\Bonus;
use App\Contracts\BonusHandlerInterface;

/**
 * Class EveryOrder
 *
 * Бонус в каждый заказ
 * @package App\Services\BonusHandlers
 */
class EveryOrder implements BonusHandlerInterface
{

    /**
     * @var Bonus
     */
    private $bonus;

    /**
     * @param Bonus $bonus
     */
    public function __construct(Bonus $bonus)
    {
        $this->bonus = $bonus;
    }

    /**
     * Check that this bonus is available for given price
     *
     * @param float $price
     * @return bool
     */
    public function check($price)
    {
        return true;
    }

    /**
     * Calculate quantity ob applied bonuses for given price
     *
     * @param float $price
     * @return int
     */
    public function calculateQuantity($price)
    {
        return $this->bonus->applied_quantity;
    }
}
