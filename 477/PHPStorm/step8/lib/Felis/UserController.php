<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/29/16
 * Time: 1:48 PM
 */

namespace Felis;


class UserController extends Controller {
    public function __construct(Site $site, $post, &$session, $get) {
        parent::__construct($site, $session);
        $root = $site->getRoot();
        $this->redirect = "$root/users.php";



        $users = new Users($site);
        //
        // Determine if this is new user or editing an
        // existing user. We determine that by looking for
        // a hidden form element named "id". If there, it
        // gives the ID for the user we are editing. Otherwise,
        // we have no user, so I'll use an ID of 0 to indicate
        // that we are adding a new user.
        //


        if(isset($post['cancel'])) {
            $this->error("users.php", "User creation cancelled");
            return;
        }


        if(isset($post['id'])) {
            $id = strip_tags($post['id']);
        } else {
            $id = 0;
        }

        //
        // Get all of the stuff from the from
        //
        $email = strip_tags($post['email']);
        $name = strip_tags($post['name']);
        $phone = strip_tags($post['phone']);
        $address = strip_tags($post['address']);
        $notes = strip_tags($post['notes']);
        switch($post['role']) {
            case "admin":
                $role = User::ADMIN;
                break;

            case "staff":
                $role = User::STAFF;
                break;

            default:
                $role = User::CLIENT;
                break;
        }

        $row = array('id' => $id,
            'email' => $email,
            'name' => $name,
            'phone' => $phone,
            'address' => $address,
            'notes' => $notes,
            'password' => null,
            'joined' => null,
            'role' => $role
        );

        $editUser = new User($row);

        if ($id != 0) {
            $users->update($editUser);
        }

        else {
            // This is a new user
            $mailer = new Email();
            $users->add($editUser, $mailer);

        }








    }



}