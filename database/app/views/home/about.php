<style>
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

<div class="section-title">
    <i class="fas fa-info-circle mr-3 text-2xl"></i>
    <h2>About Us</h2>
</div>

<div class="card-about">
    <p class="text-[#50B498] text-lg font-semibold leading-relaxed">
        Sentra is an all-in-one event management platform designed to bridge the gap between community, creativity, and
        collaboration. We believe that every event — from intense sports competitions to inspiring art exhibitions —
        deserves to be managed through a modern, efficient, and inclusive digital ecosystem.
    </p>
</div>

<div class="divider-container">
    <div class="line"></div>
    <h2 class="px-6 text-3xl font-extrabold text-[#50B498] tracking-wide">Why Choose SENTRA ?</h2>
    <div class="line"></div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
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