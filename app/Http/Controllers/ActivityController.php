<?php
// app/Http/Controllers/ActivityController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Category;
use App\Services\ActivityService;
use DomainException;

class ActivityController extends Controller
{
    public function __construct(private ActivityService $service) {}

    public function index()
    {
        $categories = Category::orderBy('name')->get();
        $activities = Activity::with('category')
            ->search(request('search'))
            ->when(request('category_id'), fn ($q) => $q->where('category_id', request('category_id')))
            ->when(request('status'), fn ($q) => $q->where('status', request('status')))
            ->when(request('sort') === 'oldest', fn ($q) => $q->orderBy('start_at'),
                   fn ($q) => $q->orderByDesc('start_at'))
            ->paginate(10)
            ->withQueryString();

        return view('activities.index', compact('activities', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('activities.create', compact('categories'));
    }

    public function store(StoreActivityRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function show(Activity $activity)
    {
        $activity->load('category', 'registrations');
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        $categories = Category::orderBy('name')->get();
        return view('activities.edit', compact('activity', 'categories'));
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $this->service->update($activity, $request->validated());
        return redirect()->route('activities.show', $activity)->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activities.index')->with('success', 'Kegiatan dipindahkan ke trash.');
    }

    public function publish(Activity $activity)
    {
        try {
            $this->service->publish($activity);
            return back()->with('success', 'Kegiatan berhasil dipublikasikan.');
        } catch (DomainException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function complete(Activity $activity)
    {
        try {
            $this->service->complete($activity);
            return back()->with('success', 'Kegiatan ditandai selesai.');
        } catch (DomainException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function trash()
    {
        $activities = Activity::onlyTrashed()->orderByDesc('deleted_at')->paginate(10);
        return view('activities.trash', compact('activities'));
    }

    public function restore(int $id)
    {
        Activity::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Kegiatan berhasil dipulihkan.');
    }
}
