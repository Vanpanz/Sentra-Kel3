<?php
// Jangan panggil session_start() di sini jika sudah dipanggil di file index.php atau app.php
?>

<aside class="w-64 bg-white min-h-screen border-r border-gray-100 flex flex-col sticky top-0">
    
    <div class="p-6 flex items-center gap-3">
        <div class="w-9 h-9 bg-blue-600 rounded-xl shadow-lg shadow-blue-200 flex items-center justify-center">
            <span class="text-white font-bold">S</span>
        </div>
        <h2 class="text-xl font-bold text-gray-800 tracking-tight">SENTRA</h2>
    </div>

    <nav class="flex-1 px-4 py-4 overflow-y-auto">
        <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Main Menu</p>
        
        <ul class="space-y-2">
            <li>
                <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl bg-blue-50 text-blue-600 transition-all">
                    <span>🏠</span>
                    Dashboard
                </a>
            </li>
            
            <li>
                <a href="/events" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 rounded-xl hover:bg-gray-50 hover:text-blue-600 transition-all">
                    <span>📅</span>
                    Events
                </a>
            </li>
            
            <li>
                <a href="/participants" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 rounded-xl hover:bg-gray-50 hover:text-blue-600 transition-all">
                    <span>👥</span>
                    Participants
                </a>
            </li>
            
            <li>
                <a href="/announcements" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 rounded-xl hover:bg-gray-50 hover:text-blue-600 transition-all">
                    <span>📣</span>
                    Announcements
                </a>
            </li>
        </ul>
    </nav>

    <div class="p-4 border-t border-gray-100 bg-gray-50/50">
        <div class="flex items-center gap-3 p-2 bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                <?= strtoupper(substr($_SESSION['user']['name'] ?? 'A', 0, 1)); ?>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-gray-800 truncate">
                    <?= $_SESSION['user']['name'] ?? 'Administrator'; ?>
                </p>
                <p class="text-[10px] text-gray-500">Admin Account</p>
            </div>
        </div>
        
        <a href="/logout" class="mt-3 flex items-center justify-center gap-2 px-4 py-2 text-xs font-bold text-red-500 hover:bg-red-50 rounded-lg transition-all">
            🚪 Logout
        </a>
    </div>

</aside> ```

---

### Penjelasan Singkat Class Tailwind yang Digunakan:

1.  **`w-64`**: Menentukan lebar sidebar tetap (256px). Tanpa ini, sidebar bisa menyusut atau melebar tidak jelas.
2.  **`sticky top-0`**: Membuat sidebar tetap diam di tempat saat halaman di-scroll ke bawah.
3.  **`min-h-screen`**: Memastikan tinggi sidebar selalu setinggi layar monitor, meskipun menu di dalamnya sedikit.
4.  **`border-r`**: Memberikan garis tipis di sebelah kanan untuk memisahkan sidebar dengan konten utama secara elegan.
5.  **`flex-1` (pada tag nav)**: Memaksa area navigasi mengambil ruang yang tersedia, sehingga bagian profil user akan terdorong ke paling bawah.

### Tips Agar Konten Tidak Hilang Lagi:
Pastikan di file `homepage.php`, kamu memanggilnya seperti ini agar konten di sebelah kanan punya ruang sendiri:

```php
<div class="flex"> <?php include 'path/ke/sidebar.php'; ?>

    <main class="flex-1 p-8"> </main>
</div>