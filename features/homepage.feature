Feature: Homepage
  In order to see Homepage
  As a client
  I need to access homepage

  Rules:
  - No rules

  Scenario: It receives a response from Symfony's kernel
    When a demo scenario sends a request to "/"
    Then the response should be received

  Scenario: Acces to homepage
    Given The homepage is alive
    When I access the homepage
    Then I should see it
    And Script is valid