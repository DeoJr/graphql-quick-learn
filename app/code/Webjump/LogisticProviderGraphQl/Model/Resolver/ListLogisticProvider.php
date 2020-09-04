<?php
declare(strict_types=1);

namespace Webjump\LogisticProviderGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Webjump\LogisticProvider\Model\LogisticProvider;
use Webjump\LogisticProvider\Model\LogisticProviderRepository;

/**
 * Class ListLogisticProvider
 *
 * @package Webjump\LogisticProviderGraphQl\Model\Resolver
 */
class ListLogisticProvider implements ResolverInterface
{
    /** @var LogisticProviderRepository $logisticProviderRepository */
    private $logisticProviderRepository;

    /**
     * ListLogisticProvider constructor.
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
        return $this->logisticProviderRepository->getList();
    }
}

