<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'slug', 'short_description', 'description', 'specifications', 'price', 'main_image', 'spec_sheet', 'featured', 'status', 'display_order'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('display_order')->orderBy('id');
    }

    /**
     * Main image followed by gallery images, as public URLs.
     */
    public function galleryUrls(): array
    {
        $paths = array_filter(array_merge([$this->main_image], $this->images->pluck('image')->all()));

        return array_values(array_map(
            fn ($path) => str_starts_with($path, 'http') ? $path : asset('storage/' . $path),
            $paths
        ));
    }

    /**
     * Specifications entered one per line, returned as a clean list.
     */
    public function specList(): array
    {
        return array_values(array_filter(
            array_map(fn ($line) => trim(ltrim(trim($line), "-•*")), preg_split('/\r\n|\r|\n/', (string) $this->specifications)),
            fn ($line) => $line !== ''
        ));
    }
}
