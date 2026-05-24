<aside class="w-[260px] bg-gradient-to-b from-[#5CBBA2] to-[#CAFFEA] text-white py-10 px-5 fixed top-0 left-0 h-screen flex flex-col z-[1000]">
    <div class="sidebar-brand">
        <div class="w-[70px] h-[70px] bg-white rounded-full mx-auto mb-[15px] shadow-[0_4px_15px_rgba(0,0,0,0.1)] overflow-hidden flex items-center justify-center">
            <img src="/assets/foto/sentraasli(1).png" alt="Sentra Logo" class="w-full h-full object-cover" />
        </div>
        <h2 class="text-center tracking-[2px] text-[1.2rem] font-extrabold text-white uppercase">
            SENTRA
        </h2>
    </div>
    <div class="border-b border-white/40 my-3 -mx-5"></div>

    <nav class="sidebar-nav mt-0">
        <ul class="list-none flex flex-col">
            <?php
            $currentUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $menuItems = [
                ['url' => '/events', 'label' => 'Homepage'],
                ['url' => '/profile', 'label' => 'Profile'],
                ['url' => '/faq', 'label' => 'FAQ'],
                ['url' => '/about-us', 'label' => 'About Us']
            ];
            
            foreach ($menuItems as $index => $item):
                $isActive = $currentUri === $item['url'];
                $activeClass = $isActive ? 'bg-[#E4FEF7]/30 text-white font-bold shadow-[0_10px_30px_rgba(0,0,0,0.05)]' : 'text-white/90 font-medium hover:bg-[#E4FEF7]/15 hover:translate-x-[5px]';
            ?>
            <li>
                <a href="<?= htmlspecialchars($item['url']); ?>" class="flex items-center justify-center gap-3 pl-[35px] pr-[18px] py-[15px] -ml-5 rounded-r-xl cursor-pointer transition-all duration-300 text-lg <?= $activeClass; ?>">
                    <?= htmlspecialchars($item['label']); ?>
                </a>
            </li>
            <?php if ($index < count($menuItems) - 1): ?>
            <div class="border-b border-white/40 my-3 -mx-5"></div>
            <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </nav>
</aside>