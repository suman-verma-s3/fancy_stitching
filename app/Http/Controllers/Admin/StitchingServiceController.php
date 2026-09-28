<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StitchingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StitchingServiceController extends Controller
{
    public function index()
    {
        $services = StitchingService::with('images')
            ->latest()
            ->get();

        return view('admin.stitching-services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.stitching-services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lte:price',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'status' => 'required|in:active,inactive',
        ]);

        $service = StitchingService::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'status' => $request->status,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('stitching-services', 'public');

                $service->images()->create([
                    'image' => $path,
                    'is_primary' => $index === 0,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()
            ->route('admin.stitching-services.index')
            ->with('success', 'Stitching service created successfully.');
    }

    public function edit(StitchingService $stitchingService)
    {
        $stitchingService->load('images');

        return view(
            'admin.stitching-services.edit',
            compact('stitchingService')
        );
    }

    public function update(Request $request, StitchingService $stitchingService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lte:price',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'status' => 'required|in:active,inactive',
        ]);

        $stitchingService->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'status' => $request->status,
        ]);

        if ($request->hasFile('images')) {
            $lastSortOrder = $stitchingService->images()->max('sort_order') ?? -1;

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('stitching-services', 'public');

                $stitchingService->images()->create([
                    'image' => $path,
                    'is_primary' => false,
                    'sort_order' => $lastSortOrder + $index + 1,
                ]);
            }

            if (!$stitchingService->images()->where('is_primary', true)->exists()) {
                $firstImage = $stitchingService->images()
                    ->orderBy('sort_order')
                    ->first();

                if ($firstImage) {
                    $firstImage->update([
                        'is_primary' => true,
                    ]);
                }
            }
        }

        return redirect()
            ->route('admin.stitching-services.index')
            ->with('success', 'Stitching service updated successfully.');
    }

    public function destroy(StitchingService $stitchingService)
    {
        foreach ($stitchingService->images as $image) {
            if ($image->image) {
                Storage::disk('public')->delete($image->image);
            }
        }

        $stitchingService->delete();

        return redirect()
            ->route('admin.stitching-services.index')
            ->with('success', 'Stitching service deleted successfully.');
    }

    public function deleteImage($id)
    {
        $image = \App\Models\StitchingServiceImage::findOrFail($id);

        $service = $image->stitchingService;

        if ($image->image) {
            Storage::disk('public')->delete($image->image);
        }

        $wasPrimary = $image->is_primary;

        $image->delete();

        if ($wasPrimary) {
            $newPrimary = $service->images()
                ->orderBy('sort_order')
                ->first();

            if ($newPrimary) {
                $newPrimary->update([
                    'is_primary' => true,
                ]);
            }
        }

        return back()->with('success', 'Image deleted successfully.');
    }

    public function setPrimaryImage($id)
    {
        $image = \App\Models\StitchingServiceImage::findOrFail($id);

        $service = $image->stitchingService;

        $service->images()->update([
            'is_primary' => false,
        ]);

        $image->update([
            'is_primary' => true,
        ]);

        return back()->with('success', 'Primary image updated successfully.');
    }
}