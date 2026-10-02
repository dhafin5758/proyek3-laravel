<?php
// app/Http/Controllers/RegistrationController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Activity;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RegistrationController extends Controller
{
    public function store(StoreRegistrationRequest $request, Activity $activity)
    {
        // IC-01: hanya untuk published
        if ($activity->status !== 'published') {
            return back()->with('error', 'Pendaftaran hanya untuk kegiatan yang sudah dipublikasikan.');
        }

        // IC-02: start_at belum lewat
        if ($activity->start_at && $activity->start_at->isPast()) {
            return back()->with('error', 'Kegiatan sudah dimulai, pendaftaran ditutup.');
        }

        // IC-03: email duplikat
        if ($activity->registrations()->where('email', $request->email)->exists()) {
            return back()->with('error', 'Email ini sudah terdaftar pada kegiatan ini.');
        }

        // IC-04: kapasitas penuh
        if ($activity->registered_count >= $activity->capacity) {
            return back()->with('error', 'Kapasitas kegiatan sudah penuh.');
        }

        // IC-05 & IC-06: transaction
        DB::transaction(function () use ($activity, $request) {
            $activity->registrations()->create([
                'participant_name' => $request->participant_name,
                'email'            => $request->email,
                'registered_at'    => now(),
            ]);
            $activity->increment('registered_count');
        });

        return back()->with('success', 'Pendaftaran berhasil!');
    }
}
