<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/27/16
 * Time: 9:10 PM
 */

namespace Felis;


class UserView extends View
{

    private $id = null;



    /**
     * NewCaseView constructor.
     */
    public function __construct(Site $site, $get)
    {
        $this->setTitle("Felis Users");
        $this->addLink("staff.php", "Staff");
        $this->addLink("logout.php", "Log Out");
        $this->site = $site;

        if (isset($get['u'])) {
            $this->id = strip_tags($get['u']);
        }


    }

    public function present() {



        if(!is_null($this->id)) {

            $users = new Users($this->site);
            $user = $users->get($this->id);

            $email = $user->getEmail();
            $name = $user->getName();
            $phone = $user->getPhone();
            $address = $user->getAddress();
            $role = $user->getRole();
            $notes = $user->getNotes();

        }

            else {
                $email = '';
                $name = '';
                $phone = '';
                $address = '';
                $role = '';
                $notes = '';
            }



        $html = <<<HTML
<form method="post" action="post/user.php">
	<fieldset>
		<legend>User</legend>
		<p>

			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email" value=$email>
		</p>
		<p>
			<label for="name">Name</label><br>
			<input type="text" id="name" name="name" placeholder="Name" value=$name>
		</p>
		<p>
			<label for="phone">Phone</label><br>
			<input type="text" id="phone" name="phone" placeholder="Phone" value=$phone>
		</p>
		<p>
			<label for="address">Address</label><br>
			<textarea id="address" name="address" placeholder="Address" value=$address></textarea>
		</p>
		<p>
			<label for="notes">Notes</label><br>
			<textarea id="notes" name="notes" placeholder="Notes" value=$notes></textarea>
		</p>
		<p>
			<label for="role">Role: </label>
			<select id="role" name="role">
				<option value="admin">Admin</option>
				<option value="staff">Staff</option>
				<option value="client">Client</option>
			</select>
		</p>
		<p>
			<input type="submit" value="OK"> <input type="submit" value="Cancel" name="cancel">
		</p>

	</fieldset>
</form>

<p>
		Admin users have complete management of the system. Staff users are able to view and make
		reports for any client, but cannot edit the users. Clients can only view the cases
		they have contracted for.
	</p>
HTML;

        return $html;
    }


}