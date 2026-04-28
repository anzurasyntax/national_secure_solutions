{{-- Guest-only modal: login or register, then redirect to course checkout --}}
<div id="checkout-auth-modal" class="fixed inset-0 z-[200] hidden items-center justify-center p-4" aria-hidden="true">
    <div id="checkout-auth-modal-backdrop" class="absolute inset-0 bg-ink/60 backdrop-blur-sm"></div>
    <div class="relative z-10 w-full max-w-md overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-2xl">
        <div class="flex items-start justify-between border-b border-gray-100 bg-gradient-to-r from-ink to-navy px-6 py-4 text-white">
            <div>
                <p class="font-heading text-lg font-bold">Continue to checkout</p>
                <p class="mt-1 text-sm text-white/75">Sign in or create an account to add this course to your cart.</p>
            </div>
            <button type="button" id="checkout-auth-modal-close" class="rounded-lg p-1 text-white/80 hover:bg-white/10 hover:text-white" aria-label="Close">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="flex border-b border-gray-100">
            <button type="button" id="checkout-auth-tab-login" class="checkout-auth-tab flex-1 border-b-2 border-primary bg-white px-4 py-3 text-sm font-semibold text-ink">
                Sign in
            </button>
            <button type="button" id="checkout-auth-tab-register" class="checkout-auth-tab flex-1 border-b-2 border-transparent bg-white px-4 py-3 text-sm font-semibold text-[#797979] hover:text-ink">
                Register
            </button>
        </div>

        <div class="p-6">
            @include('admin.partials.flash')

            <div id="checkout-auth-panel-login" class="checkout-auth-panel">
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="redirect" class="checkout-auth-redirect-field" value="">

                    <div>
                        <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-600">Email</label>
                        <input name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-600">Password</label>
                        <input name="password" type="password" required autocomplete="current-password"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                        Remember me
                    </label>
                    <button type="submit" class="w-full rounded-lg bg-primary py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                        Sign in &amp; continue
                    </button>
                </form>
            </div>

            <div id="checkout-auth-panel-register" class="checkout-auth-panel hidden">
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="redirect" class="checkout-auth-redirect-field" value="">

                    <div>
                        <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-600">Full name</label>
                        <input name="name" type="text" value="{{ old('name') }}" required autocomplete="name"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-600">Email</label>
                        <input name="email" type="email" value="{{ old('email') }}" required autocomplete="email"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-600">Password</label>
                        <input name="password" type="password" required autocomplete="new-password"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-gray-600">Confirm password</label>
                        <input name="password_confirmation" type="password" required autocomplete="new-password"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <button type="submit" class="w-full rounded-lg bg-primary py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                        Create account &amp; continue
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function () {
    var modal = document.getElementById('checkout-auth-modal');
    if (!modal) return;

    function openModal(checkoutUrl) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        modal.querySelectorAll('.checkout-auth-redirect-field').forEach(function (el) {
            el.value = checkoutUrl || '';
        });
    }

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    document.querySelectorAll('[data-open-checkout-auth]').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            openModal(btn.getAttribute('data-checkout-url'));
        });
    });

    var closeBtn = document.getElementById('checkout-auth-modal-close');
    var backdrop = document.getElementById('checkout-auth-modal-backdrop');
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (backdrop) backdrop.addEventListener('click', closeModal);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) closeModal();
    });

    var tabLogin = document.getElementById('checkout-auth-tab-login');
    var tabRegister = document.getElementById('checkout-auth-tab-register');
    var panelLogin = document.getElementById('checkout-auth-panel-login');
    var panelRegister = document.getElementById('checkout-auth-panel-register');

    function activateTab(which) {
        var isLogin = which === 'login';
        if (tabLogin && tabRegister && panelLogin && panelRegister) {
            tabLogin.classList.toggle('border-primary', isLogin);
            tabLogin.classList.toggle('border-transparent', !isLogin);
            tabLogin.classList.toggle('text-ink', isLogin);
            tabLogin.classList.toggle('text-[#797979]', !isLogin);
            tabRegister.classList.toggle('border-primary', !isLogin);
            tabRegister.classList.toggle('border-transparent', isLogin);
            tabRegister.classList.toggle('text-ink', !isLogin);
            tabRegister.classList.toggle('text-[#797979]', isLogin);
            panelLogin.classList.toggle('hidden', !isLogin);
            panelRegister.classList.toggle('hidden', isLogin);
        }
    }

    if (tabLogin) tabLogin.addEventListener('click', function () { activateTab('login'); });
    if (tabRegister) tabRegister.addEventListener('click', function () { activateTab('register'); });

    document.querySelectorAll('.course-card').forEach(function (card) {
        card.addEventListener('click', function (e) {
            if (e.target.closest('a, button')) return;
            var url = card.getAttribute('data-detail-url');
            if (url) window.location.href = url;
        });
        card.addEventListener('keydown', function (e) {
            if (e.key !== 'Enter' && e.key !== ' ') return;
            if (e.target.closest('a, button')) return;
            e.preventDefault();
            var url = card.getAttribute('data-detail-url');
            if (url) window.location.href = url;
        });
    });
})();
</script>
@endpush
