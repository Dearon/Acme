<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PhpSpec\Matcher\ArrayContainMatcher;
use Bossa\PhpSpec\Expect;
use Prophecy\Prophet;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    private $prophet;
    private $products;
    private $cart;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->prophet = new \Prophecy\Prophet;
    }

    /**
     * @Given a empty cart
     */
    public function aEmptyCart()
    {
        $this->cart = new Acme\Cart\Cart;
    }

    /**
     * @When I add the products to the cart:
     */
    public function iAddTheProductsToTheCart(TableNode $products)
    {
        foreach($products as $product) {
            $prophecy = $this->prophet->prophesize();
            $prophecy->willExtend('Acme\Product\Product');
            $prophecy->getName()->willReturn($product['Name']);
            $prophecy->getPrice()->willReturn($product['Price']);

            $this->cart->add($prophecy->reveal());
        }
    }

    /**
     * @When I remove the following product from the cart:
     */
    public function iRemoveTheFollowingProductFromTheCart(TableNode $products)
    {
        foreach($products as $product) {
            $prophecy = $this->prophet->prophesize();
            $prophecy->willExtend('Acme\Product\Product');
            $prophecy->getName()->willReturn($product['Name']);
            $prophecy->getPrice()->willReturn($product['Price']);

            $this->cart->remove($prophecy->reveal());
        }
    }

    /**
     * @Then the cart should contain:
     */
    public function theCartShouldContain(PyStringNode $expected)
    {
        $content = array();
        foreach ($this->cart->get() as $product) {
            $content[] = $product->getName();
        }

        foreach ($expected->getStrings() as $product) {
            expect($content)->shouldContain($product);
        }
    }

    /**
     * @Then the total price in the cart should be :total
     */
    public function theTotalPriceInTheCartShouldBe($total)
    {
        expect($this->cart->getPrice())->shouldBeLike($total);
    }
}
