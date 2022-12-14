<?php

namespace spec\App\Application\Controller;

use App\Application\Controller\HomeController;
use PhpSpec\ObjectBehavior;

class HomeControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(HomeController::class);
    }
}
