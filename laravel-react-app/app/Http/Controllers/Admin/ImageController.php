<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function __construct()
    {
        // Allow access only to Pedro (specific email)
        $this->middleware(function ($request, $next) {
            if (Auth::user()->email !== 's2022CechakPetr@skolabaltaci.cz') {
                // Redirect to the homepage if the user is not Pedro
                return redirect('/')->with('error', 'You do not have permission to access this page.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        // Get all the images stored in the "public/images" directory
        $images = Storage::files('public/images');
        
        // Ensure images is always an array (even if it's null)
        $images = is_array($images) ? $images : [];

        // Pass the images array to the Blade view
        return view('admin.index', compact('images'));
    }

    public function upload(Request $request)
    {
        // Validate the image file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Generate a unique name for the image using the current timestamp
        $imageName = time() . '.' . $request->image->extension();

        // Store the image in the "public/images" folder (public folder will be available in the storage link)
        $request->image->storeAs('public/images', $imageName);

        // Redirect back to the admin panel with a success message
        return back()->with('success', 'Image uploaded successfully!');
    }
}
