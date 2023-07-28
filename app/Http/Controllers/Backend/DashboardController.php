<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller 
{
    public function dashboard(Request $request)
    {
        // echo "Login Hello";
        // // die();
        return view('backend.dashboard.list');
    }
}

?>