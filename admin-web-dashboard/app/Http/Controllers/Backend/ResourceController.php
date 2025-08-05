<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FirstAidGuide;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'incident_type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'language' => 'required|string|max:50',
        ]);

        $validatedData['created_by'] = Auth::id(); // Assign the current admin's ID

        FirstAidGuide::create($validatedData);

        return redirect()->route('admin.resources')->with('success', 'First aid guide created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FirstAidGuide $resource)
    {
        $validatedData = $request->validate([
            'incident_type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'language' => 'required|string|max:50',
        ]);

        $resource->update($validatedData);

        return redirect()->route('admin.resources')->with('success', 'First aid guide updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FirstAidGuide $resource)
    {
        $resource->delete();
        return redirect()->route('admin.resources')->with('success', 'First aid guide deleted successfully.');
    }
}
