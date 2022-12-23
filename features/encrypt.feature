Feature: Encrypt
  In order to encrypt a value
  As a client
  I need to receipt a encrypted value after sended it

  Scenario: It receives an encrypted value
    When a demo scenario sends a request to "/"
    Then the response should be received
