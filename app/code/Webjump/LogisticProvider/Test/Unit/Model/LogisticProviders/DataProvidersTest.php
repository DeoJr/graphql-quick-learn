<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Test\Unit\Model\LogisticProviders;

use Webjump\LogisticProvider\Api\Data\LogisticProviderInterfaceFactory;
use Webjump\LogisticProvider\Model\LogisticProvider;
use Webjump\LogisticProvider\Model\LogisticProviderRepository;
use Webjump\LogisticProvider\Model\LogisticProviders\DataProvider;
use Webjump\LogisticProvider\Model\ResourceModel\Collection\LogisticProviderCollection;
use Webjump\LogisticProvider\Model\ResourceModel\Collection\LogisticProviderCollectionFactory;
use Webjump\LogisticProvider\Model\ResourceModel\LogisticProviderResource;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class DataProviders
 *
 * @package Webjump\LogisticProvider\Test\Unit\Model\LogisticProviders
 */
class DataProvidersTest extends TestCase
{

    /** @var DataProvider $instance */
    private $instance;

    /** @var MockObject|LogisticProviderCollectionFactory $logisticProviderCollectionFactory */
    private $logisticProviderCollectionFactory;

    /**
     * Set up test
     *
     * @return void
     */
    protected function setUp()
    {
        $this->getMocks();
        $this->instance();
    }

    /**
     * Get Mocks for tests
     *
     * @return void
     */
    private function getMocks()
    {
        $this->logisticProviderCollectionFactory =
            $this->getMockBuilder(LogisticProviderCollectionFactory::class)
                ->disableOriginalConstructor()
                ->setMethods(['create'])
                ->getMock();

        $logisticProviderCollection = $this->getMockBuilder(LogisticProviderCollection::class)
            ->disableOriginalConstructor()
            ->setMethods(['getItems'])
            ->getMock();

        $logisticProvider = $this->getMockBuilder(LogisticProvider::class)
            ->disableOriginalConstructor()
            ->setMethods(['getId', 'getData'])
            ->getMock();

        $logisticProvider->expects($this->once())
            ->method('getId')
            ->willReturn(10);

        $logisticProvider->expects($this->once())
            ->method('getData')
            ->willReturn(['test' => 'test']);

        $logisticProviderCollection->expects($this->once())
            ->method('getItems')
            ->willReturn([$logisticProvider]);

        $this->logisticProviderCollectionFactory->expects($this->once())
            ->method('create')
            ->willReturn($logisticProviderCollection);
    }

    /**
     * Set Instance Test
     *
     * @return void
     */
    private function instance()
    {
        $this->instance = new DataProvider(
            'data_source',
            'id',
            'id',
            $this->logisticProviderCollectionFactory
        );
    }

    public function testGetData()
    {
        $this->instance->getData();
    }
}
