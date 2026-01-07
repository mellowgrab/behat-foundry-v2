## Setup

To run `Homepage` feature create the database schema first:

```shell
bin/console -e test  doctrine:schema:create  
```

To illustrate all the problems disable `FoundryFixHookContext` hooks and run the tests.

## With all hooks disabled
```shell
vendor/bin/behat features/homepage.feature
```

```terminaloutput
$> vendor/bin/behat features/homepage.feature                                                                                                                                                                                                                              
Feature: Homepage                                                                                                                                                                                                                                                                                                           
    In order to verify the site is working
    As a visitor
    I need to be able to see the homepage

  Scenario: View homepage           # features/homepage.feature:6
    When I am on "/"                # Behat\MinkExtension\Context\MinkContext::visit()
    Then I should see "Hello World" # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()

  Scenario: View homepage and then create user                          # features/homepage.feature:10
    When I am on "/"                                                    # Behat\MinkExtension\Context\MinkContext::visit()
    Then I should see "Hello World"                                     # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()
    And I have a user with name "John Doe" and email "john@example.com" # App\Tests\Context\FeatureContext::iHaveAUserWithNameAndEmail()
      Entity App\Entity\User@3239 is not managed. An entity is managed if its fetched from the database or registered as new through EntityManager#persist (Doctrine\ORM\ORMInvalidArgumentException)

  Scenario: View homepage twice and then create user                    # features/homepage.feature:15
    When I am on "/"                                                    # Behat\MinkExtension\Context\MinkContext::visit()
    Then I should see "Hello World"                                     # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()
    When I am on "/"                                                    # Behat\MinkExtension\Context\MinkContext::visit()
    Then I should see "Hello World"                                     # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()
    And I have a user with name "John Doe" and email "john@example.com" # App\Tests\Context\FeatureContext::iHaveAUserWithNameAndEmail()
      Entity App\Entity\User@3997 is not managed. An entity is managed if its fetched from the database or registered as new through EntityManager#persist (Doctrine\ORM\ORMInvalidArgumentException)

--- Failed scenarios:

    features/homepage.feature:10 (on line 13)
    features/homepage.feature:15 (on line 20)

3 scenarios (1 passed, 2 failed)
10 steps (8 passed, 2 failed)
0m0.04s (25.48Mb)
```


## With insulate hook disabled
```shell
vendor/bin/behat features/homepage.feature
```

```terminaloutput
$> > vendor/bin/behat features/homepage.feature
Feature: Homepage
    In order to verify the site is working
    As a visitor
    I need to be able to see the homepage

  Scenario: View homepage           # features/homepage.feature:6
    When I am on "/"                # Behat\MinkExtension\Context\MinkContext::visit()
    Then I should see "Hello World" # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()

  Scenario: View homepage and then create user                          # features/homepage.feature:10
    When I am on "/"                                                    # Behat\MinkExtension\Context\MinkContext::visit()
    Then I should see "Hello World"                                     # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()
    And I have a user with name "John Doe" and email "john@example.com" # App\Tests\Context\FeatureContext::iHaveAUserWithNameAndEmail()

  Scenario: View homepage twice and then create user                    # features/homepage.feature:15
    When I am on "/"                                                    # Behat\MinkExtension\Context\MinkContext::visit()
    Then I should see "Hello World"                                     # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()
    When I am on "/"                                                    # Behat\MinkExtension\Context\MinkContext::visit()
    Then I should see "Hello World"                                     # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()
    And I have a user with name "John Doe" and email "john@example.com" # App\Tests\Context\FeatureContext::iHaveAUserWithNameAndEmail()
      Entity App\Entity\User@3929 is not managed. An entity is managed if its fetched from the database or registered as new through EntityManager#persist (Doctrine\ORM\ORMInvalidArgumentException)

--- Failed scenarios:

    features/homepage.feature:15 (on line 20)

3 scenarios (2 passed, 1 failed)
10 steps (9 passed, 1 failed)
0m0.09s (25.81Mb)
```
