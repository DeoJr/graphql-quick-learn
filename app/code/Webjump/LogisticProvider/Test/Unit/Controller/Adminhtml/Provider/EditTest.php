<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Test\Unit\Controller\Adminhtml\Provider;

use Webjump\LogisticProvider\Api\Data\LogisticProviderInterface;
use Webjump\LogisticProvider\Api\LogisticProviderRepositoryInterface;
use Webjump\LogisticProvider\Controller\Adminhtml\Provider\Edit;
use Laminas\Session\ManagerInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class DeleteTest
 *
 * @package Webjump\LogisticProvider\Test\Unit\Controller\Adminhtml\Provider
 * @SuppressWarnings(PHPMD)
 */
class EditTest extends TestCase
{

    /** @var Edit $instance */
    private $instance;

    /** @var MockObject|Context $context */
    private $context;

    /** @var MockObject|ResultFactory ResultFactory2 */
    private $resultFactory2;

    /** @var MockObject|ResultInterface $resultInterface */
    private $resultInterface;

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
            ->setMethods(['getResultFactory', 'getRequest', 'getMessageManager', 'getResultRedirectFactory'])
            ->getMock();

        $this->mockForParams();
        $this->mockForMessageManager();

        $this->resultInterface = $this->getMockBuilder(ResultInterface::class)
            ->setMethods(['getConfig', 'getTitle', 'prepend'])
            ->getMockForAbstractClass();

        $this->resultInterface->expects($this->once())
            ->method('getConfig')
            ->willReturn($this->resultInterface);

        $this->resultInterface->expects($this->once())
            ->method('getTitle')
            ->willReturn($this->resultInterface);

        $this->resultFactory = $this->getMockBuilder(ResultFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMock();

        $this->resultInterface->expects($this->once())
            ->method('prepend')
            ->willReturn($this->resultInterface);

        $this->resultFactory->expects($this->once())
            ->method('create')
            ->willReturn($this->resultInterface);

        $this->context->expects($this->once())
            ->method('getResultFactory')
            ->willReturn($this->resultFactory);

        $this->logisticProviderRepositoryInterface =
            $this->getMockBuilder(LogisticProviderRepositoryInterface::class)
                ->setMethods(['getById'])
                ->getMockForAbstractClass();
    }

    /**
     * Set Instance Test
     *
     * @return void
     */
    private function instance()
    {
        $this->instance = new Edit(
            $this->context,
            $this->logisticProviderRepositoryInterface
        );
        $this->assertInstanceOf(HttpGetActionInterface::class, $this->instance);
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
            ->willReturn(20202020);

        $this->context->expects($this->once())
            ->method('getRequest')
            ->willReturn($requestInterface);
    }

    /**
     * Mock For Message Manager
     *
     * @return void
     */
    private function mockForMessageManager()
    {
        $managerInterface = $this->getMockBuilder(ManagerInterface::class)
            ->setMethods(['addErrorMessage'])
            ->getMockForAbstractClass();

        $managerInterface->expects($this->any())
            ->method('addErrorMessage')
            ->willReturn($managerInterface);

        $this->context->expects($this->any())
            ->method('getMessageManager')
            ->willReturn($managerInterface);
    }

    /**
     * Execute testExecuteWithSuccessDelete()
     *
     * @return void
     */
    public function testExecuteWithSuccess()
    {
        $logisticProvider = $this->getMockBuilder(LogisticProviderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->logisticProviderRepositoryInterface->expects($this->any())
            ->method('getById')
            ->willReturn($logisticProvider);

        $result = $this->instance->execute();
        $this->assertInstanceOf(ResultInterface::class, $result);
    }
}
