    <?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PhpSpec\Matcher\ArrayContainMatcher;
use Bossa\PhpSpec\Expect;

use Acme\Cart;
use Acme\ProductRepository;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
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
        $this->productRepository = new ProductRepository();
    }

    /**
     * @Given a cart
     */
    public function aCart()
    {
        $this->cart = new Cart;
    }

    /**
     * @When I add a product called :arg1 to the cart
     */
    public function iAddAProductCalledToTheCart($product)
    {
        $this->cart->add($this->productRepository->find($product));
    }

    /**
     * @Then the cart should contain:
     */
    public function theCartShouldContain(PyStringNode $string)
    {
        $content = array();
        foreach ($this->cart->get() as $product) {
            $content[] = $product['name'];
        }

        foreach ($expected->getStrings() as $product) {
            expect($content)->shouldContain($product);
        }
    }
}
