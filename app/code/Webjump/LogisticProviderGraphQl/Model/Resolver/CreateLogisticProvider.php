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
 * Class CreateLogisticProvider
 *
 * @package Webjump\LogisticProviderGraphQl\Model\Resolver
 */
class CreateLogisticProvider implements ResolverInterface
{
    /** @var LogisticProviderRepository $logisticProviderRepository */
    private $logisticProviderRepository;

    /** @var LogisticProvider $logisticProvider */
    private $logisticProvider;

    /**
     * CreateLogisticProvider constructor.
     *
     * @param LogisticProviderRepository $logisticProviderRepository
     * @param LogisticProvider $logisticProvider
     */
    public function __construct(
        LogisticProviderRepository $logisticProviderRepository,
        LogisticProvider $logisticProvider
    ) {
        $this->logisticProviderRepository = $logisticProviderRepository;
        $this->logisticProvider = $logisticProvider;
    }
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (empty($args['input'])) {
            throw new GraphQlInputException(__('Required parameter is missing'));
        }

        $this->logisticProvider->setIntelipostId((string)$args['input']['intelipost_id']);
        $this->logisticProvider->setSapId((string)$args['input']['sap_id']);
        $this->logisticProvider->setProviderName($args['input']['provider_name']);
        $this->logisticProvider->setTrackingUrl($args['input']['tracking_url']);

        $logistic = $this->logisticProviderRepository->save($this->logisticProvider);

        return [
            'logistic_provider' => $logistic->getData()
        ];
    }
}
