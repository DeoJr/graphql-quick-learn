<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Test\Unit\Controller\Adminhtml\Provider;

use Webjump\LogisticProvider\Api\Data\LogisticProviderInterface;
use Webjump\LogisticProvider\Api\LogisticProviderRepositoryInterface;
use Webjump\LogisticProvider\Controller\Adminhtml\Provider\Delete;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Message\ManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class DeleteTest
 *
 * @package Webjump\LogisticProvider\Test\Unit\Controller\Adminhtml\Provider
 */
class DeleteTest extends TestCase
{

    /** @var Delete $instance */
    private $instance;

    /** @var MockObject|Context $context */
    private $context;

    /** @var MockObject|LogisticProviderRepositoryInterface $logisticProviderRepositoryInterface */
    private $logisticProviderRepositoryInterface;

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
            ->setMethods(['getResultRedirectFactory', 'getRequest', 'getMessageManager'])
            ->getMock();

        $this->mockResultRedirect();
        $this->mockForParams();
        $this->mockForMessageManager();

        $this->logisticProviderRepositoryInterface =
            $this->getMockBuilder(LogisticProviderRepositoryInterface::class)
            ->setMethods(['getById'])
            ->getMockForAbstractClass();
    }

    /**
     * Mock For Message Manager
     *
     * @return void
     */
    private function mockForMessageManager()
    {
        $managerInterface = $this->getMockBuilder(ManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->context->expects($this->once())
            ->method('getMessageManager')
            ->willReturn($managerInterface);
    }

    /**
     * Mock For Parameters
     *
     * @return void
     */
    private function mockForParams()
    {
        $requestInterface = $this->getMockBuilder(RequestInterface::class)
            ->setMethods(['getParam'])
            ->getMockForAbstractClass();

        $requestInterface->expects($this->once())
            ->method('getParam')
            ->with('provider_id')
            ->willReturn(['data' => 'data1']);

        $this->context->expects($this->once())
            ->method('getRequest')
            ->willReturn($requestInterface);
    }

    /**
     * Mock Result Redirect
     *
     * @return void
     */
    private function mockResultRedirect()
    {
        $redirect = $this->getMockBuilder(Redirect::class)
            ->disableOriginalConstructor()
            ->setMethods(['setPath'])
            ->getMock();

        $redirectFactory = $this->getMockBuilder(RedirectFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMock();

        $redirectFactory->expects($this->once())
            ->method('create')
            ->willReturn($redirect);

        $this->context->expects($this->once())
            ->method('getResultRedirectFactory')
            ->willReturn($redirectFactory);
    }

    /**
     * Set Instance Test
     *
     * @return void
     */
    private function instance()
    {
        $this->instance = new Delete(
            $this->context,
            $this->logisticProviderRepositoryInterface
        );
        $this->assertInstanceOf(HttpPostActionInterface::class, $this->instance);
    }

    /**
     * Execute testExecuteWithSuccessDelete()
     *
     * @return void
     */
    public function testExecuteWithSuccessDelete()
    {
        $logisticProvider = $this->getMockBuilder(LogisticProviderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->logisticProviderRepositoryInterface->expects($this->once())
            ->method('getById')
            ->willReturn($logisticProvider);

        $this->instance->execute();
    }

    /**
     * Execute testExecuteWithExceptionDelete()
     *
     * @return void
     */
    public function testExecuteWithExceptionDelete()
    {
        $exception = $this->getMockBuilder(\Exception::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->logisticProviderRepositoryInterface->expects($this->once())
            ->method('getById')
            ->willThrowException($exception);

        $this->instance->execute();
    }
}
