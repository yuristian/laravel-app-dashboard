<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function AllPermission() {
        $permissions = Permission::all();

        return view('backend.pages.permission.all_permission', compact('permissions'));
    }

    public function AddPermission() {
        return view('backend.pages.permission.add_permission');
    }

    public function StorePermission(Request $request){

        $permission = Permission::create(['name' => $request->name, 'group_name' => $request->group_name]);

        $notification = array(
            'message'       => 'Permission Created Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('all.permission')->with($notification);

    } // End Method

    public function EditPermission($id){
        $permission = Permission::findOrFail($id);

        return view('backend.pages.permission.edit_permission',compact('permission'));
    } // End Method

    public function UpdatePermission(Request $request){
        $id = $request->id;

        Permission::findOrFail($id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        $notification = array(
            'message'       => 'Permission Updated Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    } // End Method

    public function DeletePermission($id) {
        Permission::findOrFail($id)->delete();

        $notification = array(
            'message'       => 'Permission Deleted Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

    public function ImportPermission(){
        return view('backend.pages.permission.import_permission');
    } // End Method

    public function Export(){
        return Excel::download(new PermissionExport, 'permissions.xlsx');
    }

}
