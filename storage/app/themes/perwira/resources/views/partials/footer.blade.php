{{-- resources/views/partials/footer.blade.php --}}
<div class="container">
    @includeWhen($transparansi, 'theme::partials.apbdesa', $transparansi)
</div>
@include('theme::commons.back_to_top')
<!-- Bottom Navigation for Mobile (Fixed at bottom) -->
<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50 block md:hidden">
    <div class="flex justify-around py-2">
        <a href="/" class="flex flex-col items-center py-2 px-3 text-gray-600 hover:text-green-700 transition-colors">
            <i data-lucide="home" class="w-5 h-5 mb-1"></i>
            <span class="text-xs">Beranda</span>
        </a>
        <a href="/index.php?page=1" class="flex flex-col items-center py-2 px-3 text-gray-600 hover:text-green-700 transition-colors">
            <i data-lucide="newspaper" class="w-5 h-5 mb-1"></i>
            <span class="text-xs">Artikel</span>
        </a>
        <a href="/data-wilayah" class="flex flex-col items-center py-2 px-3 text-gray-600 hover:text-green-700 transition-colors">
            <i data-lucide="bar-chart-3" class="w-5 h-5 mb-1"></i>
            <span class="text-xs">Statistik</span>
        </a>
        <a href="/map.html" class="flex flex-col items-center py-2 px-3 text-gray-600 hover:text-green-700 transition-colors">
            <i data-lucide="users" class="w-5 h-5 mb-1"></i>
            <span class="text-xs">Peta</span>
        </a>
        <button onclick="toggleSocialMenu()" class="flex flex-col items-center py-2 px-3 text-gray-600 hover:text-green-700 transition-colors">
            <i data-lucide="share-2" class="w-5 h-5 mb-1"></i>
            <span class="text-xs">Sosmed</span>
        </button>
    </div>
    
    <!-- Social Media Popup -->
    <div id="social-popup" class="hidden absolute bottom-full left-0 right-0 bg-white border-t border-gray-200 p-4">
        <h4 class="text-sm font-semibold text-gray-800 mb-3 text-center">Ikuti Sosial Media Kami</h4>
        <div class="flex gap-3 justify-center mb-3">
            @foreach ($sosmed as $data)
                @if (!empty($data['link']))
                    <a href="{{ $data['link'] }}" class="bg-green-600 p-3 rounded-full hover:bg-green-500 transition-colors">
                        <i data-lucide="{{ $data['nama'] }}" class="w-5 h-5 text-white"></i>
                    </a>
                @endif
            @endforeach
        </div>
        <button onclick="toggleSocialMenu()" class="w-full bg-gray-100 text-gray-600 py-2 px-4 rounded-lg text-sm">
            Tutup
        </button>
    </div>
</div>

<!-- Main Footer -->
<footer class="bg-green-700 text-white py-6 md:py-8 pb-20 md:pb-8">
    <div class="max-w-6xl mx-auto px-4 md:px-6 lg:px-8">
        <!-- Mobile Layout -->
        <div class="block md:hidden space-y-6">
            <!-- Desa Info - Mobile -->
            <div class="text-center">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <img src="{{ gambar_desa($desa['logo']) }}" alt="Logo {{ ucfirst(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']) }}" class="h-10 w-auto">
                    </div>
                    <div>
                        <p class="text-base font-semibold">{{ ucfirst(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa']) }}</p>
                    </div>
                </div>
                <div class="text-sm space-y-1">
                    <p>{{ ucfirst(setting('sebutan_kecamatan')) }} {{ ucwords($desa['nama_kecamatan']) }}</p>
                    <p>{{ ucfirst(setting('sebutan_kabupaten')) }} {{ ucwords($desa['nama_kabupaten']) }}</p>
                    <p>Provinsi {{ ucwords($desa['nama_propinsi']) }}</p>
                    <p class="mt-3">Email: {{ $desa['email_desa'] }}</p>
                </div>
            </div>
            
            {{-- <!-- Quick Links - Mobile -->
            <div class="text-center">
                <h3 class="font-semibold mb-3 text-green-200">Menu Cepat</h3>
                <div class="grid grid-cols-2 gap-2 text-sm max-w-xs mx-auto">
                    <a href="/tentang" class="py-2 px-3 bg-green-600 rounded-lg hover:bg-green-500 transition-colors">Tentang Desa</a>
                    <a href="/artikel" class="py-2 px-3 bg-green-600 rounded-lg hover:bg-green-500 transition-colors">Artikel</a>
                    <a href="/data-wilayah" class="py-2 px-3 bg-green-600 rounded-lg hover:bg-green-500 transition-colors">Data Statistik</a>
                    <a href="/aparatur" class="py-2 px-3 bg-green-600 rounded-lg hover:bg-green-500 transition-colors">Aparatur Desa</a>
                </div>
            </div> --}}
        </div>
        
        <!-- Desktop Layout -->
        <div class="hidden md:flex md:flex-row">
            <div class="mb-6 md:mb-0 md:w-1/3">
                <!-- Desa Info -->
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-15 h-8 flex items-center justify-center">
                        <figure>
                            <img src="{{ gambar_desa($desa['logo']) }}" alt="Logo {{ ucfirst(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']) }}" class="h-10 mx-auto pb-2">
                        </figure>
                    </div>
                    <div class="mb-2">
                        <p class="text-sm font-semibold">{{ ucfirst(setting('sebutan_desa')) }}</p>
                        <p class="text-sm font-semibold -mt-1">{{ ucwords($desa['nama_desa']) }}</p>
                    </div>
                </div>
                <div class="text-sm space-y-1">
                    <p>{{ ucfirst(setting('sebutan_kecamatan')) }} {{ ucwords($desa['nama_kecamatan']) }}</p>
                    <p>{{ ucfirst(setting('sebutan_kabupaten')) }} {{ ucwords($desa['nama_kabupaten']) }}</p>
                    <p class="mb-4">Provinsi {{ ucwords($desa['nama_propinsi']) }}</p>
                    <p>Email: {{ $desa['email_desa'] }}</p>
                </div>
            </div>
                    
            <div class="mb-6 md:mb-0 flex flex-col items-center text-center md:w-1/3">
                <!-- Sosial Media -->
                <h3 class="font-semibold mb-3">Sosial Media</h3>
                <div class="flex gap-3 justify-center">
                    @foreach ($sosmed as $data)
                        @if (!empty($data['link']))
                            <a href="{{ $data['link'] }}" class="bg-green-600 p-2 rounded-md hover:bg-green-500 transition-colors">
                                <i data-lucide="{{ $data['nama'] }}" class="w-5 h-5"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
                    
            <div class="md:w-1/3 md:text-right">
                <!-- Konten -->
                <h3 class="font-semibold mb-3">Konten</h3>
                <ul class="space-y-2 text-sm inline-block text-left">
                    <li><a href="/tentang" class="hover:text-green-200 transition-colors">&gt; Tentang Desa</a></li>
                    <li><a href="/artikel" class="hover:text-green-200 transition-colors">&gt; Artikel</a></li>
                    <li><a href="/data-wilayah" class="hover:text-green-200 transition-colors">&gt; Data Statistik</a></li>
                    <li><a href="/aparatur" class="hover:text-green-200 transition-colors">&gt; Aparatur Desa</a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-green-600 mt-6 md:mt-8 pt-4 text-center text-xs">
            <p class="mb-2">Hak cipta situs &copy; {{ date('Y') }} - {{ ucfirst(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa']) }}</p>
            <p>
                <a href="https://akmalfadli.github.io" class="underline decoration-pink-500 underline-offset-1 decoration-2 hover:text-pink-200 transition-colors" target="_blank" rel="noopener">Tema Perwira {{ $themeVersion }}</a> -
                <a href="https://opensid.my.id" class="underline decoration-green-500 underline-offset-1 decoration-2 hover:text-green-200 transition-colors" target="_blank" rel="noopener">OpenSID {{ ambilVersi() }}</a> 
            </p>
        </div>
    </div>
</footer>

<!-- Add padding to body to prevent content overlap with fixed bottom nav -->
<style>
    @media (max-width: 768px) {
        body {
            padding-bottom: 80px;
        }
    }
</style>

<script>
function toggleSocialMenu() {
    const popup = document.getElementById('social-popup');
    popup.classList.toggle('hidden');
}

// Close social popup when clicking outside
document.addEventListener('click', function(event) {
    const popup = document.getElementById('social-popup');
    const button = event.target.closest('button[onclick="toggleSocialMenu()"]');
    
    if (!popup.contains(event.target) && !button) {
        popup.classList.add('hidden');
    }
});

// Add active state to bottom navigation based on current page
document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.fixed.bottom-0 a');
    
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (currentPath === href || (href !== '/' && currentPath.startsWith(href))) {
            link.classList.remove('text-gray-600');
            link.classList.add('text-green-700');
        }
    });
});
</script>