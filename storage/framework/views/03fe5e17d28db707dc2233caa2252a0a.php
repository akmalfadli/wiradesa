<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<?php
// Social media icon mapping
$social_icons = [
    'facebook' => ['icon' => 'facebook', 'color' => 'bg-blue-600'],
    'instagram' => ['icon' => 'instagram', 'color' => 'bg-pink-500'],
    'twitter' => ['icon' => 'twitter', 'color' => 'bg-blue-400'],
    'x' => ['icon' => 'twitter', 'color' => 'bg-black'],
    'youtube' => ['icon' => 'youtube', 'color' => 'bg-red-500'],
    'whatsapp' => ['icon' => 'phone', 'color' => 'bg-green-500'],
    'telegram' => ['icon' => 'send', 'color' => 'bg-blue-500'],
    'tiktok' => ['icon' => 'music', 'color' => 'bg-black'],
    'linkedin' => ['icon' => 'linkedin', 'color' => 'bg-blue-700'],
    'email' => ['icon' => 'mail', 'color' => 'bg-gray-600'],
    'website' => ['icon' => 'globe', 'color' => 'bg-primary-700'],
];

function getSocialMediaInfo($name) {
    global $social_icons;
    
    $name_lower = strtolower($name);
    
    // Check for exact matches first
    if (isset($social_icons[$name_lower])) {
        return $social_icons[$name_lower];
    }
    
    // Check for partial matches
    foreach ($social_icons as $key => $value) {
        if (strpos($name_lower, $key) !== false) {
            return $value;
        }
    }
    
    // Default fallback
    return ['icon' => 'globe', 'color' => 'bg-primary-700'];
}
?>

<div class="box box-primary box-solid items-center">
    <div class="bg-green-600 flex items-center justify-center py-3 px-6 mb-1">
        <h3 class="text-md font-semibold text-white text-center">
            <?php echo e(strtoupper($judul_widget)); ?>

        </h3>
    </div>
    <div class="h-1 bg-green-500 mb-2"></div>
    
    <?php if(count($sosmed) > 0): ?>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
            <?php $__currentLoopData = $sosmed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($data['link'])): ?>
                    <?php
                        $social_info = getSocialMediaInfo($data['nama']);
                    ?>
                    <a href="<?php echo e($data['link']); ?>" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="group relative w-14 h-14 <?php echo e($social_info['color']); ?> rounded-xl flex items-center justify-center hover:scale-110 transition-all duration-300 hover:shadow-lg"
                       title="<?php echo e($data['nama']); ?>">
                        
                        <?php if(!empty($data['icon']) && filter_var($data['icon'], FILTER_VALIDATE_URL)): ?>
                            <!-- Custom icon from URL -->
                            <img src="<?php echo e($data['icon']); ?>" 
                                 alt="<?php echo e($data['nama']); ?>" 
                                 class="w-8 h-8 object-contain rounded"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" />
                            <i data-lucide="<?php echo e($social_info['icon']); ?>" 
                               class="w-6 h-6 text-white" 
                               style="display: none;"></i>
                        <?php else: ?>
                            <!-- Lucide icon -->
                            <i data-lucide="<?php echo e($social_info['icon']); ?>" class="w-6 h-6 text-white"></i>
                        <?php endif; ?>
                        
                        <!-- Tooltip -->
                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap z-10">
                            <?php echo e($data['nama']); ?>

                        </div>
                    </a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <!-- Empty State -->
        <div class="text-center py-8">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="globe" class="w-8 h-8 text-gray-400"></i>
            </div>
            <p class="text-gray-600">Belum ada media sosial yang tersedia</p>
        </div>
    <?php endif; ?>
</div><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/perwira/resources/views/widgets/media_sosial.blade.php ENDPATH**/ ?>