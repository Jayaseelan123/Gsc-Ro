<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    /** Lead statuses in pipeline order, with their badge colours. */
    public const STATUSES = [
        'New' => 'bg-blue-100 text-blue-700',
        'Contacted' => 'bg-amber-100 text-amber-700',
        'Follow-up' => 'bg-purple-100 text-purple-700',
        'Converted' => 'bg-green-100 text-green-700',
        'Closed' => 'bg-slate-200 text-slate-700',
    ];

    protected $fillable = ['name', 'phone', 'email', 'category_id', 'product_id', 'requirement', 'message', 'status', 'admin_notes'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function statusClass(): string
    {
        return self::STATUSES[$this->status] ?? 'bg-slate-100 text-slate-700';
    }

    /** When the enquiry arrived, in the display timezone (stored in UTC). */
    public function receivedAt(): \Illuminate\Support\Carbon
    {
        return $this->created_at->copy()->timezone(config('app.display_timezone'));
    }

    /**
     * Phone number in international form for WhatsApp links.
     * A plain 10-digit number is treated as Indian (+91), matching the enquiry forms.
     */
    public function whatsappNumber(): string
    {
        $digits = preg_replace('/\D/', '', (string) $this->phone);

        // A trunk-prefixed Indian number ("0" + 10 digits, e.g. 08489770824) is the same as the plain 10-digit number.
        if (strlen($digits) === 11 && $digits[0] === '0') {
            $digits = substr($digits, 1);
        }

        return strlen($digits) === 10 ? '91' . $digits : $digits;
    }

    /**
     * Splits "Label: value" lines (as written by the requirement form) into fields.
     * Returns [fields, remaining free text].
     */
    public function messageParts(): array
    {
        $fields = [];
        $rest = [];

        foreach (preg_split('/\r\n|\r|\n/', (string) $this->message) as $line) {
            if (preg_match('/^\s*([A-Za-z][A-Za-z &\/\-]{1,40}):\s*(.*)$/', $line, $m)) {
                $fields[trim($m[1])] = trim($m[2]);
            } elseif (trim($line) !== '') {
                $rest[] = $line;
            }
        }

        // A normal free-text message may contain a stray "Note: ..." line; only treat it as a form when there are several fields.
        if (count($fields) < 2) {
            return [[], trim((string) $this->message)];
        }

        return [$fields, trim(implode("\n", $rest))];
    }
}
