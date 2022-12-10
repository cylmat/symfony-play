<?php

namespace spec\App\Application\Controller;

use App\Application\Controller\CryptoController;
use PhpSpec\ObjectBehavior;

class CryptoControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CryptoController::class);
    }
}
