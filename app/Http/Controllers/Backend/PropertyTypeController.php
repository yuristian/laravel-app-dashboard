<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;
use App\Models\Amenities;

class PropertyTypeController extends Controller
{
    /**
     * Display List of All Property Type.
     */
    public function AllType(){
        $types = PropertyType::latest()->get();
        return view('backend.type.all_type', compact('types'));
    } // End Method

    /**
     * Display add property type form.
     */
    public function AddType(){
        return view('backend.type.add_type');
    } // End Method

    /**
     * Insert new property type
     */
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

    /**
     * Display property type form.
     */
    public function EditType($id){
        $types = PropertyType::findOrFail($id);

        return view('backend.type.edit_type', compact('types'));
    } // End Method

    /**
     * Update property type data.
     */
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

    /**
     * Delete property type.
     */
    public function DeleteType($id) {
        PropertyType::findOrFail($id)->delete();

        $notification = array(
            'message'       => 'Property Type Deleted Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

    //AMENITIES METHOD

    /**
     * Display list of all amenities.
     */
    public function AllAmenity(){
        $amenities = Amenities::latest()->get();
        return view('backend.amenity.all_amenity', compact('amenities'));
    } // End Method

    /**
     * Display add amenities form.
     */
    public function AddAmenity(){
        return view('backend.amenity.add_amenity');
    } // End Method

    /**
     * Insert new amenities data.
     */
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

    /**
     * Display edit amenities form.
     */
    public function EditAmenity($id){
        $amenities = Amenities::findOrFail($id);

        return view('backend.amenity.edit_amenity', compact('amenities'));
    } // End Method

    /**
     * Update amenities data.
     */
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

    /**
     * Delete amenities data.
     */
    public function DeleteAmenity($id) {
        Amenities::findOrFail($id)->delete();

        $notification = array(
            'message'       => 'Amenity Deleted Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

}
