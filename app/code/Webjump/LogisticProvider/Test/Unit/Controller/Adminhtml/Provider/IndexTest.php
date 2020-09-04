<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Test\Unit\Controller\Adminhtml\Provider;

use Webjump\LogisticProvider\Controller\Adminhtml\Provider\Index;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class DeleteTest
 *
 * @package Webjump\LogisticProvider\Test\Unit\Controller\Adminhtml\Provider
 */
class IndexTest extends TestCase
{

    /** @var Index $instance */
    private $instance;

    /** @var MockObject|Context $context */
    private $context;

    /** @var MockObject|ResultFactory ResultFactory */
    private $resultFactory;

    /** @var MockObject|ResultInterface $resultInterface */
    private $resultInterface;

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
        $this->context = $this->getMockBuilder(Context::class)
            ->disableOriginalConstructor()
            ->setMethods(['getResultFactory'])
            ->getMock();

        $this->resultFactory = $this->getMockBuilder(ResultFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMock();

        $this->resultInterface = $this->getMockBuilder(ResultInterface::class)
            ->setMethods(['getConfig', 'getTitle', 'prepend'])
            ->getMockForAbstractClass();

        $this->resultInterface->expects($this->once())
            ->method('getConfig')
            ->willReturn($this->resultInterface);

        $this->resultInterface->expects($this->once())
            ->method('getTitle')
            ->willReturn($this->resultInterface);

        $this->resultInterface->expects($this->once())
            ->method('prepend')
            ->willReturn($this->resultInterface);

        $this->resultFactory->expects($this->once())
            ->method('create')
            ->willReturn($this->resultInterface);

        $this->context->expects($this->once())
            ->method('getResultFactory')
            ->willReturn($this->resultFactory);
    }

    /**
     * Set Instance Test
     *
     * @return void
     */
    private function instance()
    {
        $this->instance = new Index(
            $this->context
        );
        $this->assertInstanceOf(HttpGetActionInterface::class, $this->instance);
    }

    /**
     * Execute testExecuteWithSuccessDelete()
     *
     * @return void
     */
    public function testExecute()
    {
        $result = $this->instance->execute();
        $this->assertInstanceOf(ResultInterface::class, $result);
    }
}
