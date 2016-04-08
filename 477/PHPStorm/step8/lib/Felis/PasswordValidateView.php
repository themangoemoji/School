<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/29/16
 * Time: 7:41 PM
 */

namespace Felis;


class PasswordValidateView extends View
{

    public function __construct(Site $site, $get, $session) {
        parent::__construct($site, $get, $session);
        $this->setTitle("Felis Password Entry");
        $this->site = $site;

        // If an error was thrown, don't go looking for the non-existent validator tag
        if ($this->errorThrown()) {
            $this->validator = '';
        }

        // If no error thrown, get the validator, move on
        else {

            $this->validator = strip_tags($get['v']);
        }

    }

    public function present() {
        $html = <<<HTML
<form method="post" action="post/password-validate.php">
    <input type="hidden" name="validator" value="$this->validator">

	<fieldset>
		<legend>Change Password</legend>
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email">
		</p>
		<p>
			<label for="password">Password</label><br>
			<input type="password" id="password" name="password" placeholder="password">
		</p>
		<p>
			<label for="password">Password (again)</label><br>
			<input type="password" id="password_verify" name="password_verify" placeholder="password">
		</p>

		<p>
			<input type="submit" value="OK"> <input type="submit" value="Cancel" name="cancel">
		</p>

		</fieldset>
</form>

HTML;

        return $html;

    }



}