<?php
namespace TimKi\Shop\Model;

use TimKi\Shop\Api\Data\CompanyInterface;
use TimKi\Shop\Api\Data\CompanySearchResultInterface;
use TimKi\Shop\Api\Data\CompanySearchResultInterfaceFactory;
use TimKi\Shop\Api\CompanyRepositoryInterface;
use TimKi\Shop\Model\ResourceModel\Company as CompanyResource;
use TimKi\Shop\Model\ResourceModel\Company\Collection as CompanyCollection;
use TimKi\Shop\Model\ResourceModel\Company\CollectionFactory as CompanyCollectionFactory;
use TimKi\Shop\Model\CompanyFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\DataObject;

/**
 * Class CompanyRepository
 * @package TimKi\Shop\Model
 */
class CompanyRepository implements CompanyRepositoryInterface
{
    /**
     * @var array
     */
    private $registry = [];

    /**
     * @var CompanyResource
     */
    private $CompanyResource;

    /**
     * @var CompanyFactory
     */
    private $CompanyFactory;

    /**
     * @var CompanyCollectionFactory
     */
    private $CompanyCollectionFactory;

    /**
     * @var CompanySearchResultInterfaceFactory
     */
    private $CompanySearchResultFactory;

    /**
     * @param CompanyResource $CompanyResource
     * @param CompanyFactory $CompanyFactory
     * @param CompanyCollectionFactory $CompanyCollectionFactory
     * @param CompanySearchResultInterfaceFactory $CompanySearchResultFactory
     */
    public function __construct(
        CompanyResource $CompanyResource,
        CompanyFactory $CompanyFactory,
        CompanyCollectionFactory $CompanyCollectionFactory,
        DataObject $dataObject,
        CompanySearchResultInterfaceFactory $CompanySearchResultFactory
    ) {
        $this->CompanyResource = $CompanyResource;
        $this->CompanyFactory = $CompanyFactory;
        $this->CompanyCollectionFactory = $CompanyCollectionFactory;
        $this->dataObject = $dataObject;
        $this->CompanySearchResultFactory = $CompanySearchResultFactory;
    }

    /**
     * @param int $id
     * @return CompanyInterface
     * @throws NoSuchEntityException
     */
    public function get(int $id)
    {
        if (!array_key_exists($id, $this->registry)) {
            $Company = $this->CompanyFactory->create();
            $this->CompanyResource->load($Company, $id);
            if (!$Company->getId()) {
                throw new NoSuchEntityException(__('Requested Company does not exist'));
            }
            $this->registry[$id] = $Company;
        }

        return $this->registry[$id];
    }

    /**
     * @return CompanySearchResultInterface
     */
    public function getAllCompanies()
    {
//        $companyCollection = $this->CompanyCollectionFactory->create();
//        $companies = [];
//        foreach ($companyCollection->getItems() as $company) {
//            $companies[] = $company;
//        }
////        $Company = $this->CompanyFactory->create();
////        $this->CompanyResource->load($Company, $id);
////        if (!$Company->getId()) {
////            throw new NoSuchEntityException(__('Requested Company does not exist'));
////        }
////        $this->registry[$id] = $Company;
//
//        return $this->dataObject->setData($companies);

        /** @var CompanyCollection $collection */
        $collection = $this->CompanyCollectionFactory->create();
//        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
//            foreach ($filterGroup->getFilters() as $filter) {
//                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
//                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
//            }
//        }

        /** @var CompanySearchResultInterface $searchResult */
        $searchResult = $this->CompanySearchResultFactory->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        return $searchResult;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \TimKi\Shop\Api\Data\CompanySearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var CompanyCollection $collection */
        $collection = $this->CompanyCollectionFactory->create();
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }

        /** @var CompanySearchResultInterface $searchResult */
        $searchResult = $this->CompanySearchResultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        return $searchResult;
    }

    /**
     * @param \TimKi\Shop\Api\Data\CompanyInterface $Company
     * @return CompanyInterface
     * @throws StateException
     */
    public function save(CompanyInterface $Company)
    {
        try {
            /** @var Company $Company */
            $this->CompanyResource->save($Company);
            $this->registry[$Company->getId()] = $this->get($Company->getId());
        } catch (\Exception $exception) {
            throw new StateException(__('Unable to save Company #%1', $Company->getId()));
        }
        return $this->registry[$Company->getId()];
    }

    /**
     * @param \TimKi\Shop\Api\Data\CompanyInterface $Company
     * @return bool
     * @throws StateException
     */
    public function delete(CompanyInterface $Company)
    {
        try {
            /** @var Company $Company */
            $this->CompanyResource->delete($Company);
            unset($this->registry[$Company->getId()]);
        } catch (\Exception $e) {
            throw new StateException(__('Unable to remove Company #%1', $Company->getId()));
        }

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id)
    {
        return $this->delete($this->get($id));
    }
}
