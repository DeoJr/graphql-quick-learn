<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Test\Unit\Model;

use Webjump\LogisticProvider\Api\Data\LogisticProviderInterface;
use Webjump\LogisticProvider\Api\Data\LogisticProviderInterfaceFactory;
use Webjump\LogisticProvider\Model\LogisticProvider;
use Webjump\LogisticProvider\Model\LogisticProviderRepository;
use Webjump\LogisticProvider\Model\ResourceModel\Collection\LogisticProviderCollectionFactory;
use Webjump\LogisticProvider\Model\ResourceModel\LogisticProviderResource;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class LogisticProviderRepositoryTest
 *
 * @package Webjump\LogisticProvider\Test\Unit\Model
 */

class LogisticProviderRepositoryTest extends TestCase
{

    /** @var LogisticProviderRepository $instance */
    private $instance;

    /** @var MockObject|LogisticProviderResource $logisticProviderResource */
    private $logisticProviderResource;

    /** @var MockObject|LogisticProviderInterfaceFactory $logisticProviderInterfaceFactory */
    private $logisticProviderInterfaceFactory;

    /** @var MockObject|LogisticProviderCollectionFactory $logisticProviderCollectionFactory */
    private $logisticProviderCollectionFactory;

    /** @var MockObject|CollectionProcessorInterface $collectionProcessorInterface */
    private $collectionProcessorInterface;

    /** @var LogisticProvider|MockObject  $logisticProviderInterface*/
    private $logisticProviderInterface;
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
        $this->logisticProviderResource = $this->getMockBuilder(LogisticProviderResource::class)
            ->disableOriginalConstructor()
            ->setMethods(['save', 'load'])
            ->getMock();

        $this->logisticProviderInterfaceFactory =
            $this->getMockBuilder(LogisticProviderInterfaceFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMock();

        $this->logisticProviderCollectionFactory =
            $this->getMockBuilder(LogisticProviderCollectionFactory::class)
                ->disableOriginalConstructor()
                ->setMethods(['create'])
                ->getMock();

        $this->collectionProcessorInterface =
            $this->getMockBuilder(CollectionProcessorInterface::class)
                ->disableOriginalConstructor()
                ->setMethods(['process'])
                ->getMock();

        $this->logisticProviderInterface = $this->getMockBuilder(LogisticProvider::class)
            ->disableOriginalConstructor()
            ->setMethods(['getId'])
            ->getMock();
    }

    /**
     * Set Instance Test
     *
     * @return void
     */
    private function instance()
    {
        $this->instance = new LogisticProviderRepository(
            $this->logisticProviderResource,
            $this->logisticProviderInterfaceFactory,
            $this->logisticProviderCollectionFactory,
            $this->collectionProcessorInterface
        );
    }

    /**
     * Execute testSave()
     *
     * @return void
     * @throws CouldNotSaveException
     */
    public function testSave()
    {

        $logisticProviderInterface = $this->getMockBuilder(LogisticProvider::class)
            ->disableOriginalConstructor()
            ->getMock();

        $result = $this->instance->save($logisticProviderInterface);
        $this->assertInstanceOf(LogisticProviderInterface::class, $result);
    }

    /**
     * Execute testSaveWithException()
     *
     * @return void
     * @throws CouldNotSaveException
     */
    public function testSaveWithException()
    {
        $exception = $this->getMockBuilder(\Exception::class)
            ->disableOriginalConstructor()
            ->getMock();

        $logisticProviderInterface = $this->getMockBuilder(LogisticProvider::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->logisticProviderResource->expects($this->once())
            ->method('save')
            ->willThrowException($exception);

        $this->expectException(CouldNotSaveException::class);

        $result = $this->instance->save($logisticProviderInterface);
        $this->assertInstanceOf(LogisticProviderInterface::class, $result);
    }

    /**
     * Execute testGetByIdSuccess()
     *
     * @return void
     * @throws NoSuchEntityException
     */
    public function testGetByIdSuccess()
    {
        $this->logisticProviderInterfaceFactory->expects($this->once())
            ->method('create')
            ->willReturn($this->logisticProviderInterface);

        $this->logisticProviderInterfaceFactory->expects($this->once())
            ->method('create')
            ->willReturn($this->logisticProviderInterface);

        $this->logisticProviderInterface->expects($this->once())
            ->method('getId')
            ->willReturn(20);

        $result = $this->instance->getById(20);
        $this->assertInstanceOf(LogisticProviderInterface::class, $result);
    }

    /**
     * Execute testGetByIdSuccess()
     *
     * @return void
     * @throws NoSuchEntityException
     */
    public function testGetByIntelipostId()
    {
        $this->logisticProviderInterfaceFactory->expects($this->once())
            ->method('create')
            ->willReturn($this->logisticProviderInterface);

        $this->logisticProviderInterfaceFactory->expects($this->once())
            ->method('create')
            ->willReturn($this->logisticProviderInterface);
        $intelipostId = 20;

        $this->logisticProviderInterface->expects($this->once())
            ->method('getId')
            ->willReturn($intelipostId);

        $result = $this->instance->getByIntelipostId($intelipostId);
        $this->assertInstanceOf(LogisticProviderInterface::class, $result);
    }

    /**
     * Execute testGetByIdException()
     *
     * @return void
     * @throws NoSuchEntityException
     */
    public function testGetByIdException()
    {
        $this->logisticProviderInterfaceFactory->expects($this->once())
            ->method('create')
            ->willReturn($this->logisticProviderInterface);

        $this->logisticProviderInterface->expects($this->once())
            ->method('getId')
            ->willReturn(null);

        $registerId = 20;

        $this->expectException(NoSuchEntityException::class);
        $this->expectExceptionMessage("The Provider with the \"{$registerId}\" ID doesn't exist.");

        $result = $this->instance->getById($registerId);
        $this->assertInstanceOf(LogisticProviderInterface::class, $result);
    }

    /**
     * Execute testGetByIntelipostIdException()
     *
     * @return void
     * @throws NoSuchEntityException
     */
    public function testGetByIntelipostIdException()
    {
        $this->logisticProviderInterfaceFactory->expects($this->once())
            ->method('create')
            ->willReturn($this->logisticProviderInterface);

        $this->logisticProviderInterface->expects($this->once())
            ->method('getId')
            ->willReturn(null);

        $registerId = 20;

        $this->expectException(NoSuchEntityException::class);
        $this->expectExceptionMessage("The Provider with the \"{$registerId}\" Intelipost ID doesn't exist.");

        $result = $this->instance->getByIntelipostId($registerId);
        $this->assertInstanceOf(LogisticProviderInterface::class, $result);
    }
}
