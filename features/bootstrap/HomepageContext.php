<?php

declare(strict_types=1);

namespace App\Features;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

/**
 * Defines application features from the specific context.
 */
final class HomepageContext extends KernelContext implements Context
{
    /*
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     *
     * Sample
     *  @Before/After Suite, Feature, Scenario, Step
     *
     * @When I do something with :stringArgument and with :numberArgument
     * @When there is/are :count monster(s)
     * @When /^there (?:is|are) (\d+) monsters?$/i
     * @When /^I create (\d+) monsters$/i
     * @Given /^(\d+) monster(?:s|) (?:have|has) been created$/i
     */
    /*public function __construct(KernelInterface $kernel, string $arg = '5')
    {
        parent::__construct($kernel);
        //PHPUnit\Framework_Assert::assertCount(intval(1), 1);
    }*/

    /**
     * @When a demo scenario sends a request to :path
     */
    public function aDemoScenarioSendsARequestTo(string $path): void
    {
        $this->response = $this->handleRequest($path, 'GET');
    }

    /**
     * @Then the response should be received
     */
    public function theResponseShouldBeReceived(): void
    {
        if ($this->response === null) {
            throw new \RuntimeException('No response received');
        }
    }

    /** @BeforeFeature */
    public static function prepareForTheFeature()
    {
        // clean database or do other preparation stuff
    }

    /** @Given The homepage is alive */
    public function theHomepageIsAlive()
    {
        throw new PendingException();
    }

    /** @When I access the homepage */
    public function iAccessTheHomepage()
    {
        throw new PendingException();
    }

    /** @Then I should see it */
    public function iShouldSeeIt()
    {
        throw new PendingException();
    }

    /** @Then Script is valid */
    public function scriptIsValid()
    {
        throw new PendingException();
    }
}
