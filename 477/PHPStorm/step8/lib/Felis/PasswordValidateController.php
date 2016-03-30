<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/28/16
 * Time: 10:42 PM
 */

namespace Felis;


class PasswordValidateController extends Controller
{



    /**
     * HomeController constructor.
     * @param Site $site Site object
     * @param array $post $_POST
     * @param array $session $_SESSION
     */
    public function __construct(Site $site, $post, &$session)
    {
        parent::__construct($site, $session);

        $root = $site->getRoot();

        // Get the validator


        // The OK button was pressed
        // Get the values and do some error checking
        $password = trim(strip_tags($post['password']));
        $password_verify = trim(strip_tags($post['password_verify']));
        if ($password != $password_verify) {
            // No title entered
            $this->error("password-validate.php", "Passwords did not match!");
            return;
        }


        //
        // 1. Ensure the validator is correct! Use it to get the user ID.
        // 2. Destroy the validator record so it can't be used again!
        //
        $validators = new Validators($site);
        $userid = $validators->getOnce($post['validator']);
        if($userid === null) {
            $this->redirect = "$root/password-validate.php?e";
            return;
        }


        $users = new Users($site);
        $editUser = $users->get($userid);
        if($editUser === null) {
            // User does not exist!
            $this->redirect = "$root/";
            return;
        }

        $email = trim(strip_tags($post['email']));
        if($email !== $editUser->getEmail()) {
            // Email entered is invalid
            $this->redirect = "$root/password-validate.php?e";
            return;
        }

        $password1 = trim(strip_tags($post['password']));
        $password2 = trim(strip_tags($post['password2']));
        if($password1 !== $password2) {
            // Passwords do not match
            $this->redirect = "$root/password-validate.php?e";
            return;
        }

        // Check user input
        if($password1 != $password2) {
            // Login failed
            $this->redirect = "$root/password-validate.php?e";
        }

        if(strlen($password1) < 8) {
            // Password too short
            $this->redirect = "password-validate.php?e";
            return;
        }

        $users->setPassword($userid, $password1);
    }



}