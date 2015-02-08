Feature: Remove a product to a cart
  In order to only buy the products I want
  As a customer
  I need to be able to remove some from my cart

Scenario: Remove a product from a cart
  Given a cart
  When I add a product called "Boomerang" to the cart
  And I add a product called "Toaster" to the cart
  And I remove a product called "Boomerang" from the cart
  Then the cart should contain:
    """
    Toaster
    """