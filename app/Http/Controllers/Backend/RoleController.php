<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    ///// ROLES

    /**
     * Display List of Role data.
     */
    public function AllRole() {
        $roles = Role::all();

        return view('backend.pages.role.all_role', compact('roles'));
    } // End Method

    /**
     * Display add new role form.
     */
    public function AddRole() {
        return view('backend.pages.role.add_role');
    } // End Method

    /**
     * Insert new role data.
     */
    public function StoreRole(Request $request){
        Role::create(['name' => $request->name]);

        $notification = array(
            'message'       => 'Role Created Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('all.role')->with($notification);
    } // End Method

    /**
     * Display edit role form.
     */
    public function EditRole($id){
        $role = Role::findOrFail($id);

        return view('backend.pages.role.edit_role',compact('role'));
    } // End Method

    /**
     * Update role data.
     */
    public function UpdateRole(Request $request){
        $id = $request->id;

        Role::findOrFail($id)->update([
            'name' => $request->name
        ]);

        $notification = array(
            'message'       => 'Role Updated Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('all.role')->with($notification);
    } // End Method

    /**
     * Delete role data.
     */
    public function DeleteRole($id) {
        Role::findOrFail($id)->delete();

        $notification = array(
            'message'       => 'Role Deleted Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

    /**
     * Display all role in permission.
     */
    public function AllRolePermission() {
        $roles = Role::all();

        return view('backend.pages.rolesetup.all_role_permission', compact('roles'));
    } // End Method

    /**
     * Display add role in permission.
     */
    public function AddRolePermission() {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('backend.pages.rolesetup.add_role_permission', compact('roles','permissions','permission_groups'));
    } // End Method

    /**
     * Insert role in permission.
     */
    public function StoreRolePermission(Request $request) {
        $data = array();
        $permissions = $request->permission;

        foreach($permissions as $key => $item){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        } // end foreach

        $notification = array(
            'message'       => 'Role Permission Added Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('all.role.permission')->with($notification);
    } // End Method

    /**
     * Display Admin Edit Role Form.
     * @var id int
     */
    public function AdminEditRole($id) {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('backend.pages.rolesetup.edit_role_permission', compact('role','permissions','permission_groups'));

    } // End Method

    /**
     * Update Admin Edit Role Data.
     * @var id int
     */
    public function AdminUpdateRole(Request $request, $id) {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if(!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        $notification = array(
            'message'       => 'Role Permission Updated Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('all.role.permission')->with($notification);
    } // End Method

    /**
     * Delete Admin Role Data.
     * @var id int
     */
    public function AdminDeleteRole($id) {
        $role = Role::findOrFail($id);

        if(!is_null($role)) {
            $role->delete();
        }

        $notification = array(
            'message'       => 'Role Permission Deleted Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

}
