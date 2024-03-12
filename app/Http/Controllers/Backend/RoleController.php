<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display List of Permission data.
     */
    public function AllPermission() {
        $permissions = Permission::all();

        return view('backend.pages.permission.all_permission', compact('permissions'));
    } // End Method

    /**
     * Display add new permission form.
     */
    public function AddPermission() {
        return view('backend.pages.permission.add_permission');
    } // End Method

    /**
     * Insert new permission data.
     */
    public function StorePermission(Request $request){

        $permission = Permission::create(['name' => $request->name, 'group_name' => $request->group_name]);

        $notification = array(
            'message'       => 'Permission Created Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('all.permission')->with($notification);

    } // End Method

    /**
     * Display edit permission form.
     */
    public function EditPermission($id){
        $permission = Permission::findOrFail($id);

        return view('backend.pages.permission.edit_permission',compact('permission'));
    } // End Method

    /**
     * Update permission data.
     */
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

    /**
     * Delete permission data.
     */
    public function DeletePermission($id) {
        Permission::findOrFail($id)->delete();

        $notification = array(
            'message'       => 'Permission Deleted Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

    /**
     * Display import permission form.
     */
    public function ImportPermission(){
        return view('backend.pages.permission.import_permission');
    } // End Method

    /**
     * Export permission data to xlsx.
     */
    public function Export(){
        return Excel::download(new PermissionExport, 'permissions.xlsx');
    } // End Method

    /**
     * Import permission data from xlsx.
     */
    public function Import(Request $request){
        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification = array(
            'message'       => 'Permission Imported Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

}
