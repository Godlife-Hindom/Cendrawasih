<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Subcriteria;

class UserCriteriaController extends Controller
{
    public function index()
    {
        $criteria = Criteria::with('subcriteria')->get();

        return view('user.criteria.index', compact('criteria'));
    }
}
