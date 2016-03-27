<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/20/16
 * Time: 10:38 PM
 */

namespace Felis;


class CasesController
{

    private $redirect;

    /**
     * LoginController constructor.
     * @param Site $site The Site object
     * @param assay $post $_POST
     */
    public function __construct(Site $site, array $post) {

        $root = $site->getRoot();

        if(isset($post['add'])) {
            $this->redirect = "$root/newcase.php";
        }
        else {
            $this->redirect = "$root/cases.php";
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