Feature: Encrypt
  In order to see an encrypted value
  I need to send a form with clear data

  Scenario: It receives an encrypted value
    When the encrypt form is sended
    Then the encrypted value should be seen
