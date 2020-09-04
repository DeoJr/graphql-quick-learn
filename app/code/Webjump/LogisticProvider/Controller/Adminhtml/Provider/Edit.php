<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Controller\Adminhtml\Provider;

use Webjump\LogisticProvider\Api\LogisticProviderRepositoryInterface;
use Webjump\LogisticProvider\Model\LogisticProviderRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Index
 *
 * @package Webjump\Providers\Controller\Adminhtml\Provider
 */
class Edit extends Action implements HttpGetActionInterface
{
    /** @var LogisticProviderRepository $logisticProviderRepository */
    private $logisticProviderRepository;

    /**
     * Edit constructor.
     *
     * @param Context                             $context
     * @param LogisticProviderRepositoryInterface $logisticProviderRepository
     */
    public function __construct(
        Context $context,
        LogisticProviderRepositoryInterface $logisticProviderRepository
    ) {
        parent::__construct($context);
        $this->logisticProviderRepository = $logisticProviderRepository;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $logisticProviderId = (int)$this->getRequest()->getParam('provider_id');

        if ($logisticProviderId) {
            try {
                $this->logisticProviderRepository->getById($logisticProviderId);
            } catch (NoSuchEntityException $exception) {
                $this->messageManager->addErrorMessage(__($exception->getMessage()));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend('Providers');

        return $resultPage;
    }
}
