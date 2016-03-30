<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/29/16
 * Time: 7:41 PM
 */

namespace Felis;


class ResetView extends View
{

    protected $site;

    public function __construct(Site $site, $get) {
        $this->setTitle("Felis Password Entry");
        $this->site = $site;
    }

    public function present() {
        $html = <<<HTML
    <form method="post" action="post/reset.php">
        <fieldset>
            <legend>Lost Password?</legend>

            <br>

            <p>
                It's okay, it happens to the best of us.
            </p>
            <p>
                Enter the email account you lost the password to and we'll email you a link to reset it.
            </p>

            <br>

            <p>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" placeholder="Email">
            </p>




            <p>
                <input type="submit" value="Reset">
            </p>

        </fieldset>
    </form>

HTML;

        $html .= $this->errorMsg();

        return $html;

    }


}