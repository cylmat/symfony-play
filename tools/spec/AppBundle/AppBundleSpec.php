<?php

namespace spec\App\AppBundle;

use App\AppBundle\AppBundle;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

class AppBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AppBundle::class);
    }

    function it_should_get_extension()
    {
        $this->getContainerExtension()->shouldHaveType(ExtensionInterface::class);
    }
}
