<?php

namespace App\Http\Controllers\Base;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function renderAdminPage()
    {
        return view('sites.admin.material.app');
    }

    public function renderCustomerPage()
    {
        return view('sites.customer.exzo.app');
    }
}
