<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Enquiry::with('product', 'category')->latest();

        if ($request->filled('search')) {
            $search = '%' . trim($request->search) . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                  ->orWhere('email', 'like', $search)
                  ->orWhere('phone', 'like', $search)
                  ->orWhere('message', 'like', $search)
                  ->orWhere('requirement', 'like', $search)
                  ->orWhereHas('product', fn ($p) => $p->where('name', 'like', $search))
                  ->orWhereHas('category', fn ($c) => $c->where('name', 'like', $search));
            });
        }

        $enquiries = $query->paginate(15)->withQueryString();
        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function show(Enquiry $enquiry)
    {
        $enquiry->load('product', 'category');
        return view('admin.enquiries.show', compact('enquiry'));
    }

    public function update(Request $request, Enquiry $enquiry)
    {
        $data = $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Enquiry::STATUSES)),
            'admin_notes' => 'nullable|string|max:5000',
        ], [
            'status.in' => 'Please choose a valid status.',
            'admin_notes.max' => 'Notes must not be longer than 5000 characters.',
        ]);

        // The status dropdown submits on its own, without the notes box; only change notes when they were sent.
        if (!$request->has('admin_notes')) {
            unset($data['admin_notes']);
        }

        $enquiry->update($data);

        return redirect()->route('admin.enquiries.show', $enquiry)
            ->with('success', $request->has('admin_notes') ? 'Notes saved.' : 'Status changed to "' . $enquiry->status . '".');
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();
        return redirect()->route('admin.enquiries.index')->with('success', 'Enquiry deleted successfully.');
    }
}
