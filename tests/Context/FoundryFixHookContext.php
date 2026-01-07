<?php

declare(strict_types=1);

namespace App\Tests\Context;

use Behat\Behat\Context\Context;
use Behat\Hook\AfterScenario;
use Behat\Hook\BeforeScenario;
use Behat\Mink\Mink;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Zenstruck\Foundry\Configuration;

/**
 * @link https://github.com/zenstruck/foundry/issues/234
 * @link https://github.com/zenstruck/foundry/issues/944
 * @link https://github.com/zenstruck/foundry/issues/1034
 *
 * setUpConfiguration/shutdownConfiguration - helps with suite running, overwise scenarios fail
 * insulateClient - helps with multiple requests in one scenario
 */
final readonly class FoundryFixHookContext implements Context
{
    public function __construct(
        #[Autowire(service: '.zenstruck_foundry.configuration')]
        private Configuration $configuration,
        private Mink $mink,
    ) {
    }

    #[BeforeScenario]
    public function insulateClient(): void
    {
        $this->mink->getSession()->getDriver()->getClient()->insulate();
    }

    #[BeforeScenario]
    public function setUpConfiguration(): void
    {

        Configuration::boot($this->configuration);
    }

    #[AfterScenario]
    public function shutdownConfiguration(): void
    {
        Configuration::shutdown();
    }
}
