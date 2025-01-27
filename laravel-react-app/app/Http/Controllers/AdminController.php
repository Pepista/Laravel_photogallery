<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Show the admin panel with uploaded images
    public function index()
    {
        // Fetch all images from the database
        $images = Image::all();

        // Pass the images to the view
        return view('admin', compact('images'));
    }

    // Handle image upload
    public function upload(Request $request)
    {
        // Validate the uploaded image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the image in the 'public/images' directory
        $image = $request->file('image');
        $filename = $image->store('images', 'public');
        
        // Save the filename in the database
        Image::create(['filename' => $filename]);

        // Redirect back with success message
        return redirect()->route('admin.index')->with('success', 'Image uploaded successfully!');
    }

    // Handle image removal
    public function remove($id)
    {
        // Find the image by ID
        $image = Image::findOrFail($id);

        // Define the file path
        $filePath = 'public/images/'.$image->filename;

        // Ensure the file exists before attempting to delete it
        if (Storage::exists($filePath)) {
            // Delete the image from storage
            Storage::delete($filePath);

            // Delete the image record from the database
            $image->delete();

            // Redirect back with success message
            return redirect()->route('admin.index')->with('success', 'Image removed successfully!');
        } else {
            // Handle case where image file does not exist
            return redirect()->route('admin.index')->with('error', 'Image file not found!');
        }
    }
}
