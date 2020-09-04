<?php
declare(strict_types=1);

namespace Webjump\LogisticProviderGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Webjump\LogisticProvider\Model\LogisticProviderRepository;

/**
 * Class LogisticProviderById
 *
 * @package Webjump\LogisticProviderGraphQl\Model\Resolver
 */
class LogisticProviderById implements ResolverInterface
{
    /** @var LogisticProviderRepository $logisticProviderRepository */
    private $logisticProviderRepository;

    /**
     * LogisticProviderById constructor.
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
        if (empty($args['logistic_provider_id'])) {
            throw new GraphQlInputException(__('Required parameter "logistic_provider_id" is missing'));
        }

        $provider = $this->logisticProviderRepository->getById($args['logistic_provider_id']);
        return $provider->getData();
    }
}
