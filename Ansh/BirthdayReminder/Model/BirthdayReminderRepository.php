<?php


namespace Ansh\BirthdayReminder\Model;

use Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterfaceFactory;
use Ansh\BirthdayReminder\Api\Data\BirthdayReminderSearchResultsInterfaceFactory;
use Magento\Framework\Reflection\DataObjectProcessor;
use Ansh\BirthdayReminder\Model\ResourceModel\BirthdayReminder as ResourceBirthdayReminder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Ansh\BirthdayReminder\Model\ResourceModel\BirthdayReminder\CollectionFactory as BirthdayReminderCollectionFactory;
use Ansh\BirthdayReminder\Api\BirthdayReminderRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class BirthdayReminderRepository implements BirthdayReminderRepositoryInterface
{
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var BirthdayReminderCollectionFactory
     */
    protected $birthdayReminderCollectionFactory;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var ResourceBirthdayReminder
     */
    protected $resource;

    /**
     * @var ExtensibleDataObjectConverter
     */
    protected $extensibleDataObjectConverter;

    /**
     * @var BirthdayReminderInterfaceFactory
     */
    protected $dataBirthdayReminderFactory;

    /**
     * @var BirthdayReminderSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var JoinProcessorInterface
     */
    protected $extensionAttributesJoinProcessor;

    /**
     * @var BirthdayReminderFactory
     */
    protected $birthdayReminderFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;


    /**
     * @param ResourceBirthdayReminder $resource
     * @param BirthdayReminderFactory $birthdayReminderFactory
     * @param BirthdayReminderInterfaceFactory $dataBirthdayReminderFactory
     * @param BirthdayReminderCollectionFactory $birthdayReminderCollectionFactory
     * @param BirthdayReminderSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceBirthdayReminder $resource,
        BirthdayReminderFactory $birthdayReminderFactory,
        BirthdayReminderInterfaceFactory $dataBirthdayReminderFactory,
        BirthdayReminderCollectionFactory $birthdayReminderCollectionFactory,
        BirthdayReminderSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->birthdayReminderFactory = $birthdayReminderFactory;
        $this->birthdayReminderCollectionFactory = $birthdayReminderCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataBirthdayReminderFactory = $dataBirthdayReminderFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface $birthdayReminder
    ) {
        /* if (empty($birthdayReminder->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $birthdayReminder->setStoreId($storeId);
        } */
        
        $birthdayReminderData = $this->extensibleDataObjectConverter->toNestedArray(
            $birthdayReminder,
            [],
            \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface::class
        );
        
        $birthdayReminderModel = $this->birthdayReminderFactory->create()->setData($birthdayReminderData);
        
        try {
            $this->resource->save($birthdayReminderModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the birthdayReminder: %1',
                $exception->getMessage()
            ));
        }
        return $birthdayReminderModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($birthdayReminderId)
    {
        $birthdayReminder = $this->birthdayReminderFactory->create();
        $this->resource->load($birthdayReminder, $birthdayReminderId);
        if (!$birthdayReminder->getId()) {
            throw new NoSuchEntityException(__('BirthdayReminder with id "%1" does not exist.', $birthdayReminderId));
        }
        return $birthdayReminder->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->birthdayReminderCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface $birthdayReminder
    ) {
        try {
            $birthdayReminderModel = $this->birthdayReminderFactory->create();
            $this->resource->load($birthdayReminderModel, $birthdayReminder->getBirthdayreminderId());
            $this->resource->delete($birthdayReminderModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the BirthdayReminder: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($birthdayReminderId)
    {
        return $this->delete($this->getById($birthdayReminderId));
    }
}
