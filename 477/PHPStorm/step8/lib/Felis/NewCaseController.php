<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/28/16
 * Time: 1:17 AM
 */

namespace Felis;


class NewCaseController extends Controller
{

    /**
     * LoginController constructor.
     * @param Site $site The Site object
     * @param assay $post $_POST
     */
    public function __construct(Site $site, User $user, array $post, &$session) {
        parent::__construct($site, $session);
        $root = $site->getRoot();
        $cases = new Cases($site);

        if(!isset($post['ok'])) {




            $this->redirect = "$root/cases.php";
            return;
        }

        $caseNum = $post['number'];

        if($cases->exists($caseNum)) {
            $this->error("newcase.php", "That case number already exists!");
            return;
        }

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