<?php
/**
 * This file is part of the mimmi20/laminas-form-element-paragraph package.
 *
 * Copyright (c) 2021-2022, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Mimmi20Test\Form\Paragraph;

use Mimmi20\Form\Paragraph\ConfigProvider;
use Mimmi20\Form\Paragraph\Element\Paragraph;
use Mimmi20\Form\Paragraph\Element\ParagraphInterface;
use Mimmi20\Form\Paragraph\View\Helper\FormParagraph;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

final class ConfigProviderTest extends TestCase
{
    private ConfigProvider $provider;

    protected function setUp(): void
    {
        $this->provider = new ConfigProvider();
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function testProviderDefinesExpectedFactoryServices(): void
    {
        $formElementConfig = $this->provider->getFormElementConfig();
        self::assertCount(2, $formElementConfig);
        self::assertArrayHasKey('factories', $formElementConfig);
        $factories = $formElementConfig['factories'];
        self::assertIsArray($factories);
        self::assertCount(1, $factories);
        self::assertArrayHasKey(Paragraph::class, $factories);

        self::assertArrayHasKey('aliases', $formElementConfig);
        $aliases = $formElementConfig['aliases'];
        self::assertIsArray($aliases);
        self::assertCount(2, $aliases);
        self::assertArrayHasKey('paragraph', $aliases);
        self::assertArrayHasKey(ParagraphInterface::class, $aliases);
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function testProviderDefinesExpectedFactoryServices2(): void
    {
        $viewHelperConfig = $this->provider->getViewHelperConfig();
        self::assertCount(2, $viewHelperConfig);
        self::assertArrayHasKey('factories', $viewHelperConfig);
        $factories = $viewHelperConfig['factories'];
        self::assertIsArray($factories);
        self::assertCount(1, $factories);
        self::assertArrayHasKey(FormParagraph::class, $factories);

        self::assertArrayHasKey('aliases', $viewHelperConfig);
        $aliases = $viewHelperConfig['aliases'];
        self::assertIsArray($aliases);
        self::assertCount(4, $aliases);
        self::assertArrayHasKey('formparagraph', $aliases);
        self::assertArrayHasKey('form_paragraph', $aliases);
        self::assertArrayHasKey('formParagraph', $aliases);
        self::assertArrayHasKey('FormParagraph', $aliases);
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function testInvocationReturnsArrayWithDependencies(): void
    {
        $config = ($this->provider)();

        self::assertIsArray($config);
        self::assertCount(2, $config);
        self::assertArrayHasKey('form_elements', $config);
        self::assertArrayHasKey('view_helpers', $config);

        $formElementConfig = $config['form_elements'];
        self::assertCount(2, $formElementConfig);
        self::assertArrayHasKey('factories', $formElementConfig);
        $factories = $formElementConfig['factories'];
        self::assertIsArray($factories);
        self::assertCount(1, $factories);
        self::assertArrayHasKey(Paragraph::class, $factories);

        self::assertArrayHasKey('aliases', $formElementConfig);
        $aliases = $formElementConfig['aliases'];
        self::assertIsArray($aliases);
        self::assertCount(2, $aliases);
        self::assertArrayHasKey('paragraph', $aliases);
        self::assertArrayHasKey(ParagraphInterface::class, $aliases);

        $viewHelperConfig = $config['view_helpers'];
        self::assertCount(2, $viewHelperConfig);
        self::assertArrayHasKey('factories', $viewHelperConfig);
        $factories = $viewHelperConfig['factories'];
        self::assertIsArray($factories);
        self::assertCount(1, $factories);
        self::assertArrayHasKey(FormParagraph::class, $factories);

        self::assertArrayHasKey('aliases', $viewHelperConfig);
        $aliases = $viewHelperConfig['aliases'];
        self::assertIsArray($aliases);
        self::assertCount(4, $aliases);
        self::assertArrayHasKey('formparagraph', $aliases);
        self::assertArrayHasKey('form_paragraph', $aliases);
        self::assertArrayHasKey('formParagraph', $aliases);
        self::assertArrayHasKey('FormParagraph', $aliases);
    }
}
