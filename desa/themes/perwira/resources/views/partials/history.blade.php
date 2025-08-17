@if ($widgetAktif)
        @foreach ($widgetAktif as $widget)
            @php
                $judul_widget = [
                    'judul_widget' => str_replace('Desa', ucwords(setting('sebutan_desa')), strip_tags($widget['judul'])),
                ];
            @endphp
                @if (strtolower($widget['judul']) == "sejarah")
                    <div class="w-full md:w-1/2 relative">
                        <div class="border-l-4 border-green-600 pl-6 py-4">
                            <div class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full inline-block mb-2">
                                Sejarah Desa
                            </div>
                        <h2 class="text-2xl font-bold mb-1">Sejarah {{ ucfirst(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa']) }}</h2>
                        {{-- <p class="text-gray-500 text-sm mb-2">1794-1829</p> --}}
                        <p class="text-sm text-justify text-gray-700">
                            {!! potong_teks(html_entity_decode($widget['isi']), 350)  !!} {{ strlen($widget['isi']) > 100 ? '...' : '' }} 
                        </p>
                        <div class="flex justify-between items-center  mt-5">
                            <button class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700 transition-colors">
                                    Lihat Detail
                            </button>
                        </div>
                    </div>
                    <div class="absolute top-0 left-0 h-full w-1 border-l-2 border-dashed border-green-600"></div>
                        <div class="absolute top-0 left-0 w-4 h-4 rounded-full bg-green-600 -ml-2"></div>
                        <div class="absolute bottom-0 left-0 w-4 h-4 rounded-full bg-green-600 -ml-2"></div>
                    </div>
                @endif
        @endforeach
 @endif