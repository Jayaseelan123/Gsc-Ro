{{--
    Image / video fields shared by the gallery create and edit forms.
    @param \App\Models\Gallery|null $gallery    the item being edited, or null when adding
    @param bool                      $landscape  show the picture in a 16:9 frame (edit page) instead of at its natural shape
--}}
@php
    $gallery = $gallery ?? null;
    $landscape = $landscape ?? false;
    $isEdit = (bool) $gallery;
    $existingImage = $gallery && filled($gallery->image)
        ? (str_starts_with($gallery->image, 'http') ? $gallery->image : asset('storage/' . $gallery->image))
        : '';
    $existingVideo = $gallery?->videoFileUrl() ?? '';
    $videoMaxMb = \App\Http\Controllers\Admin\GalleryController::VIDEO_MAX_KB / 1024;

    $state = [
        'type' => old('media_type', $gallery->media_type ?? 'image'),
        'source' => old('video_source', $gallery && filled($gallery->video_path) && blank($gallery->video_url) ? 'upload' : 'youtube'),
        'url' => old('video_url', $gallery->video_url ?? ''),
        'existingImage' => $existingImage,
        'existingVideo' => $existingVideo,
        'maxVideoBytes' => $videoMaxMb * 1024 * 1024,
    ];
@endphp

<div x-data="galleryMedia(@js($state))" class="space-y-8">
    <!-- Type -->
    <div>
        <span class="block text-sm font-extrabold text-black mb-3 uppercase tracking-wider">Type <span class="text-red-500">*</span></span>
        <div class="grid grid-cols-2 gap-3" role="radiogroup" aria-label="Gallery item type">
            @foreach(['image' => ['Image', 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                      'video' => ['Video', 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z']] as $value => [$label, $icon])
                <label class="flex items-center justify-center gap-2 cursor-pointer rounded-2xl border-2 px-4 py-3.5 font-bold transition-all"
                       :class="type === '{{ $value }}' ? 'border-teal-500 bg-teal-50 text-teal-700' : 'border-slate-200 bg-white text-slate-600 hover:border-slate-300'">
                    <input type="radio" name="media_type" value="{{ $value }}" x-model="type" class="sr-only">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path></svg>
                    {{ $label }}
                </label>
            @endforeach
        </div>
        @error('media_type') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
    </div>

    <!-- Video -->
    <div x-show="type === 'video'" x-cloak class="space-y-5">
        <div>
            <span class="block text-sm font-extrabold text-black mb-3 uppercase tracking-wider">Video <span class="text-red-500">*</span></span>
            <div class="flex flex-wrap gap-2" role="radiogroup" aria-label="Video source">
                @foreach(['youtube' => 'YouTube link', 'upload' => 'Upload video file'] as $value => $label)
                    <label class="cursor-pointer rounded-xl border px-4 py-2 text-sm font-bold transition-colors"
                           :class="source === '{{ $value }}' ? 'border-teal-500 bg-teal-50 text-teal-700' : 'border-slate-200 bg-white text-slate-600 hover:border-slate-300'">
                        <input type="radio" name="video_source" value="{{ $value }}" x-model="source" :disabled="type !== 'video'" class="sr-only">
                        {{ $label }}
                    </label>
                @endforeach
            </div>
            @error('video_source') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
        </div>

        <!-- YouTube -->
        <div x-show="source === 'youtube'">
            <label for="video_url" class="block text-xs font-extrabold text-slate-600 mb-2">YouTube link</label>
            <input id="video_url" type="url" name="video_url" x-model.trim="url" :disabled="type !== 'video' || source !== 'youtube'" maxlength="500"
                   class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-3.5 px-5 text-slate-900 font-medium @error('video_url') border-red-500 @enderror"
                   placeholder="https://www.youtube.com/watch?v=...">
            <p class="text-xs font-medium text-slate-500 mt-2" x-show="!url">Paste the link of a YouTube video (Share &rarr; Copy link).</p>
            <p class="text-xs font-bold text-red-500 mt-2" x-show="url && !youtubeId()" x-cloak>This doesn't look like a YouTube video link.</p>
            <div x-show="youtubeId()" x-cloak class="mt-3 flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-3">
                <img :src="youtubeId() ? 'https://i.ytimg.com/vi/' + youtubeId() + '/mqdefault.jpg' : ''" alt="YouTube video thumbnail" class="w-32 aspect-video rounded-lg object-cover bg-slate-100 shrink-0">
                <p class="text-sm font-semibold text-teal-700">Video found. It will play from YouTube.</p>
            </div>
            @error('video_url') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
        </div>

        <!-- Upload -->
        <div x-show="source === 'upload'" x-cloak>
            <label for="video_file" class="block cursor-pointer rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 hover:bg-teal-50 hover:border-teal-400 transition-all overflow-hidden @error('video_file') border-red-500 @enderror">
                <video x-show="videoPreview" x-cloak :src="videoPreview" class="w-full max-h-72 bg-black" controls preload="metadata" playsinline></video>
                <div x-show="!videoPreview" class="px-6 py-10 text-center">
                    <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    <p class="mt-4 text-sm font-semibold text-teal-600">Click to choose a video</p>
                    <p class="text-xs leading-5 text-slate-500">MP4 or WEBM, up to {{ $videoMaxMb }}MB</p>
                </div>
            </label>
            <input id="video_file" type="file" name="video_file" accept="video/mp4,video/webm,.mp4,.webm" class="sr-only" x-ref="videoFile" :disabled="type !== 'video' || source !== 'upload'" @change="pickVideo($event)">
            <div class="mt-2 flex items-center justify-between gap-3">
                <p class="text-xs font-medium text-slate-600 truncate" x-text="videoName || (existingVideo ? 'Current video kept. Click the video area to replace it.' : '')"></p>
                <button type="button" x-show="videoName" x-cloak @click="clearVideo()" class="shrink-0 text-xs font-bold text-red-600 hover:text-red-700">Remove</button>
            </div>
            <p class="text-red-500 text-xs font-bold mt-2" x-show="videoError" x-text="videoError" x-cloak></p>
            @error('video_file') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
        </div>
    </div>

    <!-- Image (or video cover) -->
    <div>
        <span class="block text-sm font-extrabold text-black mb-3 uppercase tracking-wider">
            <span x-show="type === 'image'">Image <span class="text-red-500">*</span></span>
            <span x-show="type === 'video'" x-cloak>Cover Image <span class="normal-case font-semibold text-slate-400 tracking-normal">(optional)</span></span>
        </span>
        <label for="file-upload" class="block cursor-pointer rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 hover:bg-teal-50 hover:border-teal-400 transition-all group overflow-hidden @error('image') border-red-500 @enderror">
            <div class="{{ $landscape ? 'relative w-full aspect-video' : '' }}">
                <img x-show="imagePreview && !removeCover" x-cloak :src="imagePreview" alt="Selected image preview" class="{{ $landscape ? 'absolute inset-0 w-full h-full object-cover bg-white' : 'w-full max-h-96 object-contain bg-white' }}">
                <div x-show="!imagePreview || removeCover" class="{{ $landscape ? 'absolute inset-0 flex flex-col items-center justify-center px-6 text-center' : 'px-6 py-14 text-center' }}">
                    <svg class="mx-auto h-12 w-12 text-slate-300 group-hover:text-teal-500 transition-colors" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                    </svg>
                    <p class="mt-4 text-sm font-semibold text-teal-600">Click to choose an image</p>
                    <p class="text-xs leading-5 text-slate-500">{{ $landscape ? 'Landscape JPG, PNG or WEBP' : 'JPG, PNG or WEBP' }}, up to 2MB</p>
                </div>
            </div>
        </label>
        <input id="file-upload" name="image" type="file" class="sr-only" accept=".jpg,.jpeg,.png,.webp" x-ref="imageFile" @change="pickImage($event)">
        <p class="text-xs font-medium text-slate-600 mt-2 truncate" x-show="imageName" x-text="imageName" x-cloak></p>
        <p class="text-xs font-medium text-slate-500 mt-2" x-show="type === 'video' && !imageName" x-cloak>
            Shown before the video plays. If empty, the YouTube thumbnail or the video's first frame is used.
        </p>
        @if($isEdit && filled($gallery->image))
            <label x-show="type === 'video' && !imageName" x-cloak class="mt-3 inline-flex items-center gap-2 cursor-pointer text-sm font-bold text-slate-500 hover:text-red-600 transition-colors">
                <input type="checkbox" name="remove_cover" value="1" x-model="removeCover" :disabled="type !== 'video'" class="rounded border-slate-300 text-red-600 focus:ring-red-500">
                Remove the cover image
            </label>
        @endif
        <p class="text-red-500 text-xs font-bold mt-2" x-show="imageError" x-text="imageError" x-cloak></p>
        @error('image') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
    </div>
</div>

@once
<style>[x-cloak] { display: none !important; }</style>
<script>
    function galleryMedia(state) {
        return {
            type: state.type,
            source: state.source,
            url: state.url,
            existingVideo: state.existingVideo,
            imagePreview: state.existingImage,
            imageName: '',
            imageError: '',
            removeCover: false,
            videoPreview: state.existingVideo,
            videoName: '',
            videoError: '',

            youtubeId() {
                const m = (this.url || '').match(/^(?:https?:\/\/)?(?:www\.|m\.|music\.)?(?:youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/|shorts\/|live\/|v\/)|youtu\.be\/)([A-Za-z0-9_-]{11})(?:[?&#\/].*)?$/i);
                return m ? m[1] : null;
            },

            pickImage(event) {
                const file = event.target.files[0];
                this.imageError = '';
                if (!file) { this.imagePreview = state.existingImage; this.imageName = ''; return; }
                if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
                    return this.resetImage('Please choose a JPG, PNG or WEBP image.');
                }
                if (file.size > 2 * 1024 * 1024) {
                    return this.resetImage('Image is larger than 2MB. Please choose a smaller file.');
                }
                this.imagePreview = URL.createObjectURL(file);
                this.imageName = 'New image selected: ' + file.name;
                this.removeCover = false;
            },

            resetImage(message) {
                this.$refs.imageFile.value = '';
                this.imagePreview = state.existingImage;
                this.imageName = '';
                this.imageError = message;
            },

            pickVideo(event) {
                const file = event.target.files[0];
                this.videoError = '';
                if (!file) { return this.clearVideo(); }
                if (!['video/mp4', 'video/webm'].includes(file.type)) {
                    return this.clearVideo('Please choose an MP4 or WEBM video.');
                }
                if (file.size > state.maxVideoBytes) {
                    return this.clearVideo('This video is larger than ' + Math.round(state.maxVideoBytes / 1048576) + 'MB. Please choose a smaller file, or add it to YouTube and paste the link instead.');
                }
                this.videoPreview = URL.createObjectURL(file);
                this.videoName = file.name + ' (' + (file.size / 1048576).toFixed(1) + 'MB)';
            },

            clearVideo(message) {
                this.$refs.videoFile.value = '';
                this.videoPreview = state.existingVideo;
                this.videoName = '';
                this.videoError = message || '';
            },
        };
    }
</script>
@endonce
