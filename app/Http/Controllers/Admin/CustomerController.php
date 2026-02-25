<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers.
     */
    public function index()
    {
        $customers = User::where('is_admin', false)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.customers.index', compact('customers'));
    }
}
