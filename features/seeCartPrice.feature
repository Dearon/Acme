Feature: See the price of the products in the cart
  In order to know how expensive my order will be
  As a customer
  I need to be able to see the total price of the products in my cart

  Scenario: Show cart price
    Given a empty cart
    And the following products:
      | Name      | Price |
      | Boomerang | 15.99 |
      | Toaster   | 49.99 |
    When I add a the products to the cart
    Then the total price in the cart should be "65.98"