<?php

namespace App\Test\Text\Application;

use App\Text\Application\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class TextTypeTest extends TypeTestCase
{
    private TextType $textType;

    protected function setUp(): void
    {
        $this->textType = new TextType();
    }

    /** @return mixed[] */
    protected function getExtensions(): array
    {
        return [];
    }

    public function testBuildForm(): void
    {
        $builder = $this->createMock(FormBuilderInterface::class);
        $this->assertNull($this->textType->buildForm($builder, []));
    }

    public function testConfigureOptions(): void
    {
        $optionsResolver = $this->createMock(OptionsResolver::class);
        $optionsResolver
            ->expects($this->once())
            ->method('setDefaults')
            ->with([])
        ;
        $this->assertNull($this->textType->configureOptions($optionsResolver));
    }
}
