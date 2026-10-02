<?php
// app/Services/ActivityService.php
namespace App\Services;

use App\Models\Activity;
use DomainException;
use Illuminate\Validation\ValidationException;

class ActivityService
{
    private const TRANSITIONS = [
        'draft'     => ['draft'],
        'published' => ['published'],
        'completed' => ['completed'],
    ];

    public function create(array $data): Activity
    {
        return Activity::create($data);
    }

    public function update(Activity $activity, array $data): Activity
    {
        $activity->update($data);
        return $activity->refresh();
    }

    public function publish(Activity $activity): Activity
    {
        if ($activity->status !== 'draft') {
            throw new DomainException('Hanya kegiatan draft yang bisa dipublikasikan.');
        }

        $required = ['category_id', 'code', 'title', 'location', 'start_at', 'capacity'];
        foreach ($required as $field) {
            if (empty($activity->$field)) {
                throw new DomainException("Field {$field} wajib diisi sebelum publish.");
            }
        }

        $activity->update(['status' => 'published']);
        return $activity->refresh();
    }

    public function complete(Activity $activity): Activity
    {
        if ($activity->status !== 'published') {
            throw new DomainException('Hanya kegiatan published yang bisa diselesaikan.');
        }

        $activity->update(['status' => 'completed']);
        return $activity->refresh();
    }
}
