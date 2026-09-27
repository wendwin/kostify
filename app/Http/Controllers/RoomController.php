<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Room::with('roomType')
            ->latest();

        if ($request->filled('type')) {
            $query->whereHas('roomType', function ($query) use ($request) {
                $query->whereRaw('LOWER(name) = ?', [strtolower($request->type)]);
            });
        }

        $rooms = $query
            ->paginate(10)
            ->withQueryString();

        $roomTypes = RoomType::orderBy('name')->get();

        return view('rooms.index', [
            'title' => 'Room'
        ], compact('rooms', 'roomTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roomTypes = RoomType::orderBy('name')->get();

        return view('rooms.create',  [
            'title' => 'Add Room'
        ], compact('roomTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_type_id' => ['required', 'exists:room_types,id'],
            'room_number' => ['required', 'string', 'max:50', 'unique:rooms,room_number'],
            'price' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:available,occupied,maintenance,unavailable'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        Room::create($validated);

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Kamar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        $room->load('roomType');

        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $roomTypes = RoomType::orderBy('name')->get();

        return view('rooms.edit', compact('room', 'roomTypes'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_type_id' => ['required', 'exists:room_types,id'],
            'room_number' => [
                'required',
                'string',
                'max:50',
                'unique:rooms,room_number,' . $room->id,
            ],
            'price' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:available,occupied,maintenance,unavailable'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $room->update($validated);

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Kamar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        if ($room->rentals()->exists()) {
            return redirect()
                ->route('rooms.index')
                ->with(
                    'error',
                    'Kamar tidak dapat dihapus karena memiliki riwayat sewa.'
                );
        }

        $room->delete();

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Kamar berhasil dihapus.');
    }
}
