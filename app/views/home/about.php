<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sentra - About Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #E0F7F1; overflow: hidden; }
        .sidebar { background-color: #71C9B1; }
        .accent-color { color: #50B498; }
        .bg-accent { background-color: #50B498; }
        
        /* Gaya khusus untuk tampilan About Us sesuai gambar */
        .card-about {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            padding: 2.5rem;
            margin-bottom: 2rem;
        }
        .feature-card {
            background: linear-gradient(135deg, #71C9B1 0%, #50B498 100%);
            border-radius: 12px;
            padding: 2rem 1.5rem;
            color: white;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .section-title {
            display: flex;
            align-items: center;
            font-size: 2rem;
            font-weight: 800;
            color: #50B498;
            margin-bottom: 1.5rem;
        }
        .divider-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 2rem 0;
        }
        .line {
            flex-grow: 1;
            height: 2px;
            background-color: #50B498;
            opacity: 0.3;
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
            <a href="/homepage" class="flex items-center py-4 px-6 rounded-2xl transition-all duration-300 hover:bg-white/10 opacity-70 hover:opacity-100 group">
                <i class="fas fa-home mr-4 text-sm group-hover:scale-110 transition-transform"></i>
                Home
            </a>
            <a href="/event/details" class="flex items-center py-4 px-6 rounded-2xl transition-all duration-300 hover:bg-white/10 opacity-70 hover:opacity-100 group">
                <i class="fas fa-user mr-4 text-sm group-hover:scale-110 transition-transform"></i>
                Profile
            </a>
            <a href="/login" class="flex items-center py-4 px-6 rounded-2xl transition-all duration-300 hover:bg-white/10 opacity-70 hover:opacity-100 group">
                <i class="fas fa-question-circle mr-4 text-sm group-hover:scale-110 transition-transform"></i>
                FAQ
            </a>
            <a href="/about-us" class="flex items-center py-4 px-6 rounded-2xl bg-white/20 backdrop-blur-sm shadow-sm text-white border-r-4 border-white/50">
                <i class="fas fa-info-circle mr-4 text-sm"></i>
                About Us
            </a>
        </nav>
    </aside>

    <main class="flex-1 p-12 flex flex-col h-full overflow-y-auto">
        
        <div class="section-title">
            <i class="fas fa-info-circle mr-3 text-2xl"></i>
            <h2>About Us</h2>
        </div>

        <div class="card-about">
            <p class="text-[#50B498] text-lg font-semibold leading-relaxed">
                Sentra is an all-in-one event management platform designed to bridge the gap between community, creativity, and collaboration. We believe that every event — from intense sports competitions to inspiring art exhibitions — deserves to be managed through a modern, efficient, and inclusive digital ecosystem.
            </p>
        </div>

        <div class="divider-container">
            <div class="line"></div>
            <h2 class="px-6 text-3xl font-extrabold text-[#50B498] tracking-wide">Why Choose SENTRA ?</h2>
            <div class="line"></div>
        </div>

        <div class="grid grid-cols-3 gap-8 mb-12">
            <div class="feature-card">
                <h3 class="text-2xl font-bold mb-4">Integrated Management Hub</h3>
                <p class="text-sm opacity-90 leading-relaxed">
                    Monitor all activities, all within a single, intuitive dashboard.
                </p>
            </div>

            <div class="feature-card">
                <h3 class="text-2xl font-bold mb-4">Operational Efficiency</h3>
                <p class="text-sm opacity-90 leading-relaxed">
                    Empowering organizers to manage registrations and participant tracking.
                </p>
            </div>

            <div class="feature-card">
                <h3 class="text-2xl font-bold mb-4">Seamless Connectivity</h3>
                <p class="text-sm opacity-90 leading-relaxed">
                    Connecting organizers directly with participants to create more experience.
                </p>
            </div>
        </div>

        <footer class="mt-auto pb-4 w-full text-center">
            <p class="text-emerald-700/40 font-bold text-xs tracking-[0.4em]">SENTRA</p>
        </footer>
    </main>

</body>
</html>