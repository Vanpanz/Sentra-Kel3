<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Event Detail - SENTRA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#E0F7F1] p-4 md:p-8">

    <header class="px-6 py-6 flex justify-between items-center">
        <button class="text-[#45B39D] font-bold flex items-center gap-2 hover:opacity-70 transition">
            <span class="text-xl">&larr;</span> Back to Home
        </button>

        <div class="text-gray-400 font-bold hidden md:block">Event Detail</div>

        <button
            class="bg-[#76D7C4] text-white px-8 py-2.5 rounded-2xl font-black shadow-lg shadow-emerald-100 hover:bg-[#45B39D] active:scale-95 transition-all duration-300">
            Edit Event
        </button>
    </header>

    <div class="px-6 pb-8">
        <div class="relative w-full h-[350px] md:h-[500px] rounded-[40px] overflow-hidden shadow-lg">
            <img src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?q=80&w=2000&auto=format&fit=crop"
                alt="Sports Event" class="absolute inset-0 w-full h-full object-cover">

            <div class="absolute inset-0 bg-gradient-to-br from-[#45B39D]/80 via-[#76D7C4]/60 to-transparent flex flex-col items-center justify-center text-white p-6">
                <span class="bg-white/90 backdrop-blur-md text-[#45B39D] px-6 py-1.5 rounded-xl text-xs font-black tracking-widest mb-6 shadow-sm uppercase">
                    SEKOLAH XYZ
                </span>

                <h1 class="text-6xl md:text-[110px] font-black italic tracking-tighter text-center leading-none drop-shadow-[0_5px_15px_rgba(0,0,0,0.3)]">
                    CLASS MEETING
                </h1>

                <p class="mt-6 font-bold tracking-[0.3em] text-sm md:text-lg uppercase text-center drop-shadow-md">
                    Bersama Meraih Prestasi, Bersatu Dalam Kreasi
                </p>

                <div class="mt-8 bg-white/20 backdrop-blur-xl px-10 py-3 rounded-2xl border border-white/30 shadow-2xl">
                    <span class="text-2xl md:text-3xl font-black tracking-tighter">15-19 DESEMBER 20XX</span>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 md:p-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <div class="lg:col-span-8 space-y-8">

            <div class="bg-white border border-gray-50 rounded-[35px] p-8 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-black text-gray-700">Event Description</h2>
                    <span class="bg-[#58D68D] text-white text-[10px] px-4 py-1 rounded-full font-black uppercase">Ongoing</span>
                </div>
                <p class="text-gray-500 leading-relaxed font-medium">
                    Class meeting adalah ajang kompetisi antar kelas yang bertujuan untuk meningkatkan sportivitas
                    dan kreativitas siswa sekolah XYZ melalui berbagai cabang lomba.
                </p>
                <div class="mt-8 flex flex-wrap gap-6 text-sm font-bold text-[#45B39D]">
                    <div class="flex items-center gap-2"><span>📅</span> 12-19 Desember 20XX</div>
                    <div class="flex items-center gap-2"><span>📍</span> Lapangan Utama</div>
                </div>
            </div>

            <div class="bg-white border border-gray-50 rounded-[35px] p-8 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-black text-gray-700">Competition List</h2>
                    <span class="text-[#45B39D] text-xs font-black uppercase tracking-widest">6 Cabang Lomba</span>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <div class="flex items-center gap-2 bg-gray-50 border border-gray-100 px-4 py-2.5 rounded-xl font-bold text-gray-600 text-sm hover:border-[#76D7C4] transition-all">
                        <span>⚽</span> Futsal Putra
                    </div>
                    <div class="flex items-center gap-2 bg-gray-50 border border-gray-100 px-4 py-2.5 rounded-xl font-bold text-gray-600 text-sm hover:border-[#76D7C4] transition-all">
                        <span>🏐</span> Voli
                    </div>
                    <div class="flex items-center gap-2 bg-gray-50 border border-gray-100 px-4 py-2.5 rounded-xl font-bold text-gray-600 text-sm hover:border-[#76D7C4] transition-all">
                        <span>🏓</span> Tenis Meja
                    </div>
                    <div class="flex items-center gap-2 bg-gray-50 border border-gray-100 px-4 py-2.5 rounded-xl font-bold text-gray-600 text-sm hover:border-[#76D7C4] transition-all">
                        <span>🎤</span> Solo Vokal
                    </div>
                    <div class="flex items-center gap-2 bg-gray-50 border border-gray-100 px-4 py-2.5 rounded-xl font-bold text-gray-600 text-sm hover:border-[#76D7C4] transition-all">
                        <span>🎨</span> Lomba Poster
                    </div>
                    <div class="flex items-center gap-2 bg-gray-50 border border-gray-100 px-4 py-2.5 rounded-xl font-bold text-gray-600 text-sm hover:border-[#76D7C4] transition-all">
                        <span>🧩</span> Permainan Tradisional
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-8">

            <div class="bg-white border border-gray-50 rounded-[35px] p-8 shadow-sm">
                <h2 class="text-xl font-black text-gray-700 mb-8">Event Highlights</h2>
                
                <div class="space-y-7">
                    <div class="flex items-center gap-4">
                        <div class="bg-[#F1FBF9] p-3.5 rounded-2xl text-[#45B39D]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-[10px] font-black uppercase tracking-wider">Engagement</p>
                            <h4 class="font-black text-gray-700 text-base">100+ Peserta</h4>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="bg-[#F1FBF9] p-3.5 rounded-2xl text-[#45B39D]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-[10px] font-black uppercase tracking-wider">Duration</p>
                            <h4 class="font-black text-gray-700 text-base">12 Hari Kegiatan</h4>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="bg-[#F1FBF9] p-3.5 rounded-2xl text-[#45B39D]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z"></path></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-[10px] font-black uppercase tracking-wider">Rewards</p>
                            <h4 class="font-black text-gray-700 text-base">20+ Penghargaan</h4>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="bg-[#F1FBF9] p-3.5 rounded-2xl text-[#45B39D]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-[10px] font-black uppercase tracking-wider">Goal</p>
                            <h4 class="font-black text-gray-700 text-base">Tujuan Bersama</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-50 rounded-[35px] p-8 shadow-sm">
                <h2 class="text-xl font-black text-gray-700 mb-6 italic">Flash Info</h2>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-sm font-bold text-gray-500">
                        <span class="text-[#76D7C4]">✦</span> 8 Cabang Lomba Seru
                    </li>
                    <li class="flex items-center gap-3 text-sm font-bold text-gray-500">
                        <span class="text-[#76D7C4]">✦</span> Doorprize Menarik
                    </li>
                    <li class="flex items-center gap-3 text-sm font-bold text-gray-500">
                        <span class="text-[#76D7C4]">✦</span> Guest Performance
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <footer class="w-full text-center py-10 mt-10">
        <p class="text-emerald-700/30 font-black text-xs tracking-[0.5em] uppercase">SENTRA</p>
    </footer>
</body>

</html>
