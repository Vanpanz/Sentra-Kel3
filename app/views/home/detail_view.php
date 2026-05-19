<?php 
// Panggil file kontroler logika di baris paling atas
require_once __DIR__ . '/../../models/detail_controller.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title'] ?? 'Event Detail') ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#E4F9F4] text-gray-700 antialiased min-h-screen pb-12 flex flex-col">

    <div class="w-full text-center py-2 bg-transparent text-[10px] font-bold text-[#3D8F76] uppercase tracking-widest border-b border-[#CBEFE6]">
        Xtraordinary Youth Zone
    </div>

    <div class="w-full max-w-7xl mx-auto px-6 lg:px-12 mt-6 flex-1 space-y-6">
        
        <header class="flex items-center justify-between">
            <a href="/homepage" class="text-[#50B498] font-bold text-sm flex items-center gap-1.5 hover:underline transition-all">
                <span>←</span> Back to Home
            </a>

            <?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin'): ?>
                <a href="/edit?id=<?= $post['id'] ?>" class="bg-[#79D3BC] text-white hover:bg-[#5dbfa6] px-5 py-2 rounded-xl text-xs font-bold transition-all shadow-sm inline-block">
                    ✏️ Edit Event
                </a>
            <?php endif; ?>
        </header>

        <h1 class="text-3xl font-extrabold tracking-tight text-gray-800">Event Detail</h1>

        <div class="w-full aspect-[3/1] md:aspect-[21/6] rounded-3xl overflow-hidden shadow-sm bg-white border border-white">
            <?php if (!empty($post['image_path'])): ?>
                <img src="/<?= htmlspecialchars($post['image_path']) ?>" alt="Banner Detail" class="w-full h-full object-cover">
            <?php else: ?>
                <div class="w-full h-full bg-gradient-to-r from-[#A7EDE4] to-[#79D3BC] flex items-center justify-center text-white font-bold text-sm">
                    No Banner Provided
                </div>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            
            <div class="lg:col-span-2">
                <div class="bg-white p-6 rounded-3xl shadow-[0_8px_30px_rgba(0,0,0,0.01)] border border-white flex flex-col justify-between min-h-[280px]">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-extrabold text-gray-800 tracking-tight"><?= htmlspecialchars($post['title'] ?? 'Nama Kegiatan') ?></h2>
                            <span class="bg-[#DFF4EE] text-[#3B7A70] px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                Ongoing
                            </span>
                        </div>
                        
                        <div class="text-gray-500 text-xs leading-relaxed font-medium whitespace-pre-line">
                            <?= nl2br(htmlspecialchars($post['content'] ?? 'Belum ada deskripsi konten untuk kegiatan ini.')) ?>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-50 flex flex-wrap gap-6 text-xs font-bold text-[#636e72]">
                        <span class="flex items-center gap-1">📅 <?= htmlspecialchars($post['event_date'] ?? '12-19 Desember 20XX') ?></span>
                        <span class="flex items-center gap-1">📍 <?= htmlspecialchars($post['location'] ?? 'Lapangan Utama') ?></span>
                    </div>
                </div>
            </div>
                
            <div class="space-y-4">
                
                <div class="bg-white p-6 rounded-3xl shadow-[0_8px_30px_rgba(0,0,0,0.01)] border border-white text-center space-y-3">
                    <h3 class="text-xs font-extrabold text-gray-700 uppercase tracking-wider">Pendaftaran Kegiatan</h3>
                    <p class="text-[11px] text-gray-400 font-medium leading-relaxed">Punya minat bergabung? Daftarkan biodata kamu langsung melalui sistem di bawah.</p>
                    
                    <button onclick="openModal()" class="w-full bg-[#79D3BC] hover:bg-[#5dbfa6] text-white py-3 rounded-2xl text-xs font-bold transition-all shadow-sm transform hover:-translate-y-0.5 flex items-center justify-center gap-1">
                        📝 Daftar Event Ini
                    </button>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-[0_8px_30px_rgba(0,0,0,0.01)] border border-white">
                    <h2 class="text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-4">Event Highlights</h2>
                    
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <div class="p-2 bg-[#F4FDFB] text-[#3B7A70] border border-[#E1F7F2] text-[11px] font-bold rounded-xl text-center">
                            8 Cabang Lomba
                        </div>
                        <div class="p-2 bg-[#F4FDFB] text-[#3B7A70] border border-[#E1F7F2] text-[11px] font-bold rounded-xl text-center">
                            Sertifikat Peserta
                        </div>
                        <div class="p-2 bg-[#F4FDFB] text-[#3B7A70] border border-[#E1F7F2] text-[11px] font-bold rounded-xl text-center">
                            Doorprize Menarik
                        </div>
                        <div class="p-2 bg-[#F4FDFB] text-[#3B7A70] border border-[#E1F7F2] text-[11px] font-bold rounded-xl text-center">
                            Guest Performance
                        </div>
                    </div>

                    <div class="text-center pt-2 border-t border-gray-50">
                        <p class="text-xs font-bold text-[#4c8c80]">Total Slots: 100 Students</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-[0_8px_30px_rgba(0,0,0,0.01)] border border-white space-y-4">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-sm font-extrabold text-gray-700">Data Peserta Terdaftar</h2>
                    <p class="text-[11px] text-gray-400 font-medium">Daftar nama siswa sekolah real-time yang ikut serta dalam event ini.</p>
                </div>
                <span class="bg-[#DFF4EE] text-[#3B7A70] text-xs font-bold px-3 py-1 rounded-full">
                    Total: <?= count($participants) ?> Peserta
                </span>
            </div>

            <div class="overflow-x-auto border border-gray-100 rounded-2xl">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/70 border-b border-gray-100">
                            <th class="px-4 py-3 text-[10px] uppercase font-extrabold text-gray-400 w-12 text-center">No</th>
                            <th class="px-4 py-3 text-[10px] uppercase font-extrabold text-gray-400">Nama Siswa</th>
                            <th class="px-4 py-3 text-[10px] uppercase font-extrabold text-gray-400">Kelas</th>
                            <th class="px-4 py-3 text-[10px] uppercase font-extrabold text-gray-400">Nomor Telepon</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs text-gray-600 font-semibold">
                        <?php if(!empty($participants)): foreach($participants as $index => $p): ?>
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="px-4 py-3 text-gray-400 text-center"><?= $index + 1 ?></td>
                            <td class="px-4 py-3 text-gray-700"><?= htmlspecialchars($p['name'] ?? '-') ?></td>
                            <td class="px-4 py-3">
                                <span class="bg-[#F4FDFB] text-[#3B7A70] border border-[#E1F7F2] px-2.5 py-0.5 rounded-md text-[11px]">
                                    <?= htmlspecialchars($p['class'] ?? '-') ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-500"><?= htmlspecialchars($p['phone_number'] ?? '-') ?></td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-400 text-xs font-medium">
                                Belum ada siswa yang mendaftar di event ini.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center text-[10px] font-bold text-[#3D8F76] uppercase tracking-widest pt-4">
            SENTRA
        </div>
    </div>

    <div id="registerModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white w-full max-w-md p-6 rounded-3xl border border-white shadow-2xl space-y-4 transform scale-95 transition-transform duration-300">
            
            <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                <div class="flex items-center gap-1.5">
                    <span class="text-lg">📝</span>
                    <h3 class="text-base font-extrabold text-gray-700">Form Pendaftaran</h3>
                </div>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 font-bold text-sm">✕</button>
            </div>

            <form action="" method="POST" class="space-y-4">
                <input type="hidden" name="action" value="register_event">
                <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['id'] ?? '') ?>">

                <div>
                    <label class="block text-[10px] uppercase font-extrabold text-gray-400 mb-1 tracking-wide">Nama Lengkap Siswa</label>
                    <input type="text" name="name" required placeholder="Masukkan nama lengkap kamu"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-semibold text-gray-700 focus:outline-none focus:border-[#79D3BC] bg-gray-50/50 focus:bg-white transition-all">
                </div>

                <div>
                    <label class="block text-[10px] uppercase font-extrabold text-gray-400 mb-1 tracking-wide">Kelas</label>
                    <input type="text" name="class" required placeholder="Contoh: XI RPL 2"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-semibold text-gray-700 focus:outline-none focus:border-[#79D3BC] bg-gray-50/50 focus:bg-white transition-all">
                </div>

                <div>
                    <label class="block text-[10px] uppercase font-extrabold text-gray-400 mb-1 tracking-wide">Nomor Telepon / WhatsApp</label>
                    <input type="tel" name="phone_number" required placeholder="Contoh: 08123456xxx"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-semibold text-gray-700 focus:outline-none focus:border-[#79D3BC] bg-gray-50/50 focus:bg-white transition-all">
                </div>

                <div class="flex gap-2 justify-end pt-2 border-t border-gray-50">
                    <button type="button" onclick="closeModal()" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-4 py-2.5 rounded-xl text-xs font-bold transition-all">
                        Batal
                    </button>
                    <button type="submit" class="bg-[#79D3BC] hover:bg-[#5dbfa6] text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-sm transition-all">
                        Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function openModal() {
        const modal = document.getElementById('registerModal');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.querySelector('.transform').classList.remove('scale-95');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('registerModal');
        modal.classList.add('opacity-0');
        modal.querySelector('.transform').classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
    </script>
</body>
</html>