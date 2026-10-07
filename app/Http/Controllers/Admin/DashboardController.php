<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Enquiry;
use App\Models\Gallery;
use App\Models\Banner;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::where('status', true)->count();
        $totalCategories = Category::where('status', true)->count();
        $totalEnquiries = Enquiry::count();
        $newEnquiries = Enquiry::where('status', 'New')->count();
        $galleryImages = Gallery::where('status', true)->count();
        $activeBanners = Banner::where('status', true)->count();
        
        $recentEnquiries = Enquiry::latest()->take(5)->get();
        $recentProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalEnquiries',
            'newEnquiries',
            'galleryImages',
            'activeBanners',
            'recentEnquiries',
            'recentProducts'
        ));
    }
}
