<?php

namespace App\Http\Controllers\IndikatorSPBE;

use App\Http\Controllers\Controller;
use App\Models\IndikatorSPBE;
use Illuminate\Http\Request;

class IndikatorSPBEController extends Controller
{
    public function index()
    {
        $indikatorSpbes = IndikatorSpbe::with('articles')->paginate(10);
        return view('indikator-spbe.index', compact('indikatorSpbes'));
    }

    public function create()
    {
        return view('indikator-spbe.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'explanation' => 'required|string',
            'rule_information' => 'required|string',
            'criteria' => 'required|string',
            'current_level' => 'required|string',
            'target_level' => 'required|string',
            'related_documentation' => 'nullable|string',
            'person_in_charge' => 'required|string',
            'status' => 'required|in:active,inactive'
        ]);

        $validated['date_added'] = now();
        $validated['last_updated_date'] = now();

        IndikatorSpbe::create($validated);

        return redirect()->route('indikator-spbe.index')
            ->with('success', 'Indikator SPBE berhasil ditambahkan');
    }

    public function edit(IndikatorSpbe $indikatorSpbe)
    {
        return view('indikator-spbe.edit', compact('indikatorSpbe'));
    }

    public function update(Request $request, IndikatorSpbe $indikatorSpbe)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'explanation' => 'required|string',
            'rule_information' => 'required|string',
            'criteria' => 'required|string',
            'current_level' => 'required|string',
            'target_level' => 'required|string',
            'related_documentation' => 'nullable|string',
            'person_in_charge' => 'required|string',
            'status' => 'required|in:active,inactive'
        ]);

        $validated['last_updated_date'] = now();

        $indikatorSpbe->update($validated);

        return redirect()->route('indikator-spbe.index')
            ->with('success', 'Indikator SPBE berhasil diperbarui');
    }

    public function destroy(IndikatorSpbe $indikatorSpbe)
    {
        $indikatorSpbe->delete();

        return redirect()->route('indikator-spbe.index')
            ->with('success', 'Indikator SPBE berhasil dihapus');
    }

    public function toggleStatus(IndikatorSpbe $indikatorSpbe)
    {
        $newStatus = $indikatorSpbe->status === 'active' ? 'inactive' : 'active';
        $indikatorSpbe->update(['status' => $newStatus]);

        return back()->with('success', 'Status berhasil diubah');
    }
}
