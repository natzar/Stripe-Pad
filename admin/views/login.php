<div class="min-h-screen bg-slate-950 bg-[radial-gradient(60%_60%_at_50%_0%,rgba(99,102,241,.25),transparent)] text-slate-100 flex items-center justify-center p-6">
    <main class="w-full max-w-md">
        <section class="relative rounded-2xl border border-white/10 bg-white/5 backdrop-blur shadow-xl">
            <div class="p-8">
                <!-- Brand -->
                <div class="mb-8 flex items-center gap-3">
                    <div class="grid h-10 w-10 place-items-center rounded-xl bg-indigo-500/20 border border-indigo-400/30">
                        <span class="text-indigo-300 font-black">SP</span>
                    </div>
                    <div>
                        <h1 class="text-lg font-semibold leading-tight">Stripe Pad Admin</h1>
                        <p class="text-sm text-slate-400">Acceso de superadmin</p>
                    </div>
                </div>

                <!-- Form -->
                <form action="/admin/login" method="post" class="space-y-6" novalidate>
                    <!-- CSRF -->
                    <!-- <input type="hidden" name="csrf_token" value="{{ token }}" /> -->

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-slate-200">Email</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            autocomplete="email"
                            placeholder="admin@stripepad.com"
                            class="block w-full rounded-lg border border-white/10 bg-white/10 px-4 py-2.5 text-sm text-slate-100 placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400/40" />
                    </div>

                    <div>
                        <div class="mb-2 flex items-center justify-between">
                            <label for="password" class="text-sm font-medium text-slate-200">Contraseña</label>
                            <a href="/admin/forgot" class="text-xs text-indigo-300 hover:text-indigo-200">¿Olvidaste tu contraseña?</a>
                        </div>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            class="block w-full rounded-lg border border-white/10 bg-white/10 px-4 py-2.5 text-sm text-slate-100 placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400/40"
                            placeholder="••••••••" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center gap-2 text-sm text-slate-300">
                            <input type="checkbox" name="remember" class="h-4 w-4 rounded border-white/10 bg-white/10 text-indigo-400 focus:ring-indigo-400/40" />
                            Recuérdame
                        </label>
                        <span class="text-xs text-slate-500">v1.0.0</span>
                    </div>

                    <button
                        type="submit"
                        class="inline-flex w-full items-center justify-center rounded-lg bg-indigo-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400/40 disabled:opacity-60">
                        Entrar
                    </button>

                    <!-- Error placeholder (show conditionally from backend) -->
                    <!-- <p class="text-sm text-rose-300">Credenciales no válidas.</p> -->
                </form>
            </div>

            <!-- Subtle divider -->
            <div class="h-px w-full bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>

            <div class="p-6 text-center">
                <p class="text-xs text-slate-400">
                    Al continuar aceptas las <a class="underline decoration-dotted underline-offset-2 hover:text-slate-200" href="/legal/terms">Condiciones</a> y la
                    <a class="underline decoration-dotted underline-offset-2 hover:text-slate-200" href="/legal/privacy">Política de Privacidad</a>.
                </p>
            </div>
        </section>

        <!-- Small footer -->
        <p class="mt-6 text-center text-xs text-slate-500">© <span id="year"></span> Stripe Pad. Todos los derechos reservados.</p>
    </main>

    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</div>