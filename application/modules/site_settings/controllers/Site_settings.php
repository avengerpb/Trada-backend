<?php
class Site_settings extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _get_item_segments()
{
    // return the segments for the store items pages (product pages)
    $segments = 'index.php/musical/instrument/';
    return $segments;
}

function _get_items_segments()
{
    // return the segments for the store category pages
    $segments = 'index.php/musical/instruments/';
    return $segments;
}

}