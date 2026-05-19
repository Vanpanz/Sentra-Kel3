<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sentra - FAQ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #E0F7F1;
            overflow: hidden;
        }

        .sidebar {
            background-color: #71C9B1;
        }

        .accent-color {
            color: #50B498;
        }

        .bg-accent {
            background-color: #50B498;
        }

        /* Custom scrollbar konten utama */
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #71C9B1;
            border-radius: 10px;
        }

        /* Styling Accordion FAQ (Buka-Tutup) */
        .faq-item {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        /* Menghilangkan panah bawaan browser pada tag summary */
        .faq-item summary::-webkit-details-marker {
            display: none;
        }

        .faq-item summary {
            list-style: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            cursor: pointer;
            font-weight: bold;
            color: #50B498;
        }

        /* Animasi rotasi ikon plus menjadi silang (x) saat dibuka */
        .faq-item[open] summary i {
            transform: rotate(45deg);
            color: #ff6b6b;
        }

        .faq-item summary i {
            transition: transform 0.2s ease, color 0.2s ease;
        }
    </style>
</head>

<body class="flex h-screen w-screen overflow-hidden">

    <aside class="w-1/5 sidebar text-white flex flex-col items-center py-6 shrink-0">
        <div class="flex flex-col items-center mb-10">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-2 overflow-hidden p-2">
                <span class="text-2xl font-bold accent-color italic">S</span>
            </div>
            <h1 class="text-xl font-bold tracking-[0.3em]">SENTRA</h1>
        </div>

        <nav class="w-full px-4 flex flex-col gap-2 font-bold">
            <a href="/homepage"
                class="flex items-center py-4 px-6 rounded-2xl transition-all duration-300 hover:bg-white/10 opacity-70 hover:opacity-100 group">
                <i class="fas fa-home mr-4 text-sm group-hover:scale-110 transition-transform"></i>
                Home
            </a>
            <a href="/event/details"
                class="flex items-center py-4 px-6 rounded-2xl transition-all duration-300 hover:bg-white/10 opacity-70 hover:opacity-100 group">
                <i class="fas fa-user mr-4 text-sm group-hover:scale-110 transition-transform"></i>
                Profile
            </a>
            <a href="/login"
                class="flex items-center py-4 px-6 rounded-2xl bg-white/20 backdrop-blur-sm shadow-sm text-white border-r-4 border-white/50">
                <i class="fas fa-question-circle mr-4 text-sm"></i>
                FAQ
            </a>
            <a href="/about-us"
                class="flex items-center py-4 px-6 rounded-2xl transition-all duration-300 hover:bg-white/10 opacity-70 hover:opacity-100 group">
                <i class="fas fa-info-circle mr-4 text-sm"></i>
                About Us
            </a>
        </nav>
    </aside>

    <main class="flex-1 p-10 flex flex-col h-full overflow-y-auto custom-scroll">

        <div class="w-full relative mb-6">
            <i class="fas fa-search absolute left-4 top-3.5 text-gray-400 text-sm"></i>
            <input type="text" placeholder="Search FAQ..."
                class="w-full pl-11 pr-4 py-2.5 rounded-full bg-white shadow-sm text-sm text-gray-600 outline-none placeholder-gray-400 border border-gray-100 focus:border-[#71C9B1] transition-all">
        </div>

        <div class="mb-6">
            <h2 class="text-3xl font-extrabold text-gray-700 tracking-wide">Frequently Asked Question</h2>
        </div>

        <div class="w-full h-52 rounded-2xl shadow-sm mb-8 overflow-hidden border border-white bg-white">
            <img src="https://img.freepik.com/free-vector/flat-creativity-concept-illustration_52683-64259.jpg"
                alt="FAQ Banner Illustration" class="w-full h-full object-cover object-center opacity-90">
        </div>

        <div class="grid grid-cols-3 gap-8 items-start mb-8">

            <div class="col-span-2 flex flex-col gap-6">

                <div>
                    <div class="flex items-center gap-2 mb-3 font-extrabold text-gray-700 text-lg">
                        <i class="fas fa-check-circle text-[#71C9B1]"></i>
                        <h3>General</h3>
                    </div>
                    <div class="flex flex-col gap-3">
                        <details class="faq-item">
                            <summary>
                                <span class="text-sm">Siapa saja yang bisa mengikuti event?</span>
                                <i class="fas fa-plus text-xs text-[#71C9B1]"></i>
                            </summary>
                            <div
                                class="mx-4 pb-4 text-sm text-gray-600 border-t-2 border-gray-200 pt-3 leading-relaxed">
                                Siapa saja bisa ikut! Event di Sentra terbuka untuk pelajar, mahasiswa, komunitas,
                                hingga masyarakat umum tergantung pada kategori dan syarat ketentuan yang ditentukan
                                oleh masing-masing pihak penyelenggara event.
                            </div>
                        </details>

                        <details class="faq-item">
                            <summary>
                                <span class="text-sm">Berapa batas maksimal peserta pada setiap lomba yang dapat
                                    diikuti?</span>
                                <i class="fas fa-plus text-xs text-[#71C9B1]"></i>
                            </summary>
                            <div
                                class="mx-4 pb-4 text-sm text-gray-600 border-t-2 border-gray-200 pt-3 leading-relaxed">
                                Batas maksimal peserta berbeda-beda untuk tiap jenis perlombaan. Kamu bisa melihat
                                rincian kuota dan batasan jumlah tim/individu secara detail langsung di halaman
                                informasi perlombaan terkait sebelum melakukan pendaftaran.
                            </div>
                        </details>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-2 mb-3 font-extrabold text-gray-700 text-lg">
                        <i class="fas fa-file-alt text-[#71C9B1]"></i>
                        <h3>Registration</h3>
                    </div>
                    <div class="flex flex-col gap-3">
                        <details class="faq-item">
                            <summary>
                                <span class="text-sm">Bagaimana caranya mendaftar ke event?</span>
                                <i class="fas fa-plus text-xs text-[#71C9B1]"></i>
                            </summary>
                            <div
                                class="mx-4 pb-4 text-sm text-gray-600 border-t-2 border-gray-200 pt-3 leading-relaxed">
                                Caranya sangat mudah! Cari event yang ingin kamu ikuti, klik tombol "Daftar", isi
                                formulir data diri atau tim dengan lengkap, lalu lakukan konfirmasi pembayaran jika
                                event tersebut berbayar.
                            </div>
                        </details>

                        <details class="faq-item">
                            <summary>
                                <span class="text-sm">Bisakah saya membatalkan pendaftaran lomba yang sudah
                                    diikuti?</span>
                                <i class="fas fa-plus text-xs text-[#71C9B1]"></i>
                            </summary>
                            <div
                                class="mx-4 pb-4 text-sm text-gray-600 border-t-2 border-gray-200 pt-3 leading-relaxed">
                                Kebijakan pembatalan sepenuhnya bergantung pada pihak penyelenggara event. Secara umum,
                                pendaftaran yang sudah divalidasi tidak dapat dibatalkan atau di-refund kecuali ada
                                kondisi khusus dari panitia.
                            </div>
                        </details>

                        <details class="faq-item">
                            <summary>
                                <span class="text-sm">Bagaimana cara melihat status pendaftaran saya?</span>
                                <i class="fas fa-plus text-xs text-[#71C9B1]"></i>
                            </summary>
                            <div
                                class="mx-4 pb-4 text-sm text-gray-600 border-t-2 border-gray-200 pt-3 leading-relaxed">
                                Kamu bisa mengeceknya secara berkala melalui menu "Profile" kamu. Di sana akan tertera
                                daftar histori transaksi beserta status verifikasi pendaftaran kamu (Pending/Verified).
                            </div>
                        </details>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-2 mb-3 font-extrabold text-gray-700 text-lg">
                        <i class="fas fa-users text-[#71C9B1]"></i>
                        <h3>Participation</h3>
                    </div>
                    <div class="flex flex-col gap-3">
                        <details class="faq-item">
                            <summary>
                                <span class="text-sm">Apakah saya dapat mengikuti beberapa lomba sekaligus?</span>
                                <i class="fas fa-plus text-xs text-[#71C9B1]"></i>
                            </summary>
                            <div
                                class="mx-4 pb-4 text-sm text-gray-600 border-t-2 border-gray-200 pt-3 leading-relaxed">
                                Boleh, asalkan jadwal pelaksanaan antar lomba tersebut tidak bentrok dan kamu sanggup
                                memenuhi persyaratan di masing-masing kompetisi yang diikuti.
                            </div>
                        </details>

                        <details class="faq-item">
                            <summary>
                                <span class="text-sm">Adakah barang yang harus saya bawa saat lomba?</span>
                                <i class="fas fa-plus text-xs text-[#71C9B1]"></i>
                            </summary>
                            <div
                                class="mx-4 pb-4 text-sm text-gray-600 border-t-2 border-gray-200 pt-3 leading-relaxed">
                                Biasanya kamu wajib membawa kartu identitas diri (KTP/Kartu Pelajar) dan bukti
                                pendaftaran digital dari Sentra. Kebutuhan teknis lainnya akan diinfokan oleh panitia
                                lewat email atau grup koordinasi.
                            </div>
                        </details>

                        <details class="faq-item">
                            <summary>
                                <span class="text-sm">Bagaimana kalau kuota lomba sudah penuh saat sedang
                                    mendaftar?</span>
                                <i class="fas fa-plus text-xs text-[#71C9B1]"></i>
                            </summary>
                            <div
                                class="mx-4 pb-4 text-sm text-gray-600 border-t-2 border-gray-200 pt-3 leading-relaxed">
                                Jika kuota penuh, sistem otomatis menutup akses pendaftaran. Namun, kamu bisa memantau
                                halaman event secara berkala atau menghubungi contact support jika panitia membuka kuota
                                tambahan (slot cadangan).
                            </div>
                        </details>
                    </div>
                </div>

            </div>

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden flex flex-col border border-gray-50">
                <div class="w-full h-44 bg-[#EBF9F5] flex items-center justify-center overflow-hidden">
                    <img src=""
                        alt="Support Vector" class="w-full h-full object-cover">
                </div>

                <div class="bg-gradient-to-b from-[#71C9B1] to-[#50B498] text-white p-6 flex flex-col gap-4 flex-1">
                    <div class="text-center">
                        <p class="text-sm font-medium opacity-90 leading-snug">Tidak menemukan jawaban dari pertanyaan
                            yang dicari?</p>
                        <p class="text-sm font-bold mt-1">Anda dapat menghubungi kami!</p>
                    </div>

                    <div class="bg-white rounded-xl p-5 text-[#50B498] flex flex-col gap-4 shadow-inner mt-2">
                        <h4 class="font-extrabold text-sm tracking-wide flex items-center gap-2"><i
                                class="fas fa-envelope-open-text"></i> Contact Support:</h4>

                        <div class="flex items-start gap-3">
                            <i class="fas fa-phone-alt text-lg mt-0.5"></i>
                            <div class="flex flex-col">
                                <span class="text-xs font-black text-gray-500 uppercase tracking-wide">No.
                                    Telepon</span>
                                <span class="text-xs font-bold text-gray-700">0867-6677-6776</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <i class="fas fa-envelope text-lg mt-0.5"></i>
                            <div class="flex flex-col">
                                <span class="text-xs font-black text-gray-500 uppercase tracking-wide">Email</span>
                                <span class="text-xs font-bold text-gray-700">Sentra_L@gmail.com</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <i class="fab fa-instagram text-lg mt-0.5"></i>
                            <div class="flex flex-col">
                                <span class="text-xs font-black text-gray-500 uppercase tracking-wide">Instagram</span>
                                <span class="text-xs font-bold text-gray-700">Sentra.Y2K</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <footer class="mt-auto pt-4 w-full text-center">
            <p class="text-emerald-700/40 font-bold text-xs tracking-[0.4em]">SENTRA</p>
        </footer>
    </main>

</body>

</html>