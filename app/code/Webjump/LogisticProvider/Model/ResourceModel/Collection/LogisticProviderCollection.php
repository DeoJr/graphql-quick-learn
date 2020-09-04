<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Model\ResourceModel\Collection;

use Webjump\LogisticProvider\Model\LogisticProvider;
use Webjump\LogisticProvider\Model\ResourceModel\LogisticProviderResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class LogisticProvidersCollection
 *
 * @package Webjump\Providers\Model\ResourceModel\Collection
 * @codeCoverageIgnore
 */
class LogisticProviderCollection extends AbstractCollection
{
    /**
     * Inherit construct
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(LogisticProvider::class, LogisticProviderResource::class);
    }
}
