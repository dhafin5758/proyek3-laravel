<?php
// app/Models/Activity.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'code', 'title', 'description',
        'location', 'capacity', 'registered_count',
        'start_at', 'end_at', 'poster_path', 'status',
        'activity_date',
    ];

    protected function casts(): array
    {
        return [
            'start_at'      => 'datetime',
            'end_at'        => 'datetime',
            'activity_date' => 'date',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function scopeSearch($query, ?string $keyword)
    {
        return $query->when($keyword, fn ($q) =>
            $q->where(fn ($q) =>
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('code', 'like', "%{$keyword}%")
            )
        );
    }
}
