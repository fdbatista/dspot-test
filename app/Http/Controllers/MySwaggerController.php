<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MySwaggerController extends Controller
{
    public function index(): Factory|View|Application
    {
        $urlToDocs = url('/doc/json');

        return view('vendor.swagger.index', ['urlToDocs' => $urlToDocs]);
    }
}
