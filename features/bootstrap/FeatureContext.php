    <?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PhpSpec\Matcher\ArrayContainMatcher;
use Bossa\PhpSpec\Expect;
use Prophecy\Prophet;

use Acme\Cart;
use Acme\ProductRepository;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    private $prophet;
    private $products;
    private $cart;
    private $productRepository;

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
        $this->productRepository = new ProductRepository();
    }

    /**
     * @Given a empty cart
     */
    public function aEmptyCart()
    {
        $this->cart = new Cart;
    }

    /**
     * @Given the following products:
     */
    public function theFollowingProducts(TableNode $products)
    {
        foreach($products as $product) {
            $prophecy = $this->prophet->prophesize();
            $prophecy->willExtend('Acme\Product');
            $prophecy->getName()->willReturn($product['Name']);
            $prophecy->getPrice()->willReturn($product['Price']);
            $this->products[] = $prophecy->reveal();
        }
    }

    /**
     * @When I add a the products to the cart
     */
    public function iAddATheProductsToTheCart()
    {
        foreach($this->products as $product)
        {
            $this->cart->add($product);
        }
    }

    /**
     * @When I add a product called :product to the cart
     */
    public function iAddAProductCalledToTheCart($product)
    {
        $this->cart->add($this->productRepository->find($product));
    }

    /**
     * @When I remove a product called :product from the cart
     */
    public function iRemoveAProductCalledFromTheCart($product)
    {
        $this->cart->remove($this->productRepository->find($product));
    }

    /**
     * @Then the cart should contain:
     */
    public function theCartShouldContain(PyStringNode $expected)
    {
        $content = array();
        foreach ($this->cart->get() as $product) {
            $content[] = $product['name'];
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
