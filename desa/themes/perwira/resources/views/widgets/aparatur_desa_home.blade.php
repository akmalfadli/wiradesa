<div class="mt-16 mb-16">
    <div class="bg-gray-100 rounded-lg p-6 text-center"> {{-- added text-center here for all text --}}
        
        <div class="bg-green-600 text-white py-1 px-4 rounded-full inline-block mb-4">
            Aparatur Desa
        </div>
        
        <h2 class="text-2xl font-bold mb-4">Aparatur Desa</h2>
        
        <p class="text-sm text-gray-700 mb-6 max-w-2xl mx-auto">
            Dalam pelaksanaannya, aparatur desa memiliki peran yang sangat penting
            dalam melaksanakan berbagai tugas dan tanggung jawab mereka.
        </p>
        
        <div class="flex flex-wrap justify-center gap-8">
            @foreach ($aparatur_desa['daftar_perangkat'] as $data)
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-white shadow-lg">
                        <img src="{{ $data['foto'] }}" 
                             alt="{{ $data['nama'] }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-semibold mt-2">{{ $data['nama'] }}</h3>
                    <p class="text-xs text-gray-600 mb-2">{{ $data['jabatan'] }}</p>
                    @if ($data['kehadiran'] == 1)
                        @if ($data['status_kehadiran'] == 'hadir')
                            <span class="btn btn-primary w-auto mx-auto inline-block text-xs">Hadir</span>
                        @endif
                        @if ($data['tanggal'] == date('Y-m-d') && $data['status_kehadiran'] != 'hadir')
                            <span class="btn btn-danger w-auto mx-auto inline-block text-xs">{{ ucwords($data['status_kehadiran']) }}</span>
                        @endif
                        @if ($data['tanggal'] != date('Y-m-d'))
                            <span class="btn btn-danger w-auto mx-auto inline-block text-xs">Belum Rekam Kehadiran</span>
                        @endif
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
