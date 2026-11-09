<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitorController extends Controller
{
    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
        ];
    }

    public function index(Request $request): View
    {
        $visitors = Visitor::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = '%'.$request->string('search').'%';
                $query->where(function ($q) use ($term) {
                    $q->where('name', 'like', $term)
                        ->orWhere('address', 'like', $term)
                        ->orWhere('position', 'like', $term);
                });
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('visitors.index', compact('visitors'));
    }

    public function create(): View
    {
        return view('visitors.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Visitor::create($request->validate($this->rules()));

        return redirect()->route('visitors.index')
            ->with('success', 'Visitor added successfully.');
    }

    public function show(Visitor $visitor): View
    {
        return view('visitors.show', compact('visitor'));
    }

    public function edit(Visitor $visitor): View
    {
        return view('visitors.edit', compact('visitor'));
    }

    public function update(Request $request, Visitor $visitor): RedirectResponse
    {
        $visitor->update($request->validate($this->rules()));

        return redirect()->route('visitors.index')
            ->with('success', 'Visitor updated successfully.');
    }

    public function destroy(Visitor $visitor): RedirectResponse
    {
        $visitor->delete();

        return redirect()->route('visitors.index')
            ->with('success', 'Visitor deleted successfully.');
    }
}