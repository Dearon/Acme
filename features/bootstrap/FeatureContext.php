    <?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given a cart
     */
    public function aCart()
    {
        throw new PendingException();
    }

    /**
     * @When I add a product called :arg1 to the cart
     */
    public function iAddAProductCalledToTheCart($product)
    {
        throw new PendingException();
    }

    /**
     * @Then I should get:
     */
    public function iShouldGet(PyStringNode $expected)
    {
        throw new PendingException();
    }
}
