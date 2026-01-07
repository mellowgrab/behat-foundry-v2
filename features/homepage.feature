Feature: Homepage
    In order to verify the site is working
    As a visitor
    I need to be able to see the homepage

    Scenario: View homepage
        When I am on "/"
        Then I should see "Hello World"

    Scenario: View homepage and then create user
        When I am on "/"
        Then I should see "Hello World"
        And I have a user with name "John Doe" and email "john@example.com"

    Scenario: View homepage twice and then create user
        When I am on "/"
        Then I should see "Hello World"
        When I am on "/"
        Then I should see "Hello World"
        And I have a user with name "John Doe" and email "john@example.com"
