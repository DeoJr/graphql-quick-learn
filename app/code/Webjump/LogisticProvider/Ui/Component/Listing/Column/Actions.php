<?php
/**
 * @author      Webjump Core Team <dev@webjump.com.br>
 * @copyright   2020 Webjump (http://www.webjump.com.br)
 * @license     http://www.webjump.com.br Copyright
 * @link        http://www.webjump.com.br
 */

declare(strict_types=1);

namespace Webjump\LogisticProvider\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Class Actions
 *
 * @package Webjump\Providers\Ui\Component\Listing\Column
 */
class Actions extends Column
{
    /** @var string URL_PATH_EDIT */
    const URL_PATH_EDIT   = 'provider/provider/edit';

    /** @var string URL_PATH_DELETE */
    const URL_PATH_DELETE = 'provider/provider/delete';

    /** @var UrlInterface $urlBuilder */
    protected $urlBuilder;

    /**
     * Actions constructor.
     *
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface       $urlBuilder
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $dataSource = parent::prepareDataSource($dataSource);

        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as &$item) {
            $name = $item['provider_name'];

            $editUrl = $this->urlBuilder->getUrl(
                static::URL_PATH_EDIT,
                ['provider_id' => $item['id']]
            );

            $deleteUrl = $this->urlBuilder->getUrl(
                static::URL_PATH_DELETE,
                ['provider_id' => $item['id']]
            );

            $item[$this->getData('name')] = [
                'edit' => [
                    'href' => $editUrl,
                    'label' => __('Edit'),
                    'hidden' => false,
                    '__disableTmpl' => true,
                ],
                'delete' => [
                    'href' => $deleteUrl,
                    'label' => __('Delete'),
                    'confirm' => [
                        'title' => __('Delete %1', $name),
                        'message' => __('Are you sure you want to delete a %1 record?', $name),
                    ],
                    'post' => true,
                    '__disableTmpl' => true,
                ],
            ];
        }

        return $dataSource;
    }
}
