{{-- resources/views/partials/hero.blade.php --}}
@php
    $bg_header = $latar_website;
@endphp
<div class="relative h-[275px] sm:h-[300px] md:h-[350px] lg:h-[450px] bg-green-700 text-white overflow-hidden">
  
    {{-- Single Background for both menu and hero --}}
    <div class="absolute inset-0 bg-cover bg-center" 
         style="background-image: url({{ $bg_header }});">
    </div>
    
    {{-- Dark overlay for better text contrast --}}
    <div class="absolute inset-0 bg-green-700 bg-opacity-50"></div>
    
    {{-- Navigation Menu at the top --}}
    <div class="absolute top-0 left-0 right-0 z-30">
        {{-- Menu content --}}
        <div class="relative z-10 h-full flex flex-col justify-between">
            {{-- Desktop Menu --}}
            <div class="hidden lg:flex lg:flex-row justify-between pl-8 pr-8 mt-4">
                <div class="flex items-center gap-2">
                    <div class="w-15 h-8 flex items-center justify-center">
                        <a href="{{ ci_route() }}" class="block">
                            <figure>
                                <img src="{{ gambar_desa($desa['logo']) }}" alt="Logo {{ ucfirst(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']) }}" class="h-12 mx-auto pb-2">
                            </figure>
                        </a>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">{{ ucfirst(setting('sebutan_desa')) }}</p>
                        <p class="text-sm font-semibold -mt-1">{{ ucwords($desa['nama_desa']) }}</p>
                    </div>
                </div>
                <div>
                    <nav class="text-white text-sm" role="navigation">
                        <ul class="flex">
                            @if (menu_tema())
                                @foreach (menu_tema() as $menu)
                                    @php $has_dropdown = count($menu['childrens'] ?? []) > 0 @endphp
                                    <li class="relative" @if ($has_dropdown) x-data="{dropdown: false}" @endif>
                                        @php $menu_link = $has_dropdown ? '#!' : $menu['link_url'] @endphp
                                        <a href="{{ $menu_link }}" class="p-2 inline-block text-white font-medium transition-all duration-300" 
                                        @if ($has_dropdown)
                                            @mouseover="dropdown = true" @mouseleave="dropdown = false" @click="dropdown = !dropdown" 
                                            aria-expanded="false" aria-haspopup="true"
                                        @endif
                                        >
                                            {{ $menu['nama'] }}
                                            @if ($has_dropdown)
                                                <i class="fas fa-chevron-down text-xs ml-1 inline-block transition duration-300" :class="{ 'transform rotate-180': dropdown }"></i>
                                            @endif
                                        </a>

                                        @if ($has_dropdown)
                                            <ul class="absolute top-full left-0 min-w-max bg-white/95 backdrop-blur-md text-gray-700 shadow-md invisible transform transition duration-200 origin-top rounded-sm overflow-hidden" 
                                                :class="{ 'opacity-0 invisible z-[-10] scale-y-50': !dropdown, 'opacity-100 visible z-[9999] scale-y-100': dropdown }" 
                                                x-transition @mouseover="dropdown = true" @mouseleave="dropdown = false">
                                                @foreach ($menu['childrens'] as $childrens)
                                                    <li><a href="{{ $childrens['link_url'] }}" class="block py-3 pl-5 pr-4 hover:bg-primary-200 hover:text-white transition-colors whitespace-nowrap">{{ $childrens['nama'] }}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            
            {{-- Mobile Menu --}}
            <div class="lg:hidden fixed w-full bg-green-700 bg-opacity-80 backdrop-blur-sm flex flex-row justify-between pl-4 pr-4 pt-2 pb-2">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-6 flex items-center justify-center">
                        <a href="{{ ci_route() }}" class="block">
                            <figure>
                                <img src="{{ gambar_desa($desa['logo']) }}" 
                                    alt="Logo {{ ucfirst(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']) }}" 
                                    class="h-10 mx-auto pb-2">
                            </figure>
                        </a>
                    </div>
                    <div class="mb-2">
                        <p class="text-sm font-semibold">{{ ucfirst(setting('sebutan_desa')) }}</p>
                        <p class="text-sm font-semibold -mt-1">{{ ucwords($desa['nama_desa']) }}</p>
                    </div>
                </div>
                <div class="mt-2">
                    @include('theme::commons.mobile_menu')
                </div>
            </div>
        </div>
    </div>
    
    {{-- Hero content with more top padding --}}
    <div class="relative z-10 h-full flex flex-col md:flex-row pt-20 lg:pt-16">
        {{-- Desktop content --}}
        <div class="hidden lg:flex flex-1 flex-col justify-center px-4 sm:px-6 md:ml-8 md:px-0 lg:px-6 lg:ml-4 lg:px-0 lg:mt-20 lg:mb-20">
            <h1 class="text-lg sm:text-xl md:text-3xl lg:text-4xl xl:text-5xl font-bold mb-1 sm:mb-2 leading-tight">
                Website Resmi
            </h1>
            
            <h2 class="text-lg sm:text-xl md:text-3xl lg:text-4xl xl:text-5xl font-bold mb-2 sm:mb-3 md:mb-4 leading-tight">
                {{ ucfirst(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa']) }}
            </h2>
            <div class="text-xs sm:text-sm md:text-base space-y-0.5">
                <p>{{ ucfirst(setting('sebutan_kecamatan')) }} {{ ucwords($desa['nama_kecamatan']) }} 
                   {{ ucfirst(setting('sebutan_kabupaten')) }} {{ ucwords($desa['nama_kabupaten']) }}</p>
                <p>Provinsi {{ ucwords($desa['nama_propinsi']) }}</p>
            </div>
        </div>
        
        {{-- Mobile content --}}
        <div class="lg:hidden flex-1 flex flex-col mb-4 items-center">
            <figure>
                <img src="{{ gambar_desa($desa['logo']) }}" 
                        alt="Logo {{ ucfirst(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']) }}" 
                        class="h-12 mx-auto pb-2">
            </figure>
            <h1 class="text-sm font-bold">
                Website Resmi
            </h1>
            
            <h2 class="text-sm font-bold">
                {{ ucfirst(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa']) }}
            </h2>
            <div class="text-xs text-center">
                <p>{{ ucfirst(setting('sebutan_kecamatan')) }} {{ ucwords($desa['nama_kecamatan']) }} 
                {{ ucfirst(setting('sebutan_kabupaten')) }} {{ ucwords($desa['nama_kabupaten']) }}</p>
                <p>Provinsi {{ ucwords($desa['nama_propinsi']) }}</p>
            </div>
            <div class="rounded-lg p-2 sm:p-3 inline-block text-center">
                <div class="text-center">
                    <div id="digital-date-mobile" class="text-xs opacity-90 mb-1">
                        Loading...
                    </div>
                    <div id="working-hours-mobile" class="text-xs opacity-80">
                        {{-- Working hours for current day will be inserted here by JavaScript --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Digital Clock - Desktop: right side --}}
        <div class="hidden md:flex md:flex-col md:justify-center md:items-center md:mr-4 md:min-w-[200px]">
            <div class="bg-green bg-opacity-15 backdrop-blur-sm rounded-lg p-4 mb-8">
                <div class="text-left">
                    <div id="digital-clock" class="text-2xl lg:text-3xl font-mono font-bold mb-1">
                        00:00:00
                    </div>
                    <div id="digital-date" class="text-sm opacity-90 mb-2">
                        Loading...
                    </div>
                    <div id="working-hours" class="text-xs opacity-80">
                        {{-- Working hours for current day will be inserted here by JavaScript --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Running text for both mobile and desktop --}}
    @if ($teks_berjalan)
        <div class="absolute bottom-0 left-0 right-0 bg-white bg-opacity-20 py-1 sm:py-1.5 text-xs z-20">
            <div class="marquee-container">
                <marquee onmouseover="this.stop();" onmouseout="this.start();" class="block">
                    @foreach ($teks_berjalan as $marquee)
                        <span class="px-2 sm:px-3">
                            {{ $marquee['teks'] }}
                            @if (trim($marquee['tautan']) && $marquee['judul_tautan'])
                                <a href="{{ $marquee['tautan'] }}" class="hover:text-link underline">{{ $marquee['judul_tautan'] }}</a>
                            @endif
                        </span>
                    @endforeach
                </marquee>
            </div>
        </div>
    @endif
</div>

<style>
    /* Custom width class for dropdown menu */
    .min-w-max {
        min-width: max-content;
    }
    
    /* Enhanced text shadows for better readability */
    .text-shadow-strong {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.9);
    }
    
    /* Smooth transitions for menu interactions */
    nav a {
        transition: all 0.3s ease;
    }
    
    /* Responsive adjustments */
    @media (max-width: 640px) {
        .marquee-container {
            white-space: nowrap;
            overflow: hidden;
        }
    }
    
    @media (max-width: 768px) {
        #working-hours .bg-green-500,
        #working-hours .bg-red-500,
        #working-hours-mobile .bg-green-500,
        #working-hours-mobile .bg-red-500 {
            font-size: 10px;
            padding: 2px 6px;
        }
    }
</style>

<script>
// Working hours data from PHP
const workingHoursData = @json($jam_kerja ?? []);

function updateClock() {
    const now = new Date();
    
    // Format time (24-hour format)
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    const timeString = `${hours}:${minutes}:${seconds}`;
    
    // Format date
    const options = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric'
    };
    const dateString = now.toLocaleDateString('id-ID', options);
    
    // Get current day name in Indonesian
    const dayNames = {
        'Sunday': 'Minggu',
        'Monday': 'Senin', 
        'Tuesday': 'Selasa',
        'Wednesday': 'Rabu',
        'Thursday': 'Kamis',
        'Friday': 'Jumat',
        'Saturday': 'Sabtu'
    };
    
    const currentDay = now.toLocaleDateString('en-US', { weekday: 'long' });
    const currentDayIndo = dayNames[currentDay];
    
    // Find working hours for current day
    let workingHoursHTML = '';
    
    if (workingHoursData && workingHoursData.length > 0) {
        const todaySchedule = workingHoursData.find(schedule => 
            schedule.nama_hari.toLowerCase() === currentDayIndo.toLowerCase()
        );
        
        if (todaySchedule) {
            if (todaySchedule.status) {
                const masuk = todaySchedule.jam_masuk.substring(0, 5);
                const keluar = todaySchedule.jam_keluar.substring(0, 5);
                const workingHoursText = `${masuk} - ${keluar}`;
                
                const current = `${hours}:${minutes}`;
                const isOpen = current >= masuk && current <= keluar;
                
                workingHoursHTML = isOpen
                    ? `<span class="bg-green-500 text-white px-2 py-0.5 rounded text-xs">Buka</span> ${workingHoursText}`
                    : `<span class="bg-yellow-500 text-white px-2 py-0.5 rounded text-xs">Tutup</span> ${workingHoursText}`;
            } else {
                workingHoursHTML = '<span class="bg-red-500 text-white px-2 py-0.5 rounded text-xs">Libur</span>';
            }
        }
    }
    
    // Update elements
    const clockElement = document.getElementById('digital-clock');
    const dateElement = document.getElementById('digital-date');
    const workingHoursElement = document.getElementById('working-hours');
    const dateMobileElement = document.getElementById('digital-date-mobile');
    const workingHoursMobileElement = document.getElementById('working-hours-mobile');
    
    if (clockElement) clockElement.textContent = timeString;
    if (dateElement) dateElement.textContent = dateString;
    if (dateMobileElement) dateMobileElement.textContent = dateString;
    if (workingHoursElement) workingHoursElement.innerHTML = workingHoursHTML;
    if (workingHoursMobileElement) workingHoursMobileElement.innerHTML = workingHoursHTML;
}

// Initialize clock
updateClock();
setInterval(updateClock, 1000);
</script>