Feature: Add a product to a cart
  In order to buy products
  As a customer
  I first need to be able to add them to my cart

Scenario: Add products to a cart
  Given a empty cart
  When I add the products to the cart:
    | Name      | Price |
    | Boomerang | 15.99 |
    | Toaster   | 49.99 |
  Then the cart should contain:
    """
    Boomerang
    Toaster
    """