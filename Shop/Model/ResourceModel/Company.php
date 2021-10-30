<?php
namespace TimKi\Shop\Model\ResourceModel;

use TimKi\Shop\Api\Data\CompanyInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Company
 * @package TimKi\Shop\Model\ResourceModel
 */
class Company extends AbstractDb
{
    /**
     * @var string
     */
    const TABLE_NAME = 'timki_company';

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct() //@codingStandardsIgnoreLine
    {
        $this->_init(self::TABLE_NAME, CompanyInterface::ID);
    }
}
