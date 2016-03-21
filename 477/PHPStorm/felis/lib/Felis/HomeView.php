<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/16/16
 * Time: 2:21 PM
 */

namespace Felis;


class HomeView extends View
{

    /*Begin Member Variables
    -----------------------*/

    private $testimonial_left_side = true;  ///< Denotes which side the next testimonial will be added to
    private $testimonial_left_quotes = array();
    private $testimonial_right_quotes = array();

    /*--------------------
    End Member Variables*/


    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct() {
        $this->setTitle("Felis Investigations");
        $this->addLink("login.php", "Log in");
    }


    /**
     * Add content to the header
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional() {
        return <<<HTML
<p>Welcome to Felis Investigations!</p>
<p>Domestic, divorce, and carousing investigations conducted without publicity. People and cats shadowed
	and investigated by expert inspectors. Katnapped kittons located. Missing cats and witnesses located.
	Accidents, furniture damage, losses by theft, blackmail, and murder investigations.</p>
<p><a href="">Learn more</a></p>
HTML;
    }

    /**
     * Add Testimonial to the left or right side of the testimonial page
     * Split the Testimonials 50/50
     * EXAMPLE:
     * > $view->addTestimonial('quote', 'author');
     */
    public function addTestimonial($quote, $author = 'anonymous') {

        // Add to the left array
        if ($this->testimonial_left_side) {
            $this->testimonial_left_quotes[$author] = $quote;
        }
        // Add to right side
        else {
            $this->testimonial_right_quotes[$author] = $quote;
        }

        $this->testimonial_left_side = !$this->testimonial_left_side;

    }


    /**
     * Display the testimonials laid out in 50 / 50 on the left and right sides
     */
    public function testimonials()
    {
        $html = " <section class=\"testimonials\"><h2>TESTIMONIALS</h2>";

        // Start the Left Side
        $html .= "<div class=\"left\">";

        // Add all the right testimonials in
        foreach ($this->testimonial_left_quotes as $author => $quote) {

            // The content of the testimonial
            $html .= "<blockquote><p>$quote</p><p><cite>$author</cite></p></blockquote>";

        }

        // End the Left Side
        $html .= "</div>";


        // Start the Right Side
        $html .= "<div class=\"right\">";

        foreach ($this->testimonial_right_quotes as $author => $quote) {

            // The content of the testimonial
            $html .= "<blockquote><p>$quote</p><p><cite>$author</cite></p></blockquote>";

        }

        // End the Right Side
        $html .= "</div>";


        // End the testimonials
        $html .= "</section>";

        return $html;
    }

}