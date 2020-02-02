<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveLeadRequest;
use App\Lead;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }
}
