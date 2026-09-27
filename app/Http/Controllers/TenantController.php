<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = Tenant::with([
            'user',
            'rentals.room',
        ])->latest()->get();

        return view('tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:dns', 'max:255', 'unique:users,email'],

            'nik' => ['required', 'string', 'max:16', 'unique:tenants,nik'],
            'phone' => ['required', 'string', 'max:15'],
            'gender' => ['required', 'string', 'max:20'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'address' => ['required', 'string'],
            'occupation' => ['required', 'string', 'max:255'],
            'emergency_contact_name' => ['required', 'string', 'max:255'],
            'emergency_contact_phone' => ['required', 'string', 'max:15'],
            'identity_document' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:5120',
            ],
        ]);

        DB::transaction(function () use ($request, $validated) {

            $role = Role::where('name', 'penghuni')->firstOrFail();

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make('password'),
                'role_id' => $role->id,
            ]);

            $identityDocument = null;

            if ($request->hasFile('identity_document')) {
                $identityDocument = $request->file('identity_document')
                    ->store('identity-documents', 'public');
            }

            Tenant::create([
                'user_id' => $user->id,
                'nik' => $validated['nik'],
                'phone' => $validated['phone'],
                'gender' => $validated['gender'],
                'birth_place' => $validated['birth_place'],
                'birth_date' => $validated['birth_date'],
                'address' => $validated['address'],
                'occupation' => $validated['occupation'],
                'emergency_contact_name' => $validated['emergency_contact_name'],
                'emergency_contact_phone' => $validated['emergency_contact_phone'],
                'identity_document' => $identityDocument,
            ]);
        });

        return redirect()
            ->route('tenants.index')
            ->with('success', 'Penghuni berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        $tenant->load('user');

        return view('tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        $tenant->load('user');

        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $tenant->user_id,
            ],

            'nik' => [
                'required',
                'string',
                'max:20',
                'unique:tenants,nik,' . $tenant->id,
            ],
            'phone' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'string', 'max:20'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'address' => ['required', 'string'],
            'occupation' => ['required', 'string', 'max:255'],
            'emergency_contact_name' => ['required', 'string', 'max:255'],
            'emergency_contact_phone' => ['required', 'string', 'max:20'],

            'identity_document' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
        ]);

        DB::transaction(function () use ($request, $validated, $tenant) {

            // Update akun user
            $tenant->user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            // Data tenant
            $data = [
                'nik' => $validated['nik'],
                'phone' => $validated['phone'],
                'gender' => $validated['gender'],
                'birth_place' => $validated['birth_place'],
                'birth_date' => $validated['birth_date'],
                'address' => $validated['address'],
                'occupation' => $validated['occupation'],
                'emergency_contact_name' => $validated['emergency_contact_name'],
                'emergency_contact_phone' => $validated['emergency_contact_phone'],
            ];

            // Jika upload dokumen baru
            if ($request->hasFile('identity_document')) {

                // Hapus dokumen lama
                if ($tenant->identity_document) {
                    Storage::disk('public')->delete(
                        $tenant->identity_document
                    );
                }

                // Simpan dokumen baru
                $data['identity_document'] = $request
                    ->file('identity_document')
                    ->store('identity-documents', 'public');
            }

            $tenant->update($data);
        });

        return redirect()
            ->route('tenants.show', $tenant)
            ->with('success', 'Data penghuni berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        if ($tenant->rentals()->exists()) {
            return redirect()
                ->route('tenants.index')
                ->with('error', 'Penghuni tidak dapat dihapus karena memiliki riwayat sewa.');
        }

        DB::transaction(function () use ($tenant) {
            $user = $tenant->user;

            if ($tenant->identity_document) {
                Storage::disk('public')->delete(
                    $tenant->identity_document
                );
            }

            $tenant->delete();
            $user->delete();
        });

        return redirect()
            ->route('tenants.index')
            ->with('success', 'Penghuni berhasil dihapus.');
    }
}
