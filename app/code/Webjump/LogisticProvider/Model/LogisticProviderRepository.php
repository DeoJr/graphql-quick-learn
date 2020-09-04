<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Model;

use Webjump\LogisticProvider\Api\Data\LogisticProviderInterface;
use Webjump\LogisticProvider\Api\Data\LogisticProviderInterfaceFactory;
use Webjump\LogisticProvider\Api\Data\SearchResultsInterface;
use Webjump\LogisticProvider\Api\LogisticProviderRepositoryInterface;
use Webjump\LogisticProvider\Model\ResourceModel\Collection\LogisticProviderCollection;
use Webjump\LogisticProvider\Model\ResourceModel\Collection\LogisticProviderCollectionFactory;
use Webjump\LogisticProvider\Model\ResourceModel\LogisticProviderResource;
use Exception;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class LogisticProviderRepository
 *
 * @package Webjump\LogisticProvider\Model
 */
class LogisticProviderRepository implements LogisticProviderRepositoryInterface
{
    /** @var LogisticProviderResource $logisticProviderResource */
    private $logisticProviderResource;

    /** @var LogisticProviderInterfaceFactory $logisticProviderInterfaceFactory */
    private $logisticProviderInterfaceFactory;

    /** @var LogisticProviderCollectionFactory $logisticProviderCollectionFactory */
    private $logisticProviderCollectionFactory;

    /** @var CollectionProcessorInterface $collectionProcessor */
    private $collectionProcessor;

    /**
     * LogisticProviderRepository constructor.
     *
     * @param LogisticProviderResource          $logisticProviderResource
     * @param LogisticProviderInterfaceFactory  $logisticProviderInterfaceFactory
     * @param LogisticProviderCollectionFactory $logisticProviderCollectionFactory
     * @param CollectionProcessorInterface      $collectionProcessor
     */
    public function __construct(
        LogisticProviderResource $logisticProviderResource,
        LogisticProviderInterfaceFactory $logisticProviderInterfaceFactory,
        LogisticProviderCollectionFactory $logisticProviderCollectionFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->logisticProviderResource = $logisticProviderResource;
        $this->logisticProviderInterfaceFactory = $logisticProviderInterfaceFactory;
        $this->logisticProviderCollectionFactory = $logisticProviderCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Get list
     *
     * @param SearchCriteriaInterface $criteria
     * @return LogisticProviderInterface
     */
    public function getList(): array
    {
        $collection = $this->logisticProviderCollectionFactory->create();
        $items = $collection->getItems();

        return $items;
    }

    /**
     * Save Provider.
     *
     * @param LogisticProviderInterface $logisticProvider
     * @return LogisticProviderInterface
     * @throws CouldNotSaveException
     */
    public function save(LogisticProviderInterface $logisticProvider): LogisticProviderInterface
    {
        try {
            $this->logisticProviderResource->save($logisticProvider);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $logisticProvider;
    }

    /**
     * Retrieve Provider.
     *
     * @param int $logisticProviderId
     * @return LogisticProviderInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $logisticProviderId)
    {
        /** @var LogisticProviderInterface $model */
        $logisticProvider = $this->logisticProviderInterfaceFactory->create();
        $this->logisticProviderResource->load($logisticProvider, $logisticProviderId);
        if (!$logisticProvider->getId()) {
            throw new NoSuchEntityException(__('The Provider with the "%1" ID doesn\'t exist.', $logisticProviderId));
        }
        return $logisticProvider;
    }

    /**
     * Retrieve Provider by Intelipost Id.
     *
     * @param int $intelipostId
     * @return LogisticProviderInterface
     * @throws NoSuchEntityException
     */
    public function getByIntelipostId(int $intelipostId): LogisticProviderInterface
    {
        /** @var LogisticProviderInterface $model */
        $logisticProvider = $this->logisticProviderInterfaceFactory->create();
        $this->logisticProviderResource->load(
            $logisticProvider,
            $intelipostId,
            LogisticProviderInterface::COLUMN_NAME_INTELIPOST_ID
        );
        if (!$logisticProvider->getId()) {
            throw new NoSuchEntityException(
                __('The Provider with the "%1" Intelipost ID doesn\'t exist.', $intelipostId)
            );
        }
        return $logisticProvider;
    }

    /**
     * Delete
     *
     * @param LogisticProviderInterface $logisticProvider
     * @return void
     * @throws Exception
     */
    public function delete(LogisticProviderInterface $logisticProvider)
    {
        $this->logisticProviderResource->delete($logisticProvider);
    }
}
