<?php

namespace TimKi\Shop\Api;

use TimKi\Shop\Api\Data\CompanyInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface CompanyRepositoryInterface
 * @package AlexPoletaev\Api
 * @api
 */
interface CompanyRepositoryInterface
{
    /**
     * @param int $id
     * @return \TimKi\Shop\Api\Data\CompanyInterface
     */
    public function get(int $id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \TimKi\Shop\Api\Data\CompanySearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param \TimKi\Shop\Api\Data\CompanyInterface $Company
     * @return \TimKi\Shop\Api\Data\CompanyInterface
     */
    public function save(CompanyInterface $Company);

    /**
     * @param \TimKi\Shop\Api\Data\CompanyInterface $Company
     * @return bool
     */
    public function delete(CompanyInterface $Company);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id);
}
