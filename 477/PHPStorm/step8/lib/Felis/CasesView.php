<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/16/16
 * Time: 4:07 PM
 */

namespace Felis;


class CasesView extends View
{

    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct() {
        $this->setTitle("Felis Investigations Cases");
        $this->addLink("logout.php", "Log Out");
    }

}