<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\Enquiry;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewEnquiryMail;

class FrontendController extends Controller
{
    public function __construct()
    {
        // Share common data (like categories, settings) to all views
        view()->share('categories_menu', Category::where('status', true)->orderBy('display_order')->get());
        view()->share('settings', WebsiteSetting::pluck('value', 'key')->toArray());
    }

    public function home()
    {
        $banners = Banner::where('status', true)->orderBy('display_order')->get();
        
        // Featured products first, then the newest, so the section is never empty while products exist.
        $products = Product::with('category')->where('status', true)
            ->orderByDesc('featured')->orderBy('display_order')->latest()
            ->take(6)->get();
            
        return view('frontend.home', compact('products', 'banners'));
    }

    public function about()
    {
        return view('frontend.about');
    }



    public function privacy()
    {
        return view('frontend.privacy');
    }

    public function terms()
    {
        return view('frontend.terms');
    }

    public function products()
    {
        $categories = Category::where('status', true)->orderBy('display_order')->get();
        return view('frontend.products', compact('categories'));
    }

    public function categoryProducts(Category $category)
    {
        if (!$category->status) abort(404);
        $products = $category->products()->where('status', true)->orderBy('display_order')->paginate(12);
        return view('frontend.category_products', compact('category', 'products'));
    }

    public function productDetails(Product $product)
    {
        if (!$product->status) abort(404);
        $product->load('category', 'images');
        return view('frontend.product_details', compact('product'));
    }

    public function gallery()
    {
        // Images need a picture; videos need a YouTube link or an uploaded file.
        $images = Gallery::where('status', true)
            ->where(function ($q) {
                $q->where(fn ($i) => $i->where('media_type', '!=', 'video')->whereNotNull('image')->where('image', '!=', ''))
                  ->orWhere(fn ($v) => $v->where('media_type', 'video')->where(fn ($s) => $s->whereNotNull('video_url')->orWhereNotNull('video_path')));
            })
            ->orderBy('display_order')->latest()->take(20)->get();
        return view('frontend.gallery', compact('images'));
    }

    public function contact()
    {
        $products = Product::where('status', true)->get();
        $categories = Category::where('status', true)->get();
        return view('frontend.contact', compact('products', 'categories'));
    }

    public function requirement()
    {
        $products = Product::where('status', true)->orderBy('name')->get();
        $categories = Category::where('status', true)->orderBy('name')->get();
        return view('frontend.requirement', compact('products', 'categories'));
    }

    public function submitRequirement(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'project_type' => 'required|string',
            'usage_facility' => 'required|string',
            'capacity' => 'required|string',
            'people_daily' => 'required|numeric',
            'water_source' => 'required|string',
            'message' => 'nullable|string',
            'water_report' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $details = "Project Type: " . $request->project_type . "\n"
                 . "Facility: " . $request->usage_facility . "\n"
                 . "Capacity: " . $request->capacity . "\n"
                 . "People Daily: " . $request->people_daily . "\n"
                 . "Water Source: " . $request->water_source . "\n"
                 . "Wants Visit & Test: " . ($request->has('want_visit') ? 'Yes' : 'No') . "\n\n"
                 . "Additional Message: " . ($request->message ?? 'None');

        if($request->hasFile('water_report')) {
            $report_path = $request->file('water_report')->store('reports', 'public');
            $details .= "\n\nWater Report Uploaded: " . asset('storage/' . $report_path);
        }

        $enquiry = Enquiry::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'requirement' => 'Water Treatment Requirement (' . $request->project_type . ')',
            'message' => $details,
        ]);
        
        $this->sendEnquiryEmail($enquiry);

        return redirect()->back()->with('success', 'Your requirement has been submitted successfully. Our team will contact you soon!');
    }

    public function submitEnquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'requirement' => 'required|string|max:255',
            'message' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'product_id' => 'nullable|exists:products,id',
        ]);

        $enquiry = Enquiry::create($request->all());
        
        $this->sendEnquiryEmail($enquiry);

        return redirect()->back()->with('success', 'Your enquiry has been submitted successfully. We will contact you soon!');
    }
    
    private function sendEnquiryEmail(Enquiry $enquiry)
    {
        try {
            $adminEmail = WebsiteSetting::where('key', 'contact_email')->value('value') ?? env('MAIL_FROM_ADDRESS');
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new NewEnquiryMail($enquiry));
            }
        } catch (\Exception $e) {
            // Log error silently, do not break the user flow if SMTP fails
            \Log::error('Failed to send enquiry email: ' . $e->getMessage());
        }
    }
}
