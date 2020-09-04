<?php
declare(strict_types=1);

namespace Webjump\LogisticProvider\Test\Unit\Block\Adminhtml\Providers\Edit;

use Webjump\LogisticProvider\Block\Adminhtml\Providers\Edit\SaveButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class SaveButtonTest
 *
 * @package Webjump\LogisticProvider\Test\Unit\Block\Adminhtml\Providers\Edit
 */
class SaveButtonTest extends TestCase
{

    /** @var SaveButton $instance */
    private $instance;

    /**
     * Set up test
     *
     * @return void
     */
    protected function setUp()
    {
        $this->instance();
    }

    /**
     * Set Instance Test
     *
     * @return void
     */
    private function instance()
    {
        $this->instance = new SaveButton();
        $this->assertInstanceOf(ButtonProviderInterface::class, $this->instance);
    }

    /**
     * Execute testGetButtonData()
     *
     * @return void
     */
    public function testGetButtonData()
    {
        $result = $this->instance->getButtonData();
        $this->assertTrue(is_array($result));
        $this->assertArrayHasKey('class', $result);
        $this->assertArrayHasKey('class_name', $result);
        $this->assertArrayHasKey('label', $result);
    }
}
