<?php

namespace App\Application\Form;

use App\Application\Form\CryptoType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CryptoTypeTest extends TypeTestCase
{
    private CryptoType $cryptoType;

    protected function setUp(): void
    {
        $this->cryptoType = new CryptoType();
    }

    public function testBuildForm(): void
    {
        $formBuilder = $this->createMock(FormBuilderInterface::class);
        $formBuilder
            ->expects($this->exactly(1))
            ->method('add')
            ->withConsecutive(
                ['ClearDataToConvert', Type\TextType::class],
                ['Submit', Type\SubmitType::class],
            );

        $this->cryptoType->buildForm($formBuilder, []);
    }

    public function testConfigureOptions(): void
    {
        $this->assertNull($this->cryptoType->configureOptions(new OptionsResolver()));
    }
}
