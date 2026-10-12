<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Peserta: {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Notifikasi -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-sm" role="alert">
                    <p class="font-bold">Sukses</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 shadow-sm" role="alert">
                    <p class="font-bold">Perhatian</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- KOTAK 1: Form Pendaftaran -->
            <div class="p-6 bg-white shadow sm:rounded-lg border-t-4 border-blue-600">
                <h3 class="text-lg font-bold mb-4 text-gray-800">Formulir Pendaftaran Lomba</h3>
                <form action="{{ route('siswa.daftar') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Pilih Lomba -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Kategori Lomba *</label>
                            <select name="lomba_id" style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px;" required>
                                <option value="">-- Pilih Lomba --</option>
                                @foreach($lombas as $lomba)
                                    <option value="{{ $lomba->id }}">{{ $lomba->nama_lomba }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Input Kelas -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Asal Kelas *</label>
                            <input type="text" name="kelas" placeholder="Contoh: XI RPL" style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px;" required>
                        </div>
                        
                        <!-- Input WhatsApp -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. WhatsApp Aktif *</label>
                            <input type="number" name="no_wa" placeholder="Contoh: 081234567890" style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px;" required>
                            <p class="text-xs text-gray-500 mt-1">Pastikan nomor aktif untuk undangan grup koordinasi.</p>
                        </div>
                    </div>

                    <!-- Tombol Biru dengan Inline Style agar Pasti Muncul -->
                    <button type="submit" style="background-color: #2563eb; color: white; font-weight: bold; padding: 10px 20px; border-radius: 6px; border: none; cursor: pointer; display: inline-block;">
                        Kirim Formulir Pendaftaran
                    </button>
                </form>
            </div>

           <!-- KOTAK 2: Tracking Status -->
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-bold mb-6 text-gray-800">Riwayat & Tracking Status</h3>
                
                @if($riwayat->isEmpty())
                    <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-md border border-dashed border-gray-300">
                        <p>Anda belum mendaftar perlombaan apapun.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                       @foreach($riwayat as $item)
                            <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm relative overflow-hidden">
           
                            <!-- Aksen warna di kiri kartu -->
                                <div class="absolute left-0 top-0 bottom-0 w-1 
                                    @if($item->status == 'Dokumen dalam Tinjauan') bg-yellow-400 
                                    @elseif($item->status == 'Jadwal Briefing') bg-blue-500
                                    @elseif($item->status == 'Tahap Pelatihan') bg-purple-500 
                                    @elseif($item->status == 'Final') bg-green-500
                                    @else bg-gray-400 @endif
                                "></div>
                                
                                <h4 class="font-bold text-lg text-gray-800 mb-1 pl-2">{{ $item->lomba->nama_lomba }}</h4>
                                <p class="text-xs text-gray-500 mb-2 pl-2">Kelas: {{ $item->kelas }} | No. WA: {{ $item->no_wa }}</p>
                                <p class="text-xs text-gray-400 mb-4 pl-2">Tanggal Daftar: {{ $item->created_at->format('d M Y') }}</p>
                                
                                <div class="flex flex-col pl-2">
                                    <span class="text-xs text-gray-600 mb-1 font-medium">Status Progres Terkini:</span>
                                    <div>
                                        @if($item->status == 'Dokumen dalam Tinjauan')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                Sedang Ditinjau Juri
                                            </span>
                                        @elseif($item->status == 'Jadwal Briefing')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                                Menunggu Undangan Briefing
                                            </span>
                                        @elseif($item->status == 'Tahap Pelatihan')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800 border border-purple-200">
                                                Tahap Pelatihan
                                            </span>
                                        @elseif($item->status == 'Final')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                                                Lolos ke Final!
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                                {{ $item->status }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>