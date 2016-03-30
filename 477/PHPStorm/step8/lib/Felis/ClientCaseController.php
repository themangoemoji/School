<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/28/16
 * Time: 10:42 PM
 */

namespace Felis;


class ClientCaseController
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
    public function __construct(Site $site, $post, $get) {
        $this->site = $site;
        $root = $site->getRoot();
//        var_dump($_SESSION['user']);
        if(isset($post['update'])) {
            $this->redirect = "$root/cases.php";
            // Edit or add?
           if(isset($get['id'])) {
                $id = $get['id'];
            }
            else {
                $id = null;
            }

            // The OK button was pressed
            // Get the values and do some error checking
            $number = trim(strip_tags($post['number']));
            if($number === '') {
                return;
            }

            $status = trim(strip_tags($post['status']));
            if($status === '') {
                return;
            }

            $agent = trim(strip_tags($post['agent']));
            if($agent === '') {
                return;
            }

            $summary = trim(strip_tags($post['summary']));
            if($summary=== '') {
                return;
            }


            $cases = new Cases($this->site);
            $caseOI = $cases->get($id);

            $row = array("id" => $id, "number" => $number, "status" => $status, "summary" => $summary,
                "agent" => $caseOI->getAgent(), "agentName" => $caseOI->getAgentName(),
                "client" => $caseOI->getClient(), "clientName" => $caseOI->getClientName() );
            $clientcase = new ClientCase($row);

            $cases = new Cases($this->site);

            if($id === null) {
                //
                // Try to insert
                //
                $id = $cases->add($clientcase);
                if($id === false) {
                    return;
                }
            } else {
                //
                // Try to edit
                //
                if(!$cases->update($clientcase, $id)) {
                    return;
                }
            }

            //
            // And redirect back to home
            //
            $this->redirect = "$root/cases.php";
        } else {
            // Cancel was pressed, just return to the home page
            $this->redirect = "$root/cases.php";
        }

    }

}