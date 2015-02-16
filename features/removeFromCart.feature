Feature: Remove a product to a cart
  In order to only buy the products I want
  As a customer
  I need to be able to remove some from my cart

Scenario: Remove a product from a cart
  Given a empty cart
  When I add the products to the cart:
    | Name      | Price |
    | Boomerang | 15.99 |
    | Toaster   | 49.99 |
  And I remove the following product from the cart:
    | Name      | Price |
    | Boomerang | 15.99 |
  Then the cart should contain:
    """
    Toaster
    """