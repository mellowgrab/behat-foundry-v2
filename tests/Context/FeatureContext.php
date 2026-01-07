<?php

namespace App\Tests\Context;

use App\Factory\UserFactory;
use Behat\Behat\Context\Context;
use Webmozart\Assert\Assert;

class FeatureContext implements Context
{
    public function __construct(private \Doctrine\ORM\EntityManagerInterface $entityManager)
    {
    }

    /**
     * @Given I have a user
     */
    public function iHaveAUser()
    {
        UserFactory::createOne();
    }

    /**
     * @Given I have a user with name :name and email :email
     */
    public function iHaveAUserWithNameAndEmail($name, $email)
    {
        $user = UserFactory::createOne([
            'name' => $name,
            'email' => $email,
        ]);

        $this->entityManager->refresh($user);
    }
}
