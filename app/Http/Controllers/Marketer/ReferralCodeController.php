<?php

namespace App\Http\Controllers\Marketer;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\MembershipUser;
use App\Models\Provider;
use App\Models\Service;
use App\Models\User;
use App\Models\UserPrescription;
use App\Models\UserService;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class ReferralCodeController extends Controller
{
    public function index()
    {
        $referral_code = auth('marketers')->user()->referral_code;
        return view('marketer-dashboard.modules.referral-code.index', compact('referral_code'));
    }
}
