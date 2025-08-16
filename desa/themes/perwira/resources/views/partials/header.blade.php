{{-- resources/views/partials/header.blade.php --}}
<header class="bg-green-700 text-white py-3 px-4 md:px-6 lg:px-8">
    <div class="flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 flex items-center justify-center">
                <figure>
                    <img src="{{ gambar_desa($desa['logo']) }}" alt="Logo {{ ucfirst(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']) }}" class="h-16 mx-auto pb-2">
                </figure>
            </div>
            <div>
                <p class="text-sm font-semibold">{{ ucfirst(setting('sebutan_desa')) }}</p>
                <p class="text-sm font-semibold -mt-1">{{ ucwords($desa['nama_desa']) }}</p>
            </div>
        </div>
        @include('theme::commons.main_menu')
        @include('theme::commons.mobile_menu')
        {{-- <div class="hidden md:flex space-x-6">
            <a href="#" class="text-sm hover:underline">Informasi</a>
            <a href="#" class="text-sm hover:underline">Statistik</a>
            <a href="#" class="text-sm hover:underline">Digital Desa</a>
            <a href="#" class="text-sm hover:underline">Halaman Utama Desa</a>
        </div> --}}
        
        <div class="md:hidden">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </div>
    </div>
</header>