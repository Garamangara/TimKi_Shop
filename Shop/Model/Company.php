<?php
namespace TimKi\Shop\Model;

use TimKi\Shop\Api\Data\CompanyInterface;
use TimKi\Shop\Model\ResourceModel\Company as CompanyResource;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Company
 * @package TimKi\Shop\Model
 */
class Company extends AbstractModel implements CompanyInterface
{
    /**
     * @var string
     */
    protected $_idFieldName = CompanyInterface::ID; //@codingStandardsIgnoreLine

    /**
     * @inheritdoc
     */
    protected function _construct() //@codingStandardsIgnoreLine
    {
        $this->_init(CompanyResource::class);
    }

    /**
     * @return int
     */
    public function getDescription()
    {
        return $this->getData(CompanyInterface::DESCRIPTION);
    }

    /**
     * @param int $authorId
     * @return $this
     */
    public function setDescription(string $description)
    {
        $this->setData(CompanyInterface::DESCRIPTION, $description);
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(CompanyInterface::TITLE);
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->setData(CompanyInterface::TITLE, $title);
        return $this;
    }

}
