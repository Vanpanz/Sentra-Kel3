<!-- Custom Modal Component -->
<div id="customModal" class="fixed inset-0 bg-black/50 opacity-0 invisible transition-all duration-300 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full transform scale-95 opacity-0 transition-all duration-300">
        <div class="p-6 sm:p-8">
            <div class="flex justify-between items-start mb-4">
                <h3 id="modalTitle" class="text-lg sm:text-xl font-extrabold text-[#2d3436]">
                    Notifikasi
                </h3>
                <button onclick="closeModal()" class="text-[#636e72] hover:text-[#2d3436] text-2xl leading-none">
                    ✕
                </button>
            </div>

            <p id="modalMessage" class="text-sm sm:text-base text-[#636e72] font-medium mb-6 leading-relaxed">
                Pesan modal akan ditampilkan di sini
            </p>

            <div id="modalActions" class="flex gap-3">
                <button onclick="closeModal()" class="flex-1 btn-secondary px-4 py-2 text-xs uppercase tracking-widest">
                    Tutup
                </button>
                <button id="modalConfirmBtn" onclick="confirmModal()" class="flex-1 btn-primary px-4 py-2 text-xs uppercase tracking-widest" style="display: none;">
                    Konfirmasi
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let modalConfirmCallback = null;
    let modalCancelCallback = null;
    let registerEventId = null;

    function showModal(title, message, options = {}) {
        const modal = document.getElementById('customModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const confirmBtn = document.getElementById('modalConfirmBtn');
        
        modal.style.display = 'flex';
        modalTitle.textContent = title;
        modalMessage.textContent = message;
        
        if (options.showConfirm) {
            confirmBtn.style.display = 'block';
            modalConfirmCallback = options.onConfirm || null;
            modalCancelCallback = options.onCancel || null;
        } else {
            confirmBtn.style.display = 'none';
            modalConfirmCallback = null;
            modalCancelCallback = null;
        }

        // Trigger animation
        setTimeout(() => {
            modal.classList.remove('opacity-0', 'invisible');
            modal.querySelector('.bg-white').classList.remove('scale-95', 'opacity-0');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('customModal');
        if (modalCancelCallback && typeof modalCancelCallback === 'function') {
            modalCancelCallback();
        }
        modal.classList.add('opacity-0', 'invisible');
        modal.querySelector('.bg-white').classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.style.display = 'none';
            modalConfirmCallback = null;
            modalCancelCallback = null;
        }, 300);
    }

    function confirmModal() {
        if (modalConfirmCallback && typeof modalConfirmCallback === 'function') {
            modalConfirmCallback();
        }
        const modal = document.getElementById('customModal');
        modal.classList.add('opacity-0', 'invisible');
        modal.querySelector('.bg-white').classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.style.display = 'none';
            modalConfirmCallback = null;
            modalCancelCallback = null;
        }, 300);
    }

    function showRegisterModal(eventId, eventTitle) {
        registerEventId = eventId;
        showModal(
            'Konfirmasi Registrasi',
            `Anda yakin ingin mendaftar ke event "${eventTitle}"?`,
            {
                showConfirm: true,
                onConfirm: () => submitRegister(eventId)
            }
        );
    }

    function submitRegister(eventId) {
        // Create form dynamically and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/events/${eventId}/register`;
        document.body.appendChild(form);
        form.submit();
    }

    // Close modal when clicking outside
    document.getElementById('customModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Replace alert with custom modal
    window.showAlert = function(message, title = 'Notifikasi') {
        showModal(title, message);
    };

    // Replace confirm with custom modal
    window.showConfirm = function(message, title = 'Konfirmasi', callback, onCancelCallback = null) {
        showModal(title, message, {
            showConfirm: true,
            onConfirm: callback,
            onCancel: onCancelCallback
        });
    };
</script>
