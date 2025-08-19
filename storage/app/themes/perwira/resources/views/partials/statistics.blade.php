{{-- resources/views/partials/statistics.blade.php --}}
<div class="mt-16">
    <h2 class="text-2xl font-bold mb-1">Data Statistik</h2>
    <h3 class="text-green-600 text-2xl font-bold mb-6">{{ ucfirst(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa']) }}, {{ ucfirst(setting('sebutan_kecamatan_singkat')) }} {{ ucwords($desa['nama_kecamatan']) }}</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        
        <a  href="<?= site_url(); ?>data-wilayah">
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-shadow">
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-green-100 p-2 rounded-full">
                        <i data-lucide="users" class="h-6 w-6 text-green-600"></i>
                    </div>
                    <h3 class="font-semibold">Data Warga Administratif</h3>
                </div>
                <p class="text-xs text-gray-600">Info detail jumlah masyarakat sesuai administrasi {{ ucfirst(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa']) }}</p>
            </div>
        </a>

        <a href="<?= site_url(); ?>data-statistik/pendidikan-dalam-kk">
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-shadow">
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-green-100 p-2 rounded-full">
                        <i data-lucide="graduation-cap" class="h-6 w-6 text-green-600"></i>
                    </div>
                    <h3 class="font-semibold">Data Pendidikan</h3>
                </div>
                <p class="text-xs text-gray-600">Info detail jumlah warga pendidikan dalam {{ ucfirst(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa']) }}</p>
            </div>
        </a>
        <a href="<?= site_url(); ?>data-statistik/pendidikan-sedang-ditempuh">
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-shadow">
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-green-100 p-2 rounded-full">
                        <i data-lucide="building" class="h-6 w-6 text-green-600"></i>
                    </div>
                    <h3 class="font-semibold">Data Pendidikan yang Ditempuh</h3>
                </div>
                <p class="text-xs text-gray-600">Info detail jumlah warga pendidikan yang Ditempuh Di {{ ucfirst(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa']) }}</p>
            </div>
        </a>

        <a href="<?= site_url(); ?>data-statistik/pekerjaan">
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-shadow">
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-green-100 p-2 rounded-full">
                        <i data-lucide="home" class="h-6 w-6 text-green-600"></i>
                    </div>
                    <h3 class="font-semibold">Data Pekerjaan</h3>
                </div>
                <p class="text-xs text-gray-600">Info detail jumlah warga pekerjaan di {{ ucfirst(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa']) }}</p>
            </div>
        </a>

        <a href="<?= site_url(); ?>data-statistik/rentang-umur">
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-shadow">
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-green-100 p-2 rounded-full">
                        <i data-lucide="book" class="h-6 w-6 text-green-600"></i>
                    </div>
                    <h3 class="font-semibold">Data Rentang Umur</h3>
                </div>
                <p class="text-xs text-gray-600">Info detail rentang umur warga di {{ ucfirst(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa']) }}</p>
            </div>
        </a>

        <a href="<?= site_url(); ?>data-statistik/pekerjaan">
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-shadow">
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-green-100 p-2 rounded-full">
                        <i data-lucide="landmark" class="h-6 w-6 text-green-600"></i>
                    </div>
                    <h3 class="font-semibold">Data Pekerjaan Warga</h3>
                </div>
                <p class="text-xs text-gray-600">Info detail pekerjaan warga di {{ ucfirst(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa']) }}</p>
            </div>
        </a>
    </div>
</div>