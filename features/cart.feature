Feature: Add a product to a cart
  In order to buy products
  As a customer
  I first need to be able to add them to my cart

Scenario: Add a single product to a cart
  Given a cart
  When I add a product called "Boomerang" to the cart
  And I add a product called "Toaster" to the cart
  Then I should get:
    """
    Boomerang
    Toaster
    """