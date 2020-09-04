<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Api\Data;

/**
 * Class LogisticProviderInterface
 *
 * @package Webjump\LogisticProvider\Api\Data
 */
interface LogisticProviderInterface
{
    /** @var string COLUMN_NAME_INTELIPOST_ID */
    const COLUMN_NAME_INTELIPOST_ID = 'intelipost_id';

    /** @var string COLUMN_NAME_SAP_ID */
    const COLUMN_NAME_SAP_ID = 'sap_id';

    /** @var string COLUMN_NAME_PROVIDER_NAME */
    const COLUMN_NAME_PROVIDER_NAME = 'provider_name';

    /** @var string COLUMN_NAME_TRACKING_URL */
    const COLUMN_NAME_TRACKING_URL = 'tracking_url';

    /** @var string COLUMN_NAME_CREATED_AT */
    const COLUMN_NAME_CREATED_AT = 'created_at';

    /**
     * Set Intelipost ID
     *
     * @param string $intelipostId
     * @return void
     */
    public function setIntelipostId(string $intelipostId): void;

    /**
     * Get Intelipost ID
     *
     * @return string
     */
    public function getIntelipostId(): string;

    /**
     * Set SAP ID
     *
     * @param string $sapId
     * @return void
     */
    public function setSapId(string $sapId): void;

    /**
     * Get SAP ID
     *
     * @return string
     */
    public function getSapId(): string;

    /**
     * Set Provider Name
     *
     * @param string $providerName
     * @return void
     */
    public function setProviderName(string $providerName): void;

    /**
     * Get Provider Name
     *
     * @return string
     */
    public function getProviderName(): string;

    /**
     * Set Tracking URL
     *
     * @param string $trackingUrl
     * @return void
     */
    public function setTrackingUrl(string $trackingUrl): void;

    /**
     * Get Tracking URL
     *
     * @return string
     */
    public function getTrackingUrl(): string;

    /**
     * Set Created At
     *
     * @param string $createdAt
     * @return void
     */
    public function setCreatedAt(string $createdAt): void;

    /**
     * Get Created At
     *
     * @return string
     */
    public function getCreatedAt(): string;
}
