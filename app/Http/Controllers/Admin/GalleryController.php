<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public const ACTIVE_LIMIT = 20;

    /** Largest video file that can be uploaded, in kilobytes (50 MB). */
    public const VIDEO_MAX_KB = 51200;

    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($request->filled('search')) {
            $search = '%' . trim($request->search) . '%';
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', $search)
                  ->orWhere('description', 'like', $search);
            });
        }

        $galleries = $query->orderBy('display_order')->latest()->paginate(12)->withQueryString();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->rules($request), $this->messages());

        if (Gallery::where('status', true)->count() >= self::ACTIVE_LIMIT) {
            return back()->withInput()->with('error', 'The gallery already shows ' . self::ACTIVE_LIMIT . ' items, which is the maximum. Delete or hide an item first.');
        }

        $gallery = new Gallery([
            'title' => $request->filled('title') ? trim($request->title) : null,
            'media_type' => $request->media_type,
            'display_order' => 0,
            'status' => true,
        ]);
        $this->saveMedia($request, $gallery);
        $gallery->save();

        return redirect()->route('admin.gallery.index')
            ->with('success', $gallery->isVideo() ? 'Video added successfully.' : 'Image added successfully.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->merge([
            'display_order' => $request->display_order ?? 0,
        ]);

        $request->validate($this->rules($request, $gallery) + [
            'display_order' => 'required|integer',
            'status' => 'required|boolean',
        ], $this->messages());

        if ($gallery->status == 0 && $request->status == 1 && Gallery::where('status', true)->count() >= self::ACTIVE_LIMIT) {
            return back()->with('error', 'Maximum of ' . self::ACTIVE_LIMIT . ' active gallery items allowed.');
        }

        // The form no longer has a Title field; keep any title already saved (it is used as image alt text).
        $gallery->fill([
            'title' => $request->has('title') ? ($request->filled('title') ? trim($request->title) : null) : $gallery->title,
            'media_type' => $request->media_type,
            'display_order' => (int) $request->display_order,
            'status' => (bool) $request->status,
        ]);
        $this->saveMedia($request, $gallery);
        $gallery->save();

        return redirect()->route('admin.gallery.index')
            ->with('success', $gallery->isVideo() ? 'Video updated successfully.' : 'Image updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        $this->deleteFile($gallery->image);
        $this->deleteFile($gallery->video_path);
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted successfully.');
    }

    /** Validation rules for an image or a video item; $gallery is the item being edited, if any. */
    private function rules(Request $request, ?Gallery $gallery = null): array
    {
        $imageFile = 'image|mimes:jpeg,png,jpg,webp|max:2048';

        $rules = [
            'title' => 'nullable|string|max:255',
            'media_type' => 'required|in:image,video',
        ];

        if ($request->media_type !== 'video') {
            // An image item needs a picture, unless the item being edited already has one.
            $rules['image'] = ($gallery && filled($gallery->image) ? 'nullable|' : 'required|') . $imageFile;
            return $rules;
        }

        $rules['image'] = 'nullable|' . $imageFile; // optional cover picture
        $rules['remove_cover'] = 'nullable|boolean';
        $rules['video_source'] = 'required|in:youtube,upload';

        if ($request->video_source === 'youtube') {
            $rules['video_url'] = ['required', 'string', 'max:500', function ($attribute, $value, $fail) {
                if (!Gallery::parseYoutubeId($value)) {
                    $fail('Please paste a valid YouTube video link, e.g. https://www.youtube.com/watch?v=… or https://youtu.be/…');
                }
            }];
        } else {
            $hasFile = $gallery && filled($gallery->video_path);
            $rules['video_file'] = ($hasFile ? 'nullable' : 'required') . '|file|mimetypes:video/mp4,video/webm|max:' . self::VIDEO_MAX_KB;
        }

        return $rules;
    }

    private function messages(): array
    {
        return [
            'media_type.in' => 'Please choose Image or Video.',
            'image.required' => 'Please choose an image to upload.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a JPG, PNG or WEBP file.',
            'image.max' => 'The image must not be larger than 2MB.',
            'video_source.required' => 'Please choose YouTube link or Upload video.',
            'video_url.required' => 'Please paste the YouTube video link.',
            'video_file.required' => 'Please choose a video file to upload.',
            'video_file.mimetypes' => 'The video must be an MP4 or WEBM file.',
            'video_file.max' => 'The video must not be larger than ' . (self::VIDEO_MAX_KB / 1024) . 'MB.',
            'video_file.uploaded' => 'The video could not be uploaded. It may be larger than the server allows (' . (self::VIDEO_MAX_KB / 1024) . 'MB).',
        ];
    }

    /** Stores the uploaded files for $gallery and clears whatever the chosen type no longer uses. */
    private function saveMedia(Request $request, Gallery $gallery): void
    {
        if ($request->hasFile('image')) {
            $this->deleteFile($gallery->image);
            $gallery->image = $request->file('image')->store('gallery', 'public');
        }

        if (!$gallery->isVideo()) {
            $this->deleteFile($gallery->video_path);
            $gallery->video_url = null;
            $gallery->video_path = null;
            return;
        }

        if ($request->boolean('remove_cover') && !$request->hasFile('image')) {
            $this->deleteFile($gallery->image);
            $gallery->image = null;
        }

        if ($request->video_source === 'youtube') {
            $this->deleteFile($gallery->video_path);
            $gallery->video_path = null;
            $gallery->video_url = trim($request->video_url);
        } else {
            if ($request->hasFile('video_file')) {
                $this->deleteFile($gallery->video_path);
                $gallery->video_path = $request->file('video_file')->store('gallery/videos', 'public');
            }
            $gallery->video_url = null;
        }
    }

    private function deleteFile(?string $path): void
    {
        if (filled($path) && !str_starts_with($path, 'http')) {
            Storage::disk('public')->delete($path);
        }
    }
}
