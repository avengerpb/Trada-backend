<?php
class Site_security extends MX_Controller 
{

    function __construct() {
    parent::__construct();
    }

    function _make_sure_is_admin()
    {
        $is_admin = true;

        if ($is_admin != true) {
            redirect('site_security/not_allowed');
        }
    }

    function not_allowed()
    {
        echo 'Fuck u bitch';
    }

}