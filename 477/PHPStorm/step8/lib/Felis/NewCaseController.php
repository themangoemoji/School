<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/28/16
 * Time: 1:17 AM
 */

namespace Felis;


class NewCaseController
{
    private $redirect;

    /**
     * LoginController constructor.
     * @param Site $site The Site object
     * @param assay $post $_POST
     */
    public function __construct(Site $site, User $user, array $post) {

        $root = $site->getRoot();
        if(!isset($post['ok'])) {
            $this->redirect = "$root/cases.php";
            return;
        }

        $cases = new Cases($site);
        $id = $cases->insert(strip_tags($post['client']),
            $user->getId(),
            strip_tags($post['number']));

        if($id === null) {
            $this->redirect = "$root/newcase.php?e";
        } else {
            $this->redirect = "$root/case.php?id=$id";
        }

    }




    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }	///< Page we will redirect the user to.

}