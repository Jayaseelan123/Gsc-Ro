<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['title', 'description', 'media_type', 'image', 'video_url', 'video_path', 'display_order', 'status'];

    public function isVideo(): bool
    {
        return $this->media_type === 'video';
    }

    /** The 11-character YouTube video id, or null when there is no (valid) YouTube link. */
    public function youtubeId(): ?string
    {
        return self::parseYoutubeId($this->video_url);
    }

    /** Accepts youtube.com/watch?v=, youtu.be/, /embed/, /shorts/ and /live/ links. */
    public static function parseYoutubeId(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        $pattern = '~^(?:https?://)?(?:www\.|m\.|music\.)?(?:youtube\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|live/|v/)|youtu\.be/)([A-Za-z0-9_-]{11})(?:[?&#/].*)?$~i';

        return preg_match($pattern, trim($url), $m) ? $m[1] : null;
    }

    /** Picture to show for this item: the image, or a video's cover / YouTube thumbnail. */
    public function thumbnailUrl(): ?string
    {
        if (filled($this->image)) {
            return str_starts_with($this->image, 'http') ? $this->image : asset('storage/' . $this->image);
        }

        if ($id = $this->youtubeId()) {
            return 'https://i.ytimg.com/vi/' . $id . '/hqdefault.jpg';
        }

        return null;
    }

    /** Privacy-friendly YouTube player address for this item. */
    public function youtubeEmbedUrl(bool $autoplay = false): ?string
    {
        $id = $this->youtubeId();

        return $id ? 'https://www.youtube-nocookie.com/embed/' . $id . '?rel=0' . ($autoplay ? '&autoplay=1' : '') : null;
    }

    /** Address of an uploaded video file. */
    public function videoFileUrl(): ?string
    {
        return filled($this->video_path) ? asset('storage/' . $this->video_path) : null;
    }
}
