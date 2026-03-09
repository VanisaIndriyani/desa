<?php

namespace App\Http\Controllers;

class WargaController extends Controller
{
    public function surat()
    {
        $letters = \App\Models\Letter::where('user_id', auth()->id())->latest()->limit(10)->get();

        return view('warga.surat', compact('letters'));
    }

    public function fasilitas()
    {
        $facilities = \App\Models\Facility::orderBy('nama')->get();
        $bookings = \App\Models\FacilityBooking::with('facility')->where('user_id', auth()->id())->orderByDesc('tanggal')->orderByDesc('mulai')->limit(10)->get();

        return view('warga.fasilitas', compact('facilities', 'bookings'));
    }

    public function aduan()
    {
        $complaints = \App\Models\Complaint::where('user_id', auth()->id())->latest()->limit(10)->get();

        return view('warga.aduan', compact('complaints'));
    }

    public function akun()
    {
        return view('warga.akun');
    }

    public function statistik()
    {
        $stats = \App\Models\Statistic::where('published', true)->orderBy('urut')->orderBy('nama')->get();

        return view('warga.statistik', compact('stats'));
    }

    public function suratStore(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'jenis' => 'required|string|max:100',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'menunggu';

        \App\Models\Letter::create($data);

        return redirect()->route('warga.surat')->with('success', 'Pengajuan surat terkirim.');
    }

    public function fasilitasStore(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'mulai' => 'required|date_format:H:i',
            'selesai' => 'required|date_format:H:i|after:mulai',
        ]);
        $data['user_id'] = auth()->id();
        $data['status'] = 'menunggu';

        $conflict = \App\Models\FacilityBooking::where('facility_id', $data['facility_id'])->where('tanggal', $data['tanggal'])->where(function ($q) use ($data) {
            $q->whereBetween('mulai', [$data['mulai'], $data['selesai']])
                ->orWhereBetween('selesai', [$data['mulai'], $data['selesai']])
                ->orWhere(function ($qq) use ($data) {
                    $qq->where('mulai', '<=', $data['mulai'])->where('selesai', '>=', $data['selesai']);
                });
        })->exists();
        if ($conflict) {
            return back()->with('error', 'Waktu yang dipilih bentrok dengan jadwal lain.')->withInput();
        }

        \App\Models\FacilityBooking::create($data);

        return redirect()->route('warga.fasilitas')->with('success', 'Permintaan booking terkirim.');
    }

    public function aduanStore(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:150',
            'kategori' => 'required|string|max:50',
            'isi' => 'required|string|max:3000',
            'anonim' => 'nullable|boolean',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'menunggu';
        $data['anonim'] = isset($data['anonim']) && $data['anonim'];

        if ($request->hasFile('foto')) {
            $data['foto_path'] = $request->file('foto')->store('aduan', 'public');
        }

        \App\Models\Complaint::create($data);

        return redirect()->route('warga.aduan')->with('success', 'Laporan berhasil dikirim.');
    }

    public function akunUpdate(\Illuminate\Http\Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email,'.$user->id,
            'nik' => 'nullable|string|max:32',
            'phone' => 'nullable|string|max:32',
            'address' => 'nullable|string|max:500',
            'new_password' => 'nullable|confirmed|min:6',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if (isset($validated['nik'])) {
            $user->nik = $validated['nik'];
        }
        if (isset($validated['phone'])) {
            $user->phone = $validated['phone'];
        }
        if (isset($validated['address'])) {
            $user->address = $validated['address'];
        }
        if (isset($validated['new_password']) && $validated['new_password'] !== '') {
            $user->password = bcrypt($validated['new_password']);
        }
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function dashboard()
    {
        $userId = auth()->id();
        $suratCount = \App\Models\Letter::where('user_id', $userId)->count();
        $bookingCount = \App\Models\FacilityBooking::where('user_id', $userId)->count();
        $aduanCount = \App\Models\Complaint::where('user_id', $userId)->count();

        $user = auth()->user();
        $fields = ['name', 'email', 'nik'];
        $filled = 0;
        foreach ($fields as $f) {
            $val = $user->{$f};
            if ($val !== null && $val !== '') {
                $filled++;
            }
        }
        $profilePercent = (int) round(($filled / count($fields)) * 100);

        $latestSurat = \App\Models\Letter::where('user_id', $userId)->latest()->limit(5)->get();
        $latestBooking = \App\Models\FacilityBooking::with('facility')->where('user_id', $userId)->latest('tanggal')->latest('mulai')->limit(5)->get();
        $latestAduan = \App\Models\Complaint::where('user_id', $userId)->latest()->limit(5)->get();

        return view('warga.dashboard', compact('suratCount', 'bookingCount', 'aduanCount', 'profilePercent', 'latestSurat', 'latestBooking', 'latestAduan'));
    }
}
