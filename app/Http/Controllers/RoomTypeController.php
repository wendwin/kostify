<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomTypes = RoomType::latest()->get();

        return view('room-types.index', compact('roomTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('room-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:room_types,name'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        RoomType::create($validated);

        return redirect()
            ->route('room-types.index')
            ->with('success', 'Tipe kamar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $roomType)
    {
        return view('room-types.show', compact('roomType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomType $roomType)
    {
        return view('room-types.edit', compact('roomType'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomType $roomType)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:room_types,name,' . $roomType->id,
            ],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $roomType->update($validated);

        return redirect()
            ->route('room-types.index')
            ->with('success', 'Tipe kamar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $roomType)
    {
        if ($roomType->rooms()->exists()) {
            return redirect()
                ->route('room-types.index')
                ->with('error', 'Tipe kamar tidak dapat dihapus karena sudah digunakan oleh kamar.');
        }

        $roomType->delete();

        return redirect()
            ->route('room-types.index')
            ->with('success', 'Tipe kamar berhasil dihapus.');
    }
}
