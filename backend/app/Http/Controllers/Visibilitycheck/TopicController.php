<?php

namespace App\Http\Controllers\Visibilitycheck;

use App\Http\Controllers\Controller;
use App\Models\Visibilitycheck\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = Topic::orderBy('display_order', 'asc')->get();
        return view('visibility.topic.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $topic = new Topic();
        return view('visibility.topic.create', compact('topic'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'info' => 'required|string|max:255',
            'display_order' => 'nullable|integer|min:0',
            'enabled' => 'nullable|boolean',
        ]);

        $topic = new Topic();
        $topic->name = $validated['name'];
        $topic->info = $validated['info'];
        $topic->display_order = $validated['display_order'] ?? $this->getNextDisplayOrder();
        $topic->enabled = $request->boolean('enabled', true);
        $topic->save();

        return redirect()->route('topics.index')->with('success', 'Topic created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        return view('visibility.topic.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'info' => 'required|string|max:255',
            'display_order' => 'required|integer|min:0',
            'enabled' => 'nullable|boolean',
        ]);

        $topic->name = $validated['name'];
        $topic->info = $validated['info'];
        $topic->display_order = $validated['display_order'];
        $topic->enabled = $request->boolean('enabled', false);
        $topic->save();

        return redirect()->route('topics.index')->with('success', 'Topic updated successfully');
    }

    /**
     * Toggle enable/disable the topic (no deletion).
     */
    public function toggle(Topic $topic)
    {
        $topic->enabled = !$topic->enabled;
        $topic->save();

        return redirect()->route('topics.index')->with('success', 'Topic '.($topic->enabled ? 'enabled' : 'disabled').' successfully');
    }

    private function getNextDisplayOrder(): int
    {
        $max = (int) Topic::max('display_order');
        return $max + 1;
    }
}
