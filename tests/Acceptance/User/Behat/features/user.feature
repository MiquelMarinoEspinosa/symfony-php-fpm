# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature:
    Users feature

    Scenario: It creates an user with its credentials
        Given the user credentials
            | name   | password |
            | behat  | behat    |
        When make the create user request
        Then the user should be created
