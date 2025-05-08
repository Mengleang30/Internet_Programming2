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
        $request->validate([
            'document' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('document');
        $filename = time() . '_' . $file->getClientOriginalName();

        // Save original image to MinIO
        $originalPath = 'images/originals/' . $filename;
        Storage::disk('minio')->put($originalPath, file_get_contents($file));

        // Create a thumbnail (e.g., 300x300)
        $thumbnailImage = Image::make($file)->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode($file->getClientOriginalExtension());

        // Save thumbnail to MinIO
        $thumbnailPath = 'images/thumbnails/' . $filename;
        Storage::disk('minio')->put($thumbnailPath, (string) $thumbnailImage);

        // Generate URLs
        $baseUrl = rtrim(env('MINIO_URL'), '/');
        $originalUrl = $baseUrl . '/' . $originalPath;
        $thumbnailUrl = $baseUrl . '/' . $thumbnailPath;

        return back()->with('success', 'Uploaded successfully!')
                     ->with('original_url', $originalUrl)
                     ->with('thumbnail_url', $thumbnailUrl);
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
