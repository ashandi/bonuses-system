<?php

namespace App\Services\BonusHandlers;

use App\Models\Bonus;
use App\Contracts\BonusHandlerInterface;

/**
 * Class ReachedPrice
 *
 * Бонусы, которые назначаются при достижении определенной суммы
 *
 * @package App\Services\BonusHandlers
 */
class ReachedPrice implements BonusHandlerInterface
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
        return $price >= $this->bonus->condition_value;
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
