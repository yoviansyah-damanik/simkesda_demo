<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\DataHelper;
use App\Helpers\AgentHelper;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BackendController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->agent = AgentHelper::get_agent();
        $this->kadis = DataHelper::get_kadis();
    }
}
