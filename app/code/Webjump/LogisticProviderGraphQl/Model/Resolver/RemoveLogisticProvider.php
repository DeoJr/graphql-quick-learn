<?php
declare(strict_types=1);

namespace Webjump\LogisticProviderGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Webjump\LogisticProvider\Model\LogisticProviderRepository;

/**
 * Class RemoveLogisticProvider
 *
 * @package Webjump\LogisticProviderGraphQl\Model\Resolver
 */
class RemoveLogisticProvider implements ResolverInterface
{

    /** @var LogisticProviderRepository $logisticProviderRepository */
    private $logisticProviderRepository;

    /**
     * RemoveLogisticProvider constructor.
     *
     * @param LogisticProviderRepository $logisticProviderRepository
     */
    public function __construct(
        LogisticProviderRepository $logisticProviderRepository
    ) {
        $this->logisticProviderRepository = $logisticProviderRepository;
    }

    /**
     * @inheritDoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (empty($args['input']['logistic_provider_id'])) {
            throw new GraphQlInputException(__('Required parameter "logistic_provider_id" is missing'));
        }
        $logisticProvider = $this->logisticProviderRepository->getById($args['input']['logistic_provider_id']);
        $this->logisticProviderRepository->delete($logisticProvider);
        return ['status' => true];
    }
}
