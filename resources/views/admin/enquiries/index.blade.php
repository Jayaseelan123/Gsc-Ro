@extends('layouts.admin')
@section('header', 'Enquiries & Leads')
@section('content')
<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Customer Enquiries</h2>
</div>

<!-- Search Section outside the card -->
<div class="mb-6 bg-white rounded-2xl shadow-sm border border-slate-100 p-4">
    <form action="{{ route('admin.enquiries.index') }}" method="GET" role="search" class="flex items-center gap-3 w-full">
        <label for="enquiry-search" class="sr-only">Search enquiries</label>
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input id="enquiry-search" type="text" name="search" placeholder="Search enquiries..." value="{{ request('search') }}" maxlength="100" autocomplete="off" class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition-all font-medium text-slate-900 bg-white">
        </div>

        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-2.5 rounded-xl flex items-center gap-2 transition-all duration-300 shrink-0">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            Search
        </button>

        <a href="{{ route('admin.enquiries.index') }}" class="text-slate-500 hover:text-slate-800 font-bold px-4 py-2.5 rounded-xl flex items-center gap-2 transition-all duration-300 shrink-0" title="Reset Search & Filters">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            Reset
        </a>
    </form>
</div>

<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden flex flex-col">
    <!-- Table -->
    <div class="overflow-x-auto">
        @if($enquiries->count() > 0)
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-4 xl:px-5 2xl:px-8 py-5 text-sm font-black text-slate-900 uppercase tracking-widest border-b border-slate-100">Customer</th>
                        <th class="px-4 xl:px-5 2xl:px-8 py-5 text-sm font-black text-slate-900 uppercase tracking-widest border-b border-slate-100">Enquiry</th>
                        <th class="hidden xl:table-cell px-4 xl:px-5 2xl:px-8 py-5 text-sm font-black text-slate-900 uppercase tracking-widest border-b border-slate-100">Date</th>
                        <th class="px-4 xl:px-5 2xl:px-8 py-5 text-sm font-black text-slate-900 uppercase tracking-widest border-b border-slate-100">Status</th>
                        <th class="px-4 xl:px-5 2xl:px-8 py-5 text-sm font-black text-slate-900 uppercase tracking-widest border-b border-slate-100 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($enquiries as $enquiry)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-4 xl:px-5 2xl:px-8 py-4">
                            <div class="font-medium text-slate-900 text-lg break-words min-w-[170px]">{{ $enquiry->name }}</div>
                            <div class="xl:hidden text-xs font-bold text-slate-400 uppercase tracking-wider mt-0.5">{{ $enquiry->receivedAt()->format('M d, Y · h:i A T') }}</div>
                            <div class="text-sm text-slate-500 font-medium flex flex-col gap-1 mt-1">
                                <span class="flex items-center gap-1.5 whitespace-nowrap">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    {{ $enquiry->email }}
                                </span>
                                @if($enquiry->phone)
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    {{ $enquiry->phone }}
                                </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 xl:px-5 2xl:px-8 py-4">
                            @if($enquiry->product || $enquiry->category)
                                <div class="font-medium text-slate-900 min-w-[120px] max-w-xs line-clamp-1 break-words">{{ $enquiry->product->name ?? $enquiry->category->name }}</div>
                            @endif
                            <div class="text-sm text-slate-500 font-medium min-w-[120px] max-w-xs line-clamp-2 break-words">{{ Str::limit($enquiry->message, 60) }}</div>
                        </td>
                        <td class="hidden xl:table-cell px-4 xl:px-5 2xl:px-8 py-4 whitespace-nowrap">
                            <div class="font-medium text-slate-900">{{ $enquiry->receivedAt()->format('M d, Y') }}</div>
                            <div class="text-sm font-medium text-slate-500">{{ $enquiry->receivedAt()->format('h:i A T') }}</div>
                        </td>
                        <td class="px-4 xl:px-5 2xl:px-8 py-4 whitespace-nowrap">
                            <span class="px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg {{ $enquiry->statusClass() }}">
                                {{ $enquiry->status }}
                            </span>
                        </td>
                        <td class="px-4 xl:px-5 2xl:px-8 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="w-10 h-10 shrink-0 rounded-xl text-blue-600 flex items-center justify-center hover:text-blue-800 transition-colors" title="View Enquiry" aria-label="View Enquiry">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                                <form action="{{ route('admin.enquiries.destroy', $enquiry) }}" method="POST" class="inline" data-confirm="Are you sure you want to delete this enquiry?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-10 h-10 shrink-0 rounded-xl text-red-600 flex items-center justify-center hover:text-red-800 transition-colors" title="Delete" aria-label="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-16 text-center">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-400">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-extrabold text-slate-900 mb-2">No Enquiries Found</h3>
                <p class="text-slate-500 font-medium max-w-md mx-auto">You don't have any customer enquiries yet, or no enquiries match your search criteria.</p>
            </div>
        @endif
    </div>

    @if($enquiries->hasPages())
        <div class="p-6 border-t border-slate-100 bg-slate-50/50">
            {{ $enquiries->links() }}
        </div>
    @endif
</div>
@endsection
