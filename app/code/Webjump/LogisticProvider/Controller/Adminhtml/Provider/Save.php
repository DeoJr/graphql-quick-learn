<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Controller\Adminhtml\Provider;

use Webjump\LogisticProvider\Api\Data\LogisticProviderInterface;
use Webjump\LogisticProvider\Api\Data\LogisticProviderInterfaceFactory;
use Webjump\LogisticProvider\Api\LogisticProviderRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 *
 * @package Webjump\LogisticProvider\Controller\Adminhtml\Providers
 */
class Save extends Action implements HttpPostActionInterface
{

    private $logisticProviderRepository;

    private $logisticProvider;

    /**
     * Save constructor.
     *
     * @param Context                             $context
     * @param LogisticProviderRepositoryInterface $logisticProviderRepository
     * @param LogisticProviderInterfaceFactory    $logisticProvider
     */
    public function __construct(
        Context $context,
        LogisticProviderRepositoryInterface $logisticProviderRepository,
        LogisticProviderInterfaceFactory $logisticProvider
    ) {
        parent::__construct($context);
        $this->logisticProviderRepository = $logisticProviderRepository;
        $this->logisticProvider = $logisticProvider;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $data = $this->getRequest()->getPostValue();
        $logisticProviderId = (int)$this->getRequest()->getParam('provider_id');

        if (!$data) {
            return $resultRedirect->setPath('*/*/');
        }

        /** @var LogisticProviderInterface $logisticProvider */
        $logisticProvider = $this->logisticProvider->create();
        if ($logisticProviderId) {
            try {
                $logisticProvider = $this->logisticProviderRepository->getById($logisticProviderId);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage(__('This provider not exists'));
                return $resultRedirect->setPath('*/*/');
            }
        }
        $logisticProvider->setData($data);

        try {
            $this->logisticProviderRepository->save($logisticProvider);
            $this->messageManager->addSuccessMessage(__('You saved the provider'));
        } catch (CouldNotSaveException $exception) {
            $this->messageManager->addErrorMessage(__($exception->getMessage()));
        }

        return $resultRedirect->setPath('*/*/');
    }
}
