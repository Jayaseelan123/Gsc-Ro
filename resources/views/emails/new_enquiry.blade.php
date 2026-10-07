<x-mail::message>
# New Enquiry Received

You have received a new enquiry from your website.

**Name:** {{ $enquiry->name }}  
**Email:** {{ $enquiry->email }}  
**Phone:** {{ $enquiry->phone }}  

**Requirement:**  
{{ $enquiry->requirement }}

**Message / Details:**  
{{ $enquiry->message }}

<x-mail::button :url="config('app.url') . '/admin/enquiries/' . $enquiry->id">
View Enquiry in Admin Panel
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
