<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/27/16
 * Time: 9:10 PM
 */

namespace Felis;


class UsersView extends View
{




    /**
     * NewCaseView constructor.
     */
    public function __construct(Site $site)
    {
        $this->setTitle("Felis Users");
        $this->addLink("staff.php", "Staff");
        $this->addLink("logout.php", "Log Out");
        $this->site = $site;

    }

    public function present() {
        $html = <<<HTML
<form class="table" method="post" action="post/users.php">
	<p>
	<input type="submit" name="add" id="add" value="Add">
	<input type="submit" name="edit" id="edit" value="Edit">
	<input type="submit" name="delete" id="delete" value="Delete">
	</p>

	<table>
		<tr>
			<th>&nbsp;</th>
			<th>Name</th>
			<th>Email</th>
			<th>Role</th>
		</tr>
HTML;

        $users = new Users($this->site);
        $all = $users->getAll();


        foreach($all as $user) {
            $name = $user['name'];
            $email = $user['email'];
            $role = $user['role'];
            $id = $user['id'];
            $role = $user['role'];


            $html .= <<<HTML
       <tr>
			<td><input type="radio" name="user" value="$id"></td>
			<td>$name</td>
			<td>$email</td>
			<td>$role</td>
		</tr>
HTML;
    }



    $html .= <<<HTML

	</table>
</form>

HTML;


            return $html;
    }


}