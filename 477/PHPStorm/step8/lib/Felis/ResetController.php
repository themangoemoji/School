<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/28/16
 * Time: 10:42 PM
 */

namespace Felis;


class ResetController extends Controller
{


    /**
     * Get the redirect location link.
     * @return page to redirect to.
     */
    public function getRedirect() {
        return $this->redirect;
    }


    protected $redirect;	///< Page we will redirect the user to.

    protected $site;		///< The Site object



    /**
     * HomeController constructor.
     * @param Site $site Site object
     * @param array $post $_POST
     * @param array $session $_SESSION
     */
    public function __construct(Site $site, array $post) {
        $root = $site->getRoot();
        $this->redirect = "$root/reset.php";

        $users = new Users($site);

        // Ensure they aren't lying about their email!
        $validators = new Validators($site);
        $email = $post['email'];
        if (!$users->exists($email)) {

            $this->error("reset.php", "Liar! That's not a valid email address!");

            return;
        }


        return;
    }



}