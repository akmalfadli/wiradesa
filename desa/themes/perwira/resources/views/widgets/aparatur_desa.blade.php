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
                    <p class="text-xs text-gray-600">{{ $data['jabatan'] }}</p>
                </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            <button class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm text-center hover:bg-green-700 transition-colors">
                Lihat Selengkapnya
            </button>
        </div>
    </div>
</div>
