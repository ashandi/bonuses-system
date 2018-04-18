<?php

namespace App\Services;

use App\Models\Bonus;
use App\Models\Order;
use App\Repositories\BonusRepository;
use App\Contracts\BonusHandlerInterface;

/**
 * Class BonusManager
 *
 * На основании суммы товаров заказа со скидками определяет бонусы для этого заказа
 *
 * @package App\Services
 */
class BonusManager
{

    /**
     * @var BonusRepository
     */
    private $bonusRepository;

    /**
     * BonusManager constructor.
     * @param BonusRepository $bonusRepository
     */
    public function __construct(BonusRepository $bonusRepository)
    {
        $this->bonusRepository = $bonusRepository;
    }

    /**
     * Returns bonuses which applied for given order
     * @param Order $order
     * @param $domainId
     * @return mixed
     */
    public function getBonusesForOrder(Order $order, $domainId)
    {
        $availableBonuses = $this->bonusRepository->getAvailableForDomain($domainId);

        $appliedBonuses = [];
        foreach ($availableBonuses as $bonus) {
            $bonusHandler = $this->getBonusHandler($bonus);

            if(!empty($bonusHandler) && $bonusHandler->check($order->totalPrice)) {
                $bonus->quantity = $bonusHandler->calculateQuantity($order->totalPrice);
                $appliedBonuses[] = $bonus;
            }
        }

        return $appliedBonuses;
    }

    /**
     * Returns object of bonus handler
     *
     * PATTERN - Фабричный метод
     *
     * @param Bonus $bonus
     * @return BonusHandlerInterface
     */
    private function getBonusHandler(Bonus $bonus)
    {
        $bonusHandler = app('bonus.' . $bonus->type, ['bonus' => $bonus]);

        return $bonusHandler;
    }
}
