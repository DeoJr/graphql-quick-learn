<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Controller\Adminhtml\Provider;

use Webjump\LogisticProvider\Api\LogisticProviderRepositoryInterface;
use Webjump\LogisticProvider\Model\LogisticProviderRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Class Delete
 *
 * @package Webjump\Providers\Controller\Adminhtml\Providers
 */
class Delete extends Action implements HttpPostActionInterface
{
    /** @var LogisticProviderRepositoryInterface $logisticProviderRepository */
    private $logisticProviderRepository;

    /**
     * Delete constructor.
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
     * @return Redirect
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $logisticProviderId = (int)$this->getRequest()->getParam('provider_id');

        if (!$logisticProviderId) {
            $this->messageManager->addErrorMessage(__("We can't find a provider to delete."));
            return $resultRedirect->setPath('*/*/');
        }

        try {
            $model = $this->logisticProviderRepository->getById($logisticProviderId);
            $this->logisticProviderRepository->delete($model);

            $this->messageManager->addSuccessMessage(__('You deleted the Provider.'));

            return $resultRedirect->setPath('*/*/');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $resultRedirect->setPath('*/*/edit', ['provider_id' => $logisticProviderId]);
        }
    }
}
