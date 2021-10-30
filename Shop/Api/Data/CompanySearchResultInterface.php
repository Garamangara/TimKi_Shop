<?php
namespace TimKi\Shop\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface CompanySearchResultInterface
 * @package TimKi\Shop\Api\Data
 */
interface CompanySearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \TimKi\Shop\Api\Data\CompanyInterface[]
     */
    public function getItems();

    /**
     * @param \TimKi\Shop\Api\Data\CompanyInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
