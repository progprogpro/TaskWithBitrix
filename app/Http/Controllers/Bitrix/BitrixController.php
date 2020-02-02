<?php

namespace App\Http\Controllers\Bitrix;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BitrixController extends Controller
{

    private $BITRIX_API_URL;
    private $client_id;
    private $client_secret;

    public function __construct()
    {
        $this->client_id = config('api.bitrix.client_id');
        $this->client_secret = config('api.bitrix.client_secret');
        $this->BITRIX_API_URL = str_replace(':auth', $this->auth, config('api.bitrix.api_url'));
    }

}
