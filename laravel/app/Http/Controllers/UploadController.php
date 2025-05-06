<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Imagick;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the request
        $request->validate([
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $path = Storage::disk('minio')->put('gallery', $request->file('document'));

        // Get full URL (optional)
        $url = env('MINIO_URL') . '/' . $path;

        return back()->with('success', 'document uploaded successfully! URL: ' . $url);
    }
    public function uploadGallery(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $image = $request->file('image');
        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

        // Upload original to MinIO
        $originalPath = 'uploads/' . $fileName;
        Storage::disk('minio')->put($originalPath, file_get_contents($image));

        // Create thumbnail using Intervention
        $thumbnail = Image::make($image)->fit(200, 200);
        $thumbnailPath = 'thumbnails/' . $fileName;

        // Save thumbnail to MinIO
        Storage::disk('minio')->put($thumbnailPath, (string) $thumbnail->encode());

        return back()->with('success', 'Image and thumbnail uploaded successfully to MinIO!');
    }
}
