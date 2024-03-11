<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;
use App\Models\Amenities;

class PropertyTypeController extends Controller
{
    public function AllType(){
        $types = PropertyType::latest()->get();
        return view('backend.type.all_type', compact('types'));
    } // End Method

    public function AddType(){
        return view('backend.type.add_type');
    } // End Method

    public function StoreType(Request $request){
        $request->validate([
            'type' => 'required|unique:property_types|max:200',
            'icon' => 'required'
        ]);

        PropertyType::insert([
            'type' => $request->type,
            'icon' => $request->icon
        ]);

        $notification = array(
            'message'       => 'Property Type Created Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('all.type')->with($notification);

    } // End Method

    public function EditType($id){
        $types = PropertyType::findOrFail($id);

        return view('backend.type.edit_type', compact('types'));
    } // End Method

    public function UpdateType(Request $request){

        $pid = $request->id;

        PropertyType::findOrFail($pid)->update([
            'type' => $request->type,
            'icon' => $request->icon
        ]);

        $notification = array(
            'message'       => 'Property Type Updated Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('all.type')->with($notification);
    } // End Method

    public function DeleteType($id) {
        PropertyType::findOrFail($id)->delete();

        $notification = array(
            'message'       => 'Property Type Deleted Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

    //AMENITIES METHOD

    public function AllAmenity(){
        $amenities = Amenities::latest()->get();
        return view('backend.amenity.all_amenity', compact('amenities'));
    } // End Method

    public function AddAmenity(){
        return view('backend.amenity.add_amenity');
    } // End Method

    public function StoreAmenity(Request $request){
        Amenities::insert([
            'amenities_name' => $request->amenities_name
        ]);

        $notification = array(
            'message'       => 'Amenity Created Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('all.amenity')->with($notification);

    } // End Method

    public function EditAmenity($id){
        $amenities = Amenities::findOrFail($id);

        return view('backend.amenity.edit_amenity', compact('amenities'));
    } // End Method

    public function UpdateAmenity(Request $request){
        $pid = $request->id;

        Amenities::findOrFail($pid)->update([
            'amenities_name' => $request->amenities_name
        ]);

        $notification = array(
            'message'       => 'Amenity Updated Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('all.amenity')->with($notification);
    } // End Method

    public function DeleteAmenity($id) {
        Amenities::findOrFail($id)->delete();

        $notification = array(
            'message'       => 'Amenity Deleted Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

}
