<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Api;

use Webjump\LogisticProvider\Api\Data\LogisticProviderInterface;
use Webjump\LogisticProvider\Api\Data\SearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface LogisticProvidersInterface
 *
 * @package Webjump\Providers\Api
 */
interface LogisticProviderRepositoryInterface
{
    /**
     * Save Provider.
     *
     * @param LogisticProviderInterface $logisticProviders
     * @return LogisticProviderInterface
     */
    public function save(LogisticProviderInterface $logisticProviders): LogisticProviderInterface;

    /**
     * Retrieve Provider.
     *
     * @param int $logisticProvidersId
     * @return LogisticProviderInterface
     */
    public function getById(int $logisticProvidersId);

    /**
     * Retrieve Provider by Intelipost Id.
     *
     * @param int $intelipostId
     * @return LogisticProviderInterface
     * @throws NoSuchEntityException
     */
    public function getByIntelipostId(int $intelipostId): LogisticProviderInterface;

    /**
     * Delete
     *
     * @param LogisticProviderInterface $logisticProvider
     * @return void
     */
    public function delete(LogisticProviderInterface $logisticProvider);
}
