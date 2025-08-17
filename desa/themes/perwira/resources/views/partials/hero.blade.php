{{-- resources/views/partials/hero.blade.php --}}
@php
    $bg_header = $latar_website;
@endphp
<div class="relative h-[300px] md:h-[400px] bg-green-700 text-white overflow-hidden">
    {{-- background --}}
    <div class="absolute inset-0 bg-cover bg-center opacity-50" 
         style="background-image: url({{ $bg_header }});">
    </div>
    
    {{-- hero content --}}
    <div class="relative z-10 h-full flex flex-col justify-center ml-8">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-2">
            Website Resmi
        </h1>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
            {{ ucfirst(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa']) }}
        </h2>
        <p class="text-sm">{{ ucfirst(setting('sebutan_kecamatan')) }} {{ ucwords($desa['nama_kecamatan']) }} 
            {{ ucfirst(setting('sebutan_kabupaten')) }} {{ ucwords($desa['nama_kabupaten']) }}</p>
        <p class="text-sm">Provinsi {{ ucwords($desa['nama_propinsi']) }}</p>
    </div>

    
    @if ($teks_berjalan)
        <div class="absolute bottom-0 left-0 right-0 bg-white bg-opacity-20 py-1.5 text-xs z-20">
            <marquee onmouseover="this.stop();" onmouseout="this.start();" class="block">
                @foreach ($teks_berjalan as $marquee)
                    <span class="px-3">
                        {{ $marquee['teks'] }}
                        @if (trim($marquee['tautan']) && $marquee['judul_tautan'])
                            <a href="{{ $marquee['tautan'] }}" class="hover:text-link">{{ $marquee['judul_tautan'] }}</a>
                        @endif
                    </span>
                @endforeach
            </marquee>
        </div>
    @endif
</div>
