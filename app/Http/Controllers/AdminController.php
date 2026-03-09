<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function dashboard()
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $suratMenunggu = \App\Models\Letter::where('status', 'menunggu')->count();
        $bookingMenunggu = \App\Models\FacilityBooking::where('status', 'menunggu')->count();
        $aduanMenunggu = \App\Models\Complaint::where('status', 'menunggu')->count();

        $latestSurat = \App\Models\Letter::latest()->limit(5)->get();
        $latestBooking = \App\Models\FacilityBooking::with('facility', 'user')->latest()->limit(5)->get();
        $latestAduan = \App\Models\Complaint::latest()->limit(5)->get();

        // Statistik
        $stats = [
            'penduduk' => \App\Models\Statistic::where('kategori', 'Demografi')->sum('nilai'),
            'anggaran' => \App\Models\Statistic::where('kategori', 'Keuangan')->sum('nilai'),
            'fasilitas' => \App\Models\Facility::count(),
            'perangkat' => \App\Models\Official::count(),
        ];

        return view('admin.dashboard', compact('suratMenunggu', 'bookingMenunggu', 'aduanMenunggu', 'latestSurat', 'latestBooking', 'latestAduan', 'stats'));
    }

    public function surat()
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $letters = \App\Models\Letter::with('user')->latest()->paginate(10);

        return view('admin.surat', compact('letters'));
    }

    public function suratUpdate(\Illuminate\Http\Request $request, \App\Models\Letter $letter)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $data = $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
            'nomor_surat' => 'nullable|string|max:100',
            'file' => 'nullable|mimes:pdf|max:4096',
        ]);
        $letter->status = $data['status'];
        if (isset($data['nomor_surat'])) {
            $letter->nomor_surat = $data['nomor_surat'];
        }
        if ($request->hasFile('file')) {
            $letter->file_path = $request->file('file')->store('surat', 'public');
        }
        $letter->save();

        return back()->with('success', 'Surat diperbarui.');
    }

    public function fasilitasIndex()
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $facilities = \App\Models\Facility::orderBy('nama')->paginate(10);

        return view('admin.fasilitas', compact('facilities'));
    }

    public function fasilitasStore(\Illuminate\Http\Request $request)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $data = $request->validate([
            'nama' => 'required|string|max:150',
            'deskripsi' => 'nullable|string|max:1000',
            'kapasitas' => 'required|integer|min:1',
            'gambar_url' => 'nullable|url|max:500',
            'gambar' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('gambar')) {
            $data['gambar_path'] = $request->file('gambar')->store('facilities', 'public');
        }
        \App\Models\Facility::create($data);

        return back()->with('success', 'Fasilitas ditambahkan.');
    }

    public function fasilitasUpdate(\Illuminate\Http\Request $request, \App\Models\Facility $facility)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $data = $request->validate([
            'nama' => 'required|string|max:150',
            'deskripsi' => 'nullable|string|max:1000',
            'kapasitas' => 'required|integer|min:1',
            'gambar_url' => 'nullable|url|max:500',
            'gambar' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('gambar')) {
            $data['gambar_path'] = $request->file('gambar')->store('facilities', 'public');
        }
        $facility->update($data);

        return back()->with('success', 'Fasilitas diperbarui.');
    }

    public function fasilitasDestroy(\App\Models\Facility $facility)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $facility->delete();

        return back()->with('success', 'Fasilitas dihapus.');
    }

    public function bookingFasilitas()
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $bookings = \App\Models\FacilityBooking::with('facility', 'user')->latest('tanggal')->latest('mulai')->paginate(10);

        return view('admin.booking', compact('bookings'));
    }

    public function statistik()
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $stats = \App\Models\Statistic::orderBy('urut')->orderBy('nama')->paginate(10);

        return view('admin.statistik', compact('stats'));
    }

    public function statistikStore(\Illuminate\Http\Request $request)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $data = $request->validate([
            'nama' => 'required|string|max:150',
            'kategori' => 'nullable|string|max:100',
            'unit' => 'nullable|string|max:30',
            'nilai' => 'required|numeric',
            'urut' => 'nullable|integer|min:0',
            'published' => 'nullable|boolean',
        ]);
        $data['published'] = isset($data['published']) ? (bool) $data['published'] : true;
        \App\Models\Statistic::create($data);

        return back()->with('success', 'Data statistik ditambahkan.');
    }

    public function statistikUpdate(\Illuminate\Http\Request $request, \App\Models\Statistic $stat)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $data = $request->validate([
            'nama' => 'required|string|max:150',
            'kategori' => 'nullable|string|max:100',
            'unit' => 'nullable|string|max:30',
            'nilai' => 'required|numeric',
            'urut' => 'nullable|integer|min:0',
            'published' => 'nullable|boolean',
        ]);
        $data['published'] = isset($data['published']) ? (bool) $data['published'] : true;
        $stat->update($data);

        return back()->with('success', 'Data statistik diperbarui.');
    }

    public function statistikDestroy(\App\Models\Statistic $stat)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $stat->delete();

        return back()->with('success', 'Data statistik dihapus.');
    }

    public function konten()
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $beranda = \App\Models\ContentPage::where('slug', 'beranda')->first();
        $profil = \App\Models\ContentPage::where('slug', 'profil')->first();
        $sejarah = \App\Models\ContentPage::where('slug', 'sejarah')->first();
        $visiMisi = \App\Models\ContentPage::where('slug', 'visi-misi')->first();

        return view('admin.konten', compact('beranda', 'profil', 'sejarah', 'visiMisi'));
    }

    public function kontenUpdate(\Illuminate\Http\Request $request)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $data = $request->validate([
            'beranda_judul' => 'nullable|string|max:150',
            'beranda_isi' => 'nullable|string',
            'profil_judul' => 'nullable|string|max:150',
            'profil_isi' => 'nullable|string',
            'sejarah_judul' => 'nullable|string|max:150',
            'sejarah_isi' => 'nullable|string',
            'visi_judul' => 'nullable|string|max:150',
            'visi_isi' => 'nullable|string',
        ]);
        $beranda = \App\Models\ContentPage::firstOrCreate(['slug' => 'beranda'], ['judul' => 'Beranda Desa']);
        $profil = \App\Models\ContentPage::firstOrCreate(['slug' => 'profil'], ['judul' => 'Profil Desa']);
        $sejarah = \App\Models\ContentPage::firstOrCreate(['slug' => 'sejarah'], ['judul' => 'Sejarah Desa']);
        $visiMisi = \App\Models\ContentPage::firstOrCreate(['slug' => 'visi-misi'], ['judul' => 'Visi & Misi']);
        
        if (isset($data['beranda_judul'])) $beranda->judul = $data['beranda_judul'];
        if (isset($data['beranda_isi'])) $beranda->isi = $data['beranda_isi'];
        
        if (isset($data['profil_judul'])) $profil->judul = $data['profil_judul'];
        if (isset($data['profil_isi'])) $profil->isi = $data['profil_isi'];

        if (isset($data['sejarah_judul'])) $sejarah->judul = $data['sejarah_judul'];
        if (isset($data['sejarah_isi'])) $sejarah->isi = $data['sejarah_isi'];
        
        if (isset($data['visi_judul'])) $visiMisi->judul = $data['visi_judul'];
        if (isset($data['visi_isi'])) $visiMisi->isi = $data['visi_isi'];
        
        $beranda->save();
        $profil->save();
        $sejarah->save();
        $visiMisi->save();

        return back()->with('success', 'Konten diperbarui.');
    }

    public function perangkat()
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $officials = \App\Models\Official::orderBy('urut')->orderBy('jabatan')->paginate(12);

        return view('admin.perangkat', compact('officials'));
    }

    public function perangkatStore(\Illuminate\Http\Request $request)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $data = $request->validate([
            'nama' => 'required|string|max:150',
            'jabatan' => 'required|string|max:100',
            'urut' => 'nullable|integer|min:0',
            'foto' => 'nullable|image|max:2048',
            'published' => 'nullable|boolean',
        ]);
        $payload = [
            'nama' => $data['nama'],
            'jabatan' => $data['jabatan'],
            'urut' => $data['urut'] ?? 0,
            'published' => isset($data['published']) ? (bool) $data['published'] : true,
        ];
        if ($request->hasFile('foto')) {
            $payload['foto_path'] = $request->file('foto')->store('perangkat', 'public');
        }
        \App\Models\Official::create($payload);

        return back()->with('success', 'Perangkat ditambahkan.');
    }

    public function perangkatUpdate(\Illuminate\Http\Request $request, \App\Models\Official $official)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $data = $request->validate([
            'nama' => 'required|string|max:150',
            'jabatan' => 'required|string|max:100',
            'urut' => 'nullable|integer|min:0',
            'foto' => 'nullable|image|max:2048',
            'published' => 'nullable|boolean',
        ]);
        $payload = [
            'nama' => $data['nama'],
            'jabatan' => $data['jabatan'],
            'urut' => $data['urut'] ?? 0,
            'published' => isset($data['published']) ? (bool) $data['published'] : true,
        ];
        if ($request->hasFile('foto')) {
            $payload['foto_path'] = $request->file('foto')->store('perangkat', 'public');
        }
        $official->update($payload);

        return back()->with('success', 'Perangkat diperbarui.');
    }

    public function perangkatDestroy(\App\Models\Official $official)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $official->delete();

        return back()->with('success', 'Perangkat dihapus.');
    }

    public function bookingFasilitasUpdate(\Illuminate\Http\Request $request, \App\Models\FacilityBooking $booking)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $data = $request->validate([
            'status' => 'required|in:menunggu,disetujui,ditolak',
        ]);
        $booking->status = $data['status'];
        $booking->save();

        return back()->with('success', 'Booking diperbarui.');
    }

    public function aduan()
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $complaints = \App\Models\Complaint::with('user')->latest()->paginate(10);

        return view('admin.aduan', compact('complaints'));
    }

    public function aduanUpdate(\Illuminate\Http\Request $request, \App\Models\Complaint $complaint)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
        $data = $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
            'tanggapan' => 'nullable|string|max:2000',
        ]);
        $complaint->status = $data['status'];
        if (isset($data['tanggapan'])) {
            $complaint->tanggapan = $data['tanggapan'];
        }
        $complaint->save();

        return back()->with('success', 'Aduan diperbarui.');
    }
}
