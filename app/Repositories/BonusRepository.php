<?php

namespace App\Repositories;

interface BonusRepository
{
    /**
     * Returns collection of bonuses
     * which available for domain with given id
     * 
     * @param $domainId
     * @return mixed
     */
    public function getAvailableForDomain($domainId);
}
