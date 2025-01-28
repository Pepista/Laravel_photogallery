<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Zobrazení admin panelu s nahranými obrázky
     */
    public function index()
    {
        // Získání všech obrázků pro admin panel
        $images = Image::all();

        // Vracení view s předanými obrázky
        return view('admin.index', compact('images'));
    }

    /**
     * Zpracování nahrání obrázku
     */
    public function upload(Request $request)
    {
        // Validace vstupu
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  // Ověření typu a velikosti obrázku
            'description' => 'nullable|string|max:255',  // Popis je volitelný, s maximální délkou 255 znaků
        ]);

        // Uložení obrázku do složky 'public/images'
        $image = $request->file('image');
        $filename = $image->store('images', 'public');  // Uloží obrázek do public složky

        // Uložení informací o obrázku do databáze
        Image::create([
            'filename' => basename($filename),  // Pouze název souboru
            'description' => $request->description,  // Popis obrázku (volitelný)
        ]);

        // Přesměrování zpět na admin panel s úspěšnou zprávou
        return redirect()->route('admin.index')->with('success', 'Image uploaded successfully!');
    }

    /**
     * Zpracování odstranění obrázku
     */
    public function remove($id)
    {
        // Najdi obrázek podle ID
        $image = Image::findOrFail($id);  // Pokud obrázek neexistuje, vyvolá se 404 chyba

        // Cesta k souboru v úložišti
        $filePath = 'public/images/' . $image->filename;

        // Ověř, zda soubor existuje
        if (Storage::exists($filePath)) {
            // Smazání obrázku ze složky
            Storage::delete($filePath);

            // Smazání obrázku z databáze
            $image->delete();

            // Přesměrování zpět s úspěšnou zprávou
            return redirect()->route('admin.index')->with('success', 'Image removed successfully!');
        } else {
            // Pokud soubor neexistuje, přesměruj zpět s chybovou zprávou
            return redirect()->route('admin.index')->with('error', 'Image file not found!');
        }
    }
}
