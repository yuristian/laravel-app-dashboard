<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function AdminDashboard() {
        return view('admin.index');
    } // End Method

    /**
     * Display admin login form.
     */
    public function AdminLogin() {
        return view('admin.admin_login');
    } // End Method

    /**
     * Display admin's profile.
     */
    public function AdminProfile() {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin_profile_view', compact('profileData'));
    } // End Method

    /**
     * Insert admin profile data.
     */
    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message'       => 'Admin Profile Updated Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

    /**
     * Display admin change password form.
     */
    public function AdminChangePassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin_change_password', compact('profileData'));
    } // End Method

    /**
     * Update admin password.
     */
    public function AdminUpdatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        //Match the old password
        if(!Hash::check($request->old_password,auth::user()->password)){
            $notification = array(
                'message'       => 'Old Password Does Not Match',
                'alert-type'    => 'error'
            );

            return back()->with($notification);
        }

        //Update new password
        User::whereid(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message'       => 'Password Changed Successfully',
            'alert-type'    => 'success'
        );

        return back()->with($notification);
    } // End Method

    /**
     * Admin logout.
     */
    public function AdminLogout(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    } // End Method

    /**
     * Display List of All Admin.
     */
    public function AllAdmin() {
        $admins = User::where('role','admin')->get();

        return view('backend.pages.admin.all_admin', compact('admins'));
    } // End Method

    /**
     * Display Add Admin Form.
     */
    public function AddAdmin() {
        $roles = Role::all();
        return view('backend.pages.admin.add_admin', compact('roles'));
    } // End Method

    /**
     * Insert New Admin Data.
     */
    public function StoreAdmin(Request $request) {
        $user = New User;
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message'       => 'New Admin Inserted Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('all.admin')->with($notification);

    } // End Method

    /**
     * Display Edit Admin Form.
     */
    public function EditAdmin($id) {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('backend.pages.admin.edit_admin', compact('user','roles'));
    } // End Method

    /**
     * Update Admin Data.
     */
    public function UpdateAdmin(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        $user->roles()->detach();
        if($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message'       => 'Admin User Updated Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    } // End Method

    /**
     * Delete Admin Data.
     */
    public function DeleteAdmin($id) {
        $user = User::findOrFail($id);
        if(!is_null($user)){
            $user->delete();
        }

        $notification = array(
            'message'       => 'Admin User Deleted Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method
}
