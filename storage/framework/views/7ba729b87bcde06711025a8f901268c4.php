
<?php
    $bg_header = $latar_website;
?>
<div class="relative h-[250px] sm:h-[300px] md:h-[400px] bg-green-700 text-white overflow-hidden">
    
    <div class="absolute inset-0 bg-cover bg-center opacity-50" 
         style="background-image: url(<?php echo e($bg_header); ?>);">
    </div>
    
    
    <div class="relative z-10 h-full flex flex-col md:flex-row">
        
        <div class="flex-1 flex flex-col justify-center px-4 sm:px-6 md:ml-8 md:px-0">
            <h1 class="text-lg sm:text-xl md:text-3xl lg:text-4xl xl:text-5xl font-bold mb-1 sm:mb-2 leading-tight">
                Website Resmi
            </h1>
            
            <h2 class="text-lg sm:text-xl md:text-3xl lg:text-4xl xl:text-5xl font-bold mb-2 sm:mb-3 md:mb-4 leading-tight">
                <?php echo e(ucfirst(setting('sebutan_desa'))); ?> <?php echo e(ucwords($desa['nama_desa'])); ?>

            </h2>
            <div class="text-xs sm:text-sm md:text-base space-y-0.5">
                <p><?php echo e(ucfirst(setting('sebutan_kecamatan'))); ?> <?php echo e(ucwords($desa['nama_kecamatan'])); ?> 
                   <?php echo e(ucfirst(setting('sebutan_kabupaten'))); ?> <?php echo e(ucwords($desa['nama_kabupaten'])); ?></p>
                <p>Provinsi <?php echo e(ucwords($desa['nama_propinsi'])); ?></p>
            </div>
        </div>
        
            <div class="md:hidden p-4 mb-4">
                <div class="bg-green bg-opacity-30 backdrop-blur-sm rounded-lg p-2 sm:p-3 inline-block">
                    <div class="text-left">
                        <div id="digital-clock-mobile" class="text-sm sm:text-lg font-mono font-bold mb-1">
                            00:00:00
                        </div>
                        <div id="digital-date-mobile" class="text-xs opacity-90 mb-1 sm:block">
                            Loading...
                        </div>
                        <div id="working-hours-mobile" class="text-xs opacity-80">
                            
                        </div>
                    </div>
                </div>
            </div>

        
        <div class="hidden md:flex md:flex-col md:justify-center md:items-center md:mr-4 md:min-w-[200px]">
            <div class="bg-green bg-opacity-20 backdrop-blur-sm rounded-lg p-4">
                <div class="text-left">
                    <div id="digital-clock" class="text-2xl lg:text-3xl font-mono font-bold mb-1">
                        00:00:00
                    </div>
                    <div id="digital-date" class="text-sm opacity-90 mb-2">
                        Loading...
                    </div>
                    <div id="working-hours" class="text-xs opacity-80">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php if($teks_berjalan): ?>
        <div class="absolute bottom-0 left-0 right-0 bg-white bg-opacity-20 py-1 sm:py-1.5 text-xs z-20">
            <div class="marquee-container">
                <marquee onmouseover="this.stop();" onmouseout="this.start();" class="block">
                    <?php $__currentLoopData = $teks_berjalan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marquee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="px-2 sm:px-3">
                            <?php echo e($marquee['teks']); ?>

                            <?php if(trim($marquee['tautan']) && $marquee['judul_tautan']): ?>
                                <a href="<?php echo e($marquee['tautan']); ?>" class="hover:text-link underline"><?php echo e($marquee['judul_tautan']); ?></a>
                            <?php endif; ?>
                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </marquee>
            </div>
        </div>
    <?php endif; ?>
</div>


<style>
    /* Ensure text remains readable on mobile */
    @media (max-width: 640px) {
        .hero-title {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
        }
        
        /* Prevent text overflow on very small screens */
        .hero-content h1, .hero-content h2 {
            word-wrap: break-word;
            hyphens: auto;
        }
        
        /* Better marquee performance on mobile */
        .marquee-container {
            white-space: nowrap;
            overflow: hidden;
        }
    }
    
    /* Improve clock readability */
    #digital-clock {
        text-shadow: 1px 1px 2px rgba(0,0,0,0.8);
    }
    
    /* Better working hours display on mobile */
    @media (max-width: 768px) {
        #working-hours .bg-green-500,
        #working-hours .bg-red-500 {
            font-size: 10px;
            padding: 2px 6px;
        }
    }
</style>


<script>
// Working hours data from PHP
const workingHoursData = <?php echo json_encode($jam_kerja ?? [], 15, 512) ?>;

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
    let workingHoursText = '';
    let workingHoursHTML = '';
    
    if (workingHoursData && workingHoursData.length > 0) {
        const todaySchedule = workingHoursData.find(schedule => 
            schedule.nama_hari.toLowerCase() === currentDayIndo.toLowerCase()
        );
        
        if (todaySchedule) {
            if (todaySchedule.status) {
                let masuk = todaySchedule.jam_masuk.substring(0, 5);   // "08:00"
                let keluar = todaySchedule.jam_keluar.substring(0, 5); // "16:00"
                workingHoursText = `${masuk} - ${keluar}`;
                
                // Current time in HH:MM
                let current = `${hours}:${minutes}`;
                
                // Check if open or closed
                let isOpen = current >= masuk && current <= keluar;
                
                workingHoursHTML = isOpen
                    ? `<span class="bg-green-500 text-white px-2 py-0.5 rounded text-xs">Buka</span> ${workingHoursText}`
                    : `<span class="bg-yellow-500 text-white px-2 py-0.5 rounded text-xs">Tutup</span> ${workingHoursText}`;
            } else {
                workingHoursText = 'Libur';
                workingHoursHTML = '<span class="bg-red-500 text-white px-2 py-0.5 rounded text-xs">Libur</span>';
            }
        }
    }
    
    // Update desktop elements
    const clockElement = document.getElementById('digital-clock');
    const dateElement = document.getElementById('digital-date');
    const workingHoursElement = document.getElementById('working-hours');
    
    // Update mobile elements
    const clockMobileElement = document.getElementById('digital-clock-mobile');
    const dateMobileElement = document.getElementById('digital-date-mobile');
    const workingHoursMobileElement = document.getElementById('working-hours-mobile');
    
    // Update desktop clock
    if (clockElement) clockElement.textContent = timeString;
    if (dateElement) dateElement.textContent = dateString;
    
    // Update mobile clock
    if (clockMobileElement) clockMobileElement.textContent = timeString;
    if (dateMobileElement) dateMobileElement.textContent = dateString;
    
    // Update working hours for both desktop and mobile
    if (workingHoursElement) workingHoursElement.innerHTML = workingHoursHTML;
    if (workingHoursMobileElement) workingHoursMobileElement.innerHTML = workingHoursHTML;
}


// Update clock immediately and then every second
updateClock();
setInterval(updateClock, 1000);
</script><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//desa/themes/perwira/resources/views/partials/hero.blade.php ENDPATH**/ ?>