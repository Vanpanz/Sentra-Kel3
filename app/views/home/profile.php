<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sentra - Profile Fit Screen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #E0F7F1; overflow: hidden; }
        .sidebar { background-color: #71C9B1; }
        .card { background: white; border-radius: 20px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); }
        .accent-color { color: #50B498; }
        .bg-accent { background-color: #50B498; }
        .nav-active { background-color: rgba(255,255,255,0.2); border-left: 6px solid white; }
       
        /* CSS Tambahan untuk memastikan gambar pas */
        .profile-img-container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 15px; /* Opsional, biar ujung gambar agak tumpul */
        }
        .profile-img-container img {
            max-width: 100%;
            max-height: 150px; /* Sesuaikan tinggi maksimal agar tidak merusak layout fit screen */
            object-fit: contain; /* Memastikan gambar tidak gepeng */
        }
    </style>
</head>
<body class="flex h-screen w-screen overflow-hidden">
 
    <!-- Sidebar -->
    <aside class="w-1/5 sidebar text-white flex flex-col items-center py-6 shrink-0">
        <div class="flex flex-col items-center mb-10">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-2 overflow-hidden p-2">
                <!-- Jika ingin mengganti logo S dengan gambar juga, hapus span dan gunakan img -->
                <span class="text-2xl font-bold accent-color italic">S</span>
            </div>
            <h1 class="text-xl font-bold tracking-[0.3em]">SENTRA</h1>
        </div>
 
       <nav class="w-full px-4 flex flex-col gap-2 font-bold">
        <a href="#" class="flex items-center py-4 px-6 rounded-2xl transition-all duration-300 hover:bg-white/10 opacity-70 hover:opacity-100 group">
            <i class="fas fa-home mr-4 text-sm group-hover:scale-110 transition-transform"></i>
            Home
        </a>
       
        <!-- Menu Active -->
        <a href="#" class="flex items-center py-4 px-6 rounded-2xl bg-white/20 backdrop-blur-sm shadow-sm text-white border-r-4 border-white/50">
            <i class="fas fa-user mr-4 text-sm"></i>
            Profile
        </a>
 
        <a href="#" class="flex items-center py-4 px-6 rounded-2xl transition-all duration-300 hover:bg-white/10 opacity-70 hover:opacity-100 group">
            <i class="fas fa-question-circle mr-4 text-sm group-hover:scale-110 transition-transform"></i>
            FAQ
        </a>
 
        <a href="#" class="flex items-center py-4 px-6 rounded-2xl transition-all duration-300 hover:bg-white/10 opacity-70 hover:opacity-100 group">
            <i class="fas fa-info-circle mr-4 text-sm group-hover:scale-110 transition-transform"></i>
            About Us
        </a>
    </nav>
    </aside>
 
     <!-- Main Content -->
    <main class="flex-1 p-8 flex flex-col h-full relative">
      <h2 class="text-2xl font-bold text-gray-600 mb-4 shrink-0 text-center">My Profile</h2>
        <!-- Header Card -->
        <div class="card p-6 mb-6 flex items-center relative shrink-0">
            <div class="w-1/4 flex justify-center items-center">
                <!-- BAGIAN YANG DIGANTI: Menggunakan file snetra profile.jpg -->
                <div class="profile-img-container">
                    <img src="snetra profile.jpg" alt="Sentra Profile Image">
                </div>
            </div>
            <div class="w-3/4 pl-6">
                <span class="bg-accent text-white px-3 py-0.5 rounded-full text-[10px] uppercase font-bold inline-block mb-1">
                    <i class="fas fa-shield-alt mr-1"></i> Administrator
                </span>
                <h3 class="text-2xl font-bold accent-color leading-tight">Dickson Darien Lim</h3>
                <p class="text-gray-400 text-xs mb-3">dicksonkeren@xyz.sch.id</p>
               
                <div class="bg-accent text-white px-3 py-2 rounded-lg text-xs mb-3 inline-block italic">
                    "Aku? Berlutut? Ha! Tidak akan. - King Alucard"
                </div>
               
                <div class="flex items-center text-gray-400 text-[10px]">
                    <i class="fas fa-map-marker-alt mr-1 accent-color"></i> Pontianak, Indonesia
                </div>
 
                <button class="absolute bottom-6 right-6 bg-accent text-white px-4 py-1.5 rounded-full text-xs flex items-center hover:bg-emerald-600 transition">
                    <i class="fas fa-pencil-alt mr-2 text-[10px]"></i> Edit Profile
                </button>
            </div>
        </div>
 
        <!-- Bottom Grid -->
        <div class="grid grid-cols-2 gap-6 flex-1 min-h-0 mb-12"> <!-- Tambah mb sedikit biar gak mepet footer -->
            <!-- About Me -->
            <div class="card p-6 flex flex-col">
                <h4 class="text-xl font-bold text-gray-600 mb-3 shrink-0">About Me</h4>
                <div class="border-2 border-emerald-50 p-4 rounded-xl text-emerald-500 font-medium text-sm overflow-y-auto flex-1 italic">
                    "Admin SENTRA yang gokil, keren, dan jago :p. Memiliki semangat yang membara dalam membangun sistem pendaftaran yang memudahkan setiap siswa yang ingin berpartisipasi dalam berbagai event sekolah. Intinya tetap pede dan semangat bosqu!"
                </div>
            </div>
 
            <!-- Account Detail -->
            <div class="card p-6 flex flex-col">
                <h4 class="text-xl font-bold text-gray-600 mb-3 shrink-0">Account Detail</h4>
                <div class="space-y-3 flex-1 overflow-y-auto pr-2">
                    <div>
                        <label class="text-[10px] text-gray-400 font-bold uppercase ml-1">Name</label>
                        <input type="text" readonly value="Dickson Darien Lim" class="w-full border-2 border-gray-50 rounded-lg p-2 text-sm text-emerald-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="text-[10px] text-gray-400 font-bold uppercase ml-1">Email</label>
                        <input type="email" readonly value="dicksonkeren@xyz.sch.id" class="w-full border-2 border-gray-50 rounded-lg p-2 text-sm text-emerald-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="text-[10px] text-gray-400 font-bold uppercase ml-1">Password</label>
                        <input type="password" readonly value="cihuy123" class="w-full border-2 border-gray-50 rounded-lg p-2 text-sm text-emerald-500 focus:outline-none">
                    </div>
                </div>
            </div>
        </div>
 
        <!-- Footer -->
        <footer class="absolute bottom-4 left-0 w-full text-center shrink-0">
            <p class="text-emerald-700/40 font-bold text-xs tracking-[0.4em]">SENTRA</p>
        </footer>
    </main>
 
</body>
</html>
 