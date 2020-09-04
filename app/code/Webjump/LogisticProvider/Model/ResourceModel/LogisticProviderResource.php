<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class LogisticProviderResource
 *
 * @package Webjump\LogisticProvider\Model\ResourceModel
 * @codeCoverageIgnore
 */
class LogisticProviderResource extends AbstractDb
{

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('logistic_provider', 'id');
    }
}
