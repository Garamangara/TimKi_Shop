<?php
namespace TimKi\Shop\Model\ResourceModel\Company;

use TimKi\Shop\Model\Company;
use TimKi\Shop\Model\ResourceModel\Company as CompanyResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package TimKi\Shop\Model\ResourceModel\Company
 */
class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected function _construct() //@codingStandardsIgnoreLine
    {
        $this->_init(Company::class, CompanyResource::class);
    }
}
