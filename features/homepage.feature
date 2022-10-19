Feature: Homepage
  In order to see Homepage
  As a client
  I need to access homepage

  Rules:
  - No rules

  Scenario: Acces to homepage
    Given The homepage is alive
    When I access the homepage
    Then I should see it
    And Script is valid