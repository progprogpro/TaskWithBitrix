<?php

namespace App\Http\Controllers\Autoria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Curl;

class AutoriaController extends Controller
{

    private $API_KEY;
    private $AUTO_CATEGORIES_URL;
    private $AUTO_MARKS_URL;
    private $AUTO_MODELS_URL;

    public function __construct()
    {
        $this->API_KEY = config('api.autoria.api_key');
        $this->AUTO_CATEGORIES_URL = str_replace(':API_KEY_AUTORIA', $this->API_KEY, config('api.autoria.auto_categories_url'));
        $this->AUTO_MARKS_URL = str_replace(':API_KEY_AUTORIA', $this->API_KEY, config('api.autoria.auto_marks_url'));
        $this->AUTO_MODELS_URL = str_replace(':API_KEY_AUTORIA', $this->API_KEY, config('api.autoria.auto_models_url'));
    }

    public function marks(Request $request)
    {
        // get full url with parameters
        $url = str_replace(':categoryId', $request->categoryId, $this->AUTO_MARKS_URL);

        // send request
        $result = Curl::to($url)->get();

        return $result;
    }
    public function models(Request $request)
    {
        // get full url with parameters
        $url = str_replace([ ':categoryId', ':markId' ], [ $request->categoryId, $request->markId ], $this->AUTO_MODELS_URL);

        // send request
        $result = Curl::to($url)->get();

        return $result;
    }
    public function categories()
    {
        // send request
        $result = Curl::to($this->AUTO_CATEGORIES_URL)->get();

        return $result;
    }
}
