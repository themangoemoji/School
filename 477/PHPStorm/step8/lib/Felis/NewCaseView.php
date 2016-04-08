<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/27/16
 * Time: 9:10 PM
 */

namespace Felis;


class NewCaseView extends View
{



    /**
     * NewCaseView constructor.
     */
    public function __construct(Site $site, $get, $session) {
        parent::__construct($site, $get, $session);
        $this->setTitle("New Case");
        $this->addLink("staff.php", "Staff");
        $this->addLink("cases.php", "Cases");
        $this->addLink("logout.php", "Log Out");
        $this->site = $site;

    }

    public function present() {
        $html = <<<HTML

<form method="post" action="post/newcase.php" name="namz" value="vallll">
	<fieldset>
		<legend>New Case</legend>
		<p>Client:
			<select name="client">
HTML;

        $users = new Users($this->site);
        foreach($users->getClients() as $client) {
            $id = $client['id'];
            $name = $client['name'];
            $html .= '<option value="' . $id . '">' . $name . '</option>';
        }

		$html .= <<<HTML
			</select>
		</p>

		<p>
			<label for="number">Case Number: </label>
			<input type="text" id="number" name="number" placeholder="Case Number">
		</p>

		<p><input type="submit" value="OK" name="ok"> <input type="submit" value="Cancel" name="cancel"></p>

	</fieldset>
</form>

HTML;

        return $html;
    }


}