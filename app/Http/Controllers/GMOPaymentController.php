<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GMOPaymentController extends Controller
{
    //
    public function index() {
        $gmo = new \Nekoding\GmoPaymentGateway\GmoPaymentGateway();

        // if you want interact with GMO Site API use this
        $siteApi = $gmo->useSiteApi();

        // if you want interact with GMO Shop API use this
        $shopApi = $gmo->useShopApi();

        $data = ['OrderID' => uniqid(), 'JobCd' => 'AUTH', 'Amount' => 1000, 'Method' => '', 'Token' => ''];
        $response = GmoPaymentGatewayFacade::creditCard()
                    ->entryTransaction($data, function (Basic $gmo) use (&$data) {
                        return $gmo->execTransaction($data);
                    });

        $response->getResult(); // it will return response from entry transaction and exec transaction process
        file_put_contents('1.txt', print_r($response, 1));
    }
}
