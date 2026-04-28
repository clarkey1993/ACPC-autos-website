<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::query()
            ->with('car')
            ->latest()
            ->paginate(20);

        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function show(Enquiry $enquiry)
    {
        $enquiry->load('car');

        return view('admin.enquiries.show', compact('enquiry'));
    }

    public function markAsRead(Enquiry $enquiry)
    {
        $enquiry->update(['is_read' => true]);

        return redirect()
            ->back()
            ->with('success', 'Enquiry marked as read.');
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return redirect()
            ->route('admin.enquiries.index')
            ->with('success', 'Enquiry deleted.');
    }
}
