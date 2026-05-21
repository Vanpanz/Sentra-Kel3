<aside class="w-[260px] bg-[#80c4b7] text-white py-10 px-5 fixed top-0 left-0 h-screen flex flex-col z-[1000]">
    <div class="sidebar-brand">
        <div class="w-[70px] h-[70px] bg-white rounded-[20px] mx-auto mb-[15px] shadow-[0_4px_15px_rgba(0,0,0,0.1)] flex items-center justify-center"></div>
        <h2 class="text-center tracking-[2px] text-[1.2rem] font-extrabold text-white uppercase">
            SENTRA
        </h2>
    </div>

    <nav class="sidebar-nav mt-[50px]">
        <ul class="list-none flex flex-col">
            <?php
            $currentUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $menuItems = [
                ['url' => '/events', 'label' => 'Homepage'],
                ['url' => '/profile', 'label' => 'Profile'],
                ['url' => '/faq', 'label' => 'FAQ'],
                ['url' => '/about-us', 'label' => 'About Us']
            ];
            
            foreach ($menuItems as $item):
                $isActive = $currentUri === $item['url'];
                $activeClass = $isActive ? 'bg-white text-[#64b3a4] font-bold shadow-[0_10px_30px_rgba(0,0,0,0.05)]' : 'text-white/90 font-medium hover:bg-white/15 hover:translate-x-[5px]';
            ?>
            <li>
                <a href="<?= htmlspecialchars($item['url']); ?>" class="flex items-center gap-3 px-[18px] py-[14px] mb-2.5 rounded-xl cursor-pointer transition-all duration-300 <?= $activeClass; ?>">
                    <?= htmlspecialchars($item['label']); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</aside>