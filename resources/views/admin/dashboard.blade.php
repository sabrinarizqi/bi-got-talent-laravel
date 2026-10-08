<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Panel Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <!-- KOTAK 1: Form Tambah Lomba -->
            <div class="p-6 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-bold mb-4 text-blue-600">Tambah Mata Lomba Baru</h3>
                <form action="{{ route('admin.lomba.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mata Lomba</label>
                        <input type="text" name="nama_lomba" placeholder="Contoh: Web Design & Development" class="border-gray-300 rounded-md shadow-sm w-full" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                        <textarea name="deskripsi" rows="3" placeholder="Tuliskan deskripsi lomba di sini..." class="border-gray-300 rounded-md shadow-sm w-full"></textarea>
                    </div>

                    <button type="submit" style="background-color: #2563eb; color: white; font-weight: bold; padding: 10px 20px; border-radius: 6px; border: none; cursor: pointer;">
                        Simpan Lomba
                    </button>
                </form>
            </div>

            <!-- KOTAK 2: Manajemen Akun Siswa (CRUD User) -->
            <div class="p-6 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-bold mb-4 text-gray-800">Manajemen Akun Siswa</h3>
                
                <!-- Form Tambah Siswa -->
                <form action="{{ route('admin.siswa.store') }}" method="POST" class="mb-6 bg-gray-50 p-4 rounded-md border border-gray-200">
                    @csrf
                    <h4 class="font-semibold text-sm mb-3 text-blue-600">Buat Akun Siswa Baru</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="text" name="name" placeholder="Nama Lengkap Siswa" class="border-gray-300 rounded-md w-full" required>
                        <input type="email" name="email" placeholder="Email (Contoh: siswa@sekolah.com)" class="border-gray-300 rounded-md w-full" required>
                        <input type="password" name="password" placeholder="Password (Min. 8 Karakter)" class="border-gray-300 rounded-md w-full" minlength="8" required>
                    </div>
                    <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm transition duration-200">
                        + Tambah Siswa
                    </button>
                </form>

                <!-- Tabel Data Siswa -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="border border-gray-300 p-3">Nama Siswa</th>
                                <th class="border border-gray-300 p-3">Email</th>
                                <th class="border border-gray-300 p-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswas as $siswa)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 p-3">{{ $siswa->name }}</td>
                                <td class="border border-gray-300 p-3">{{ $siswa->email }}</td>
                                <td class="border border-gray-300 p-3 text-center">
                                    <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun {{ $siswa->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if($siswas->isEmpty())
                            <tr>
                                <td colspan="3" class="border border-gray-300 p-4 text-center text-gray-500 italic">Belum ada akun siswa terdaftar.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- KOTAK 3: Kelola Akun Siswa (CRUD User) -->
<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-6">
    <h3 class="text-lg font-bold mb-4 text-gray-800">Manajemen Akun Siswa</h3>
    
    <!-- Form Tambah Siswa Singkat -->
    <form action="{{ route('admin.siswa.store') }}" method="POST" class="mb-6 bg-gray-50 p-4 rounded-md border border-gray-200">
        @csrf
        <h4 class="font-semibold text-sm mb-3 text-blue-600">Buat Akun Siswa Baru</h4>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="text" name="name" placeholder="Nama Lengkap Siswa" class="border-gray-300 rounded-md w-full" required>
            <input type="email" name="email" placeholder="Email (Contoh: siswa@sekolah.com)" class="border-gray-300 rounded-md w-full" required>
            <input type="password" name="password" placeholder="Password (Minimal 8 Karakter)" class="border-gray-300 rounded-md w-full" minlength="8" required>
        </div>
        <button type="submit" class="mt-3 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
            + Tambah Siswa
        </button>
    </form>

    <!-- Tabel Data Siswa -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border border-gray-300 p-3">Nama Siswa</th>
                    <th class="border border-gray-300 p-3">Email</th>
                    <th class="border border-gray-300 p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswas as $siswa)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 p-3">{{ $siswa->name }}</td>
                    <td class="border border-gray-300 p-3">{{ $siswa->email }}</td>
                    <td class="border border-gray-300 p-3 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Edit</a>
                            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin hapus akun {{ $siswa->name }}? Semua riwayat lombanya akan ikut terhapus!');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @if($siswas->isEmpty())
                <tr>
                    <td colspan="3" class="border border-gray-300 p-4 text-center text-gray-500 italic">Belum ada akun siswa terdaftar.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>


            <!-- KOTAK 3: Manajemen Status Peserta -->
            <div class="p-6 sm:p-8 bg-white shadow sm:rounded-lg overflow-x-auto">
                <h3 class="text-lg font-bold mb-4 text-gray-800">Manajemen Status Pendaftaran Peserta</h3>
                <table class="w-full     border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="border border-gray-300 p-3">Nama Siswa</th>
                            <th class="border border-gray-300 p-3">Mata Lomba</th>
                            <th class="border border-gray-300 p-3">Status Saat Ini</th>
                            <th class="border border-gray-300 p-3">Aksi Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftarans as $daftar)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 p-3">{{ $daftar->user->name }}</td>
                            <td class="border border-gray-300 p-3 font-semibold">{{ $daftar->lomba->nama_lomba }}</td>
                            <td class="border border-gray-300 p-3">
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm font-bold">
                                    {{ $daftar->status }}
                                </span>
                            </td>
                            <td class="border border-gray-300 p-3">
                                <form action="{{ route('admin.status.update', $daftar->id) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    <select name="status" class="border-gray-300 rounded-md shadow-sm text-sm">
                                        <option value="Dokumen dalam Tinjauan">Dokumen dalam Tinjauan</option>
                                        <option value="Jadwal Briefing">Jadwal Briefing</option>
                                        <option value="Tahap Pelatihan">Tahap Pelatihan</option>
                                        <option value="Final">Final</option>
                                    </select>
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>