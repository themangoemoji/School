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


        if (isset($post['cancel'])) {
            $this->redirect = "$root/";
            return $this->redirect;
        }


        // The OK button was pressed
        // Get the values and do some error checking
        $password = trim(strip_tags($post['password']));
        $password_verify = trim(strip_tags($post['password_verify']));
        if ($password != $password_verify) {
            // No title entered
            $this->error("password-validate.php", "Passwords did not match!");
            return;
        }

        // THE VALIDATION
        // 1. Ensure the validator is correct! Use it to get the user ID.
        // 2. Destroy the validator record so it can't be used again!
        //
        $validators = new Validators($site);
        if (!isset($post['validator'])) {
            $this->error("password-validate.php", "Are you sure you're supposed to be here?");
            return;
        }

        $userid = $validators->getMoreThanOnce($post['validator']);
        if($userid === null) {
            $this->error("password-validate.php", "Are you sure you're supposed to be here?");
            return;
        }


        $users = new Users($site);
        $editUser = $users->get($userid);
        if($editUser === null) {
            // User does not exist!
            $this->error("password-validate.php", "We could not find that user.");
            return;
        }


        // Check for an email
        $email = trim(strip_tags($post['email']));
        if($email !== $editUser->getEmail()) {
            // Email entered is invalid
            $this->error("password-validate.php", "We couldnt find that email!");
            return;
        }


        // Make sure password is long enough
        if(strlen($password) < 8) {
            // Password too short
            $this->error("password-validate.php", "You password must be longer than 8 characters, doofus.");
            return;
        }

        $userid = $validators->getOnce($post['validator']);
        if($userid === null) {
            $this->error("password-validate.php", "Are you sure you're supposed to be here?");
            return;
        }

        $users->setPassword($userid, $password);







    }



}