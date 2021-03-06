<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Controller\Adminhtml\Provider;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class NewAction
 *
 * @package Webjump\LogisticProvider\Controller\Adminhtml\Provider
 */
class NewAction extends Action implements HttpGetActionInterface
{

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var ResultInterface $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
        $resultPage->forward('edit');
        return $resultPage;
    }
}
