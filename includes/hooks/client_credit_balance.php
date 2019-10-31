<?php
/**
 * WHMCS - Client Credit Balance (Multilingual)
 * 
 * Adding a "Credit Balance" panel to the client area home page.
 * 
 * @package    WHMCS
 * @author     Ivan Petermann <contato@ivanpetermann.com>
 * @copyright  Copyright (c) Ivan Petermann 2019
 * @version    1.1.1
 * @link       https://github.com/petermann/whmcs-client-credit-balance
 */

use WHMCS\View\Menu\Item as Item;

add_hook('ClientAreaHomepagePanels', 1, function (Item $homePagePanels) {
  $client = Menu::context( "client" );
  $clientid = intval( $client->id );
  if ($client->credit > 0) {
    $currencyData = getCurrency($clientid);
    $bodyhtml = '<p>'.sprintf(Lang::trans('availcreditbaldesc'),formatCurrency($client->credit, $currencyData)).'.</p>';
    $creditPanel = $homePagePanels->addChild( 'Credit Balance', array(
      'label' => Lang::trans('availcreditbal'),
      'icon' => 'fa-money',
      'order' => '100',
      'extras' => array(
        'color' => 'green',
        'btn-link' => 'clientarea.php?action=addfunds',
        'btn-text' => Lang::trans('addfunds'),
        'btn-icon' => 'fa-plus',
      ),
      'bodyHtml' => $bodyhtml
    ));
  }
});
