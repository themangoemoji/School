<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/29/16
 * Time: 1:48 PM
 */

namespace Felis;


class UsersController {
    public function __construct(Site $site, User $user, array $post) {
        $root = $site->getRoot();
        $this->redirect = "$root/user.php";

        if(isset($post['user'])) {
            $id = $post['user'];
        }

        if(isset($post['edit'])) {
            $this->redirect = "$root/user.php?u=$id";
        }

        if(isset($post['delete'])) {
            $users = new Users($site);
            $id = $post['user'];
            $users->delete($id);


            $this->redirect = "$root/users.php";
        }

    }




    /**
     * @return mixed
     */
    public function getRedirect() {
        return $this->redirect;
    }


    private $redirect;	///< Page we will redirect the user to.
}