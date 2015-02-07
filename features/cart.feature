Feature: Add a product to a cart
  In order to buy products
  As a customer
  I first need to be able to add them to my cart

Scenario: Add a single product to a cart
  Given a cart
  When I add a product called "Boomerang" to the cart
  Then I should get:
    """
    Boomerang
    """

Scenario: Add multiple products to a cart
  Given a cart
  When I add a product called "Boomerang" to the cart
  And I add a product called "Toaster" to the cart
  And I add a product called "Bat Costume" to the cart
  Then I should get:
    """
    Boomerang
    Toaster
    Bat Costume
    """