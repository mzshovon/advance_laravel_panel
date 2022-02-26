<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function view() {
        $data = array();
        $data['roles'] = Role::with('permissions','users')->get();
        return view('panel.role.view',$data);
    }
    public function store(Request $request) {

    }
    public function update(Request $request) {

    }
    public function delete() {

    }
}
