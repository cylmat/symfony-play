<?php

namespace App\Tests\Encrypt\Application\Form;

use App\Encrypt\Application\Form\CryptoType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CryptoTypeTest extends TypeTestCase
{
    private CryptoType $cryptoType;
    private FormBuilderInterface $formBuilder;

    protected function setUp(): void
    {
        $this->cryptoType = new CryptoType();
        $this->formBuilder = $this->createMock(FormBuilderInterface::class);
    }

    /** @todo fix that test called exaclty twice */
    public function testBuildForm(): void
    {
        $this->formBuilder
            ->expects($this->exactly(1))
            ->method('add')
            ->withConsecutive(
                ['ClearDataToConvert', Type\TextType::class],
                ['Submit', Type\SubmitType::class],
            );

        $this->cryptoType->buildForm($this->formBuilder, []);
    }

    public function testConfigureOptions(): void
    {
        $optionResolver = $this->createMock(OptionsResolver::class);
        $optionResolver
            ->expects($this->once())
            ->method('setDefaults')
            ->with([])
        ;

        $this->cryptoType->configureOptions($optionResolver);
    }
}
