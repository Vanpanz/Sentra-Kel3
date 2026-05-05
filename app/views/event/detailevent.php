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

    <!-- Header: Padding disesuaikan agar sejajar dengan banner -->
    <header class="px-6 py-6 flex justify-between items-center">
        <button class="text-[#45B39D] font-bold flex items-center gap-2 hover:opacity-70 transition">
            <span class="text-xl">&larr;</span> Back to Home
        </button>

        <div class="text-gray-400 font-bold hidden md:block">Event Detail</div>

        <button
            class="bg-[#76D7C4] text-white px-8 py-2.5 rounded-2xl font-black shadow-lg shadow-emerald-100 hover:bg-[#45B39D] hover:shadow-emerald-200 active:scale-95 transition-all duration-300">
            Edit Event
        </button>
    </header>

    <div class="px-6 pb-8">
        <div class="relative w-full h-[350px] md:h-[500px] rounded-[40px] overflow-hidden shadow-lg">

            <img src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?q=80&w=2000&auto=format&fit=crop"
                alt="Sports Event" class="absolute inset-0 w-full h-full object-cover">

            <div
                class="absolute inset-0 bg-gradient-to-br from-[#45B39D]/80 via-[#76D7C4]/60 to-transparent flex flex-col items-center justify-center text-white p-6">

                <span
                    class="bg-white/90 backdrop-blur-md text-[#45B39D] px-6 py-1.5 rounded-xl text-xs font-black tracking-widest mb-6 shadow-sm">
                    SEKOLAH XYZ
                </span>

                <h1
                    class="text-6xl md:text-[110px] font-black italic tracking-tighter text-center leading-none drop-shadow-[0_5px_15px_rgba(0,0,0,0.3)]">
                    CLASS MEETING
                </h1>

                <p class="mt-6 font-bold tracking-[0.3em] text-sm md:text-lg uppercase text-center drop-shadow-md">
                    Bersama Meraih Prestasi, Bersatu Dalam Kreasi
                </p>

                <div class="mt-8 bg-white/20 backdrop-blur-xl px-10 py-3 rounded-2xl border border-white/30 shadow-2xl">
                    <span class="text-2xl md:text-3xl font-black tracking-tighter">15-19 DESEMBER 20XX</span>
                </div>

                <div class="absolute bottom-8 hidden md:flex flex-wrap justify-center gap-3">
                    <span
                        class="bg-white/20 backdrop-blur-md border border-white/30 px-5 py-2 rounded-full text-[11px] font-black uppercase shadow-md">Futsal
                        Putra</span>
                    <span
                        class="bg-white/20 backdrop-blur-md border border-white/30 px-5 py-2 rounded-full text-[11px] font-black uppercase shadow-md">Voli</span>
                    <span
                        class="bg-white/20 backdrop-blur-md border border-white/30 px-5 py-2 rounded-full text-[11px] font-black uppercase shadow-md">Tennis
                        Meja</span>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 md:p-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <div class="lg:col-span-8 space-y-8">

            <div class="bg-white border border-gray-50 rounded-[35px] p-8 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-black text-gray-700">Event Description</h2>
                    <span
                        class="bg-[#58D68D] text-white text-[10px] px-4 py-1 rounded-full font-black uppercase">Ongoing</span>
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
                <h2 class="text-xl font-black text-gray-700 mb-6">Join Competition</h2>
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="relative flex-1 group">
                        <select
                            class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-4 text-gray-400 font-bold appearance-none outline-none focus:border-[#76D7C4]">
                            <option>Pilih Lomba...</option>
                            <option>Futsal</option>
                            <option>Badminton</option>
                        </select>
                        <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M7 10L12 15L17 10" stroke="#45B39D" stroke-width="3" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                    <button
                        class="bg-[#76D7C4] text-white px-10 py-4 rounded-2xl font-black shadow-xl hover:bg-[#45B39D] transition-all">
                        Join Now
                    </button>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-8">

            <div class="bg-white border border-gray-50 rounded-[35px] p-8 shadow-sm">
                <h2 class="text-xl font-black text-gray-700 mb-8">Statistic</h2>
                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between font-black text-xs mb-2 text-gray-600">
                            <span>Futsal</span>
                            <span class="text-[#45B39D]">75/100</span>
                        </div>
                        <div class="w-full bg-gray-100 h-3 rounded-full overflow-hidden">
                            <div
                                class="bg-[#45B39D] h-full w-[75%] rounded-full shadow-[0_0_10px_rgba(69,179,157,0.3)]">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between font-black text-xs mb-2 text-gray-600">
                            <span>Badminton</span>
                            <span class="text-gray-300">40/100</span>
                        </div>
                        <div class="w-full bg-gray-100 h-3 rounded-full overflow-hidden">
                            <div class="bg-gray-300 h-full w-[40%] rounded-full"></div>
                        </div>
                    </div>
                </div>
                <p class="text-center mt-8 text-[10px] font-black text-gray-300 tracking-widest uppercase">Total
                    Joined: 115 Students</p>
            </div>

            <div class="bg-white border border-gray-50 rounded-[35px] p-8 shadow-sm">
                <h2 class="text-xl font-black text-gray-700 mb-6">Competitions</h2>
                <ul class="space-y-4">
                    <li class="flex justify-between items-center font-bold text-sm">
                        <span class="text-gray-600">Futsal</span>
                        <span class="text-[#58D68D] text-[10px] font-black">25 SLOTS LEFT</span>
                    </li>
                    <li class="flex justify-between items-center font-bold text-sm">
                        <span class="text-gray-600">Badminton</span>
                        <span class="text-[#58D68D] text-[10px] font-black">60 SLOTS LEFT</span>
                    </li>
                    <li class="flex justify-between items-center font-bold text-sm opacity-30">
                        <span class="text-gray-600">Melukis</span>
                        <span class="text-red-400 text-[10px] font-black">FULL</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="w-full text-center py-10">
        <p class="text-emerald-700/40 font-bold text-xs tracking-[0.4em]">SENTRA</p>
    </footer>
</body>

</html>