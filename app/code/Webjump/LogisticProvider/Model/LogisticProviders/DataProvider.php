<?php
/**
 * @author      Webjump Core Team <dev@webjump.com.br>
 * @copyright   2020 Webjump (http://www.webjump.com.br)
 * @license     http://www.webjump.com.br Copyright
 * @link        http://www.webjump.com.br
 */

declare(strict_types=1);

namespace Webjump\LogisticProvider\Model\LogisticProviders;

use Webjump\LogisticProvider\Model\LogisticProvider;
use Webjump\LogisticProvider\Model\ResourceModel\Collection\LogisticProviderCollection;
use Webjump\LogisticProvider\Model\ResourceModel\Collection\LogisticProviderCollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class DataProvider
 *
 * @package Webjump\Providers\Model\Providers
 */
class DataProvider extends AbstractDataProvider
{
    /** @var LogisticProviderCollection $collection */
    protected $collection;

    /** @var array $loadedData */
    private $loadedData = [];

    /**
     * DataProvider constructor.
     *
     * @param string                            $name
     * @param string                            $primaryFieldName
     * @param string                            $requestFieldName
     * @param LogisticProviderCollectionFactory $collectionFactory
     * @param array                             $meta
     * @param array                             $data
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        LogisticProviderCollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get Data
     *
     * @return array
     */
    public function getData(): array
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        /** @var LogisticProvider $provider */
        foreach ($items as $provider) {
            $this->loadedData[$provider->getId()] = $provider->getData();
        }

        return $this->loadedData;
    }
}
