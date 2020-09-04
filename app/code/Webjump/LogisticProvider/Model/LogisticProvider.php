<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Model;

use Webjump\LogisticProvider\Api\Data\LogisticProviderInterface;
use Webjump\LogisticProvider\Model\ResourceModel\LogisticProviderResource;
use Magento\Framework\Model\AbstractModel;

/**
 * Class LogisticProvider
 *
 * @package Webjump\LogisticProvider\Model
 * @codeCoverageIgnore
 */
class LogisticProvider extends AbstractModel implements LogisticProviderInterface
{

    /**
     * Inherit construct
     */
    protected function _construct()
    {
        $this->_init(LogisticProviderResource::class);
    }

    /**
     * Set Intelipost ID
     *
     * @param string $intelipostId
     * @return void
     */
    public function setIntelipostId(string $intelipostId): void
    {
        $this->setData(self::COLUMN_NAME_INTELIPOST_ID, $intelipostId);
    }

    /**
     * Get Intelipost ID
     *
     * @return string
     */
    public function getIntelipostId(): string
    {
        return $this->getData(self::COLUMN_NAME_INTELIPOST_ID);
    }

    /**
     * Set SAP ID
     *
     * @param string $sapId
     * @return void
     */
    public function setSapId(string $sapId): void
    {
        $this->setData(self::COLUMN_NAME_SAP_ID, $sapId);
    }

    /**
     * Get SAP ID
     *
     * @return string
     */
    public function getSapId(): string
    {
        return $this->getData(self::COLUMN_NAME_SAP_ID);
    }

    /**
     * Set Provider Name
     *
     * @param string $providerName
     * @return void
     */
    public function setProviderName(string $providerName): void
    {
        $this->setData(self::COLUMN_NAME_PROVIDER_NAME, $providerName);
    }

    /**
     * Get Provider Name
     *
     * @return string
     */
    public function getProviderName(): string
    {
        return $this->getData(self::COLUMN_NAME_PROVIDER_NAME);
    }

    /**
     * Set Tracking URL
     *
     * @param string $trackingUrl
     * @return void
     */
    public function setTrackingUrl(string $trackingUrl): void
    {
        $this->setData(self::COLUMN_NAME_TRACKING_URL, $trackingUrl);
    }

    /**
     * Get Tracking URL
     *
     * @return string
     */
    public function getTrackingUrl(): string
    {
        return $this->getData(self::COLUMN_NAME_TRACKING_URL);
    }

    /**
     * Set Created At
     *
     * @param string $createdAt
     * @return void
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->setData(self::COLUMN_NAME_CREATED_AT, $createdAt);
    }

    /**
     * Get Created At
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::COLUMN_NAME_CREATED_AT);
    }
}
