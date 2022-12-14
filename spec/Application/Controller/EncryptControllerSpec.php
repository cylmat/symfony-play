<?php

namespace spec\App\Application\Controller;

use App\Application\Controller\EncryptController;
use PhpSpec\ObjectBehavior;

class EncryptControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EncryptController::class);
    }
}
