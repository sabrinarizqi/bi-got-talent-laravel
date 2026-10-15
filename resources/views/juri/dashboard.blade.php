<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Juri - Penilaian Peserta Bi-Got Talent') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('success') }}
                    </div>
                @endif

                <h3 class="text-lg font-bold mb-4 text-gray-700">Daftar Peserta & Penilaian</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Nama Peserta</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Kelas</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Mata Lomba</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Status Seleksi</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Penilaian & Catatan Juri</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pendaftarans as $p)
                            <tr>
                                <td class="px-4 py-3 text-sm font-semibold text-gray-800">
                                    {{ $p->user->name ?? 'Siswa' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $p->kelas }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $p->lomba->nama_lomba ?? 'Lomba' }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($p->status_seleksi == 'Lolos')
                                        <span class="px-2 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800">Lolos</span>
                                    @elseif($p->status_seleksi == 'Tidak Lolos')
                                        <span class="px-2 py-1 text-xs font-bold rounded-full bg-red-100 text-red-800">Tidak Lolos</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
    <form action="{{ route('juri.update.nilai', $p->id) }}" method="POST" class="space-y-2">
        @csrf
        <div class="space-y-2">
            <select name="status_seleksi" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="Pending" {{ $p->status_seleksi == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Lolos" {{ $p->status_seleksi == 'Lolos' ? 'selected' : '' }}>Lolos</option>
                <option value="Tidak Lolos" {{ $p->status_seleksi == 'Tidak Lolos' ? 'selected' : '' }}>Tidak Lolos</option>
            </select>
            
            <textarea name="catatan_juri" rows="2" placeholder="Tuliskan catatan/alasan jika tidak lolos..." class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $p->catatan_juri }}</textarea>
            
            <button type="submit" style="background-color: #4f46e5; color: white; width: 100%; padding: 6px 12px; font-size: 12px; font-weight: bold; border-radius: 4px; border: none; cursor: pointer;">
                Simpan Penilaian
            </button>
        </div>
    </form>
</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center text-sm text-gray-500">Belum ada peserta yang mendaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>