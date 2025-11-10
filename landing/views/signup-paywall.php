<div class="max-w-4xl bg-slate-900 text-gray-100 rounded-xl shadow-2xl mx-auto px-6 py-6 mt-10 mb-10">
  <div class="grid sm:grid-cols-2 gap-4">
    <!-- Left Column -->
    <div class="p-4 space-y-4">
      <div class="pr-2">

        <div class="flex items-start space-x-3 mb-4">
          <div class="text-xl">🎯</div>
          <div>
            <p class="font-bold text-gray-50">Lorem ipsum dolor</p>
            <p class="text-sm text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel libero vitae mi mattis convallis.</p>
          </div>
        </div>

        <div class="flex items-start space-x-3 mb-4">
          <div class="text-xl">🛡️</div>
          <div>
            <p class="font-bold text-gray-50">Sed ut perspiciatis</p>
            <p class="text-sm text-gray-400">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
          </div>
        </div>

        <div class="flex items-start space-x-3 mb-4">
          <div class="text-xl">🌍</div>
          <div>
            <p class="font-bold">At vero eos et accusamus</p>
            <p class="text-sm text-gray-600">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium.</p>
          </div>
        </div>

        <div class="flex items-start space-x-3 mb-4">
          <div class="text-xl">⚡</div>
          <div>
            <p class="font-bold">Nemo enim ipsam</p>
            <p class="text-sm text-gray-600">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.</p>
          </div>
        </div>

        <div class="flex items-start space-x-3 mb-4">
          <div class="text-xl">🔎</div>
          <div>
            <p class="font-bold">Ut enim ad minima veniam</p>
            <p class="text-sm text-gray-600">Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.</p>
          </div>
        </div>

        <div class="flex items-start space-x-3 mb-4">
          <div class="text-xl">🤖</div>
          <div>
            <p class="font-bold">Quis autem vel eum</p>
            <p class="text-sm text-gray-600">Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.</p>
          </div>
        </div>

        <div class="flex items-start space-x-3 mb-4">
          <div class="text-xl">📦</div>
          <div>
            <p class="font-bold">Neque porro quisquam</p>
            <p class="text-sm text-gray-600">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>
          </div>
        </div>

        <div class="flex items-start space-x-3 mb-4">
          <div class="text-xl">🧪</div>
          <div>
            <p class="font-bold">Excepteur sint occaecat</p>
            <p class="text-sm text-gray-600">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
        </div>

        <div class="flex items-start space-x-3 mb-4">
          <div class="text-xl">📈</div>
          <div>
            <p class="font-bold">Curabitur blandit tempus</p>
            <p class="text-sm text-gray-600">Curabitur blandit tempus porttitor. Donec id elit non mi porta gravida at eget metus.</p>
          </div>
        </div>

        <div class="flex items-start space-x-3 mb-4">
          <div class="text-xl">🎓</div>
          <div>
            <p class="font-bold">Etiam porta sem malesuada</p>
            <p class="text-sm text-gray-600">Etiam porta sem malesuada magna mollis euismod. Nulla vitae elit libero, a pharetra augue.</p>
          </div>
        </div>

      </div>
    </div>

    <!-- Right Column -->
    <div class="bg-slate-800 p-4 space-y-4 rounded-xl border border-slate-700">
      <!-- YouTube Video -->
      <div class="aspect-w-16 aspect-h-9">
        <iframe width="100%" height="300" src="https://www.youtube.com/embed/xapiI8x5e8c?si=_yZX9bpVchOcR_-6" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" class="rounded-xl overflow-hidden" allowfullscreen></iframe>
      </div>

      <!-- Form -->
      <form class="flex flex-col space-y-2">
        <input type="text" placeholder="Nombre y Apellidos" class="p-2 border border-slate-600 bg-slate-900 text-gray-100 rounded focus:ring-2 focus:ring-blue-500">
        <input type="text" placeholder="Empresa u organización" class="p-2 border border-slate-600 bg-slate-900 text-gray-100 rounded focus:ring-2 focus:ring-blue-500">
        <input type="email" placeholder="Tu email" class="p-2 border border-slate-600 bg-slate-900 text-gray-100 rounded focus:ring-2 focus:ring-blue-500">
        <div class="flex flex-col gap-y-2 text-sm text-gray-300">
          <label class="inline-flex items-center gap-x-2">
            <input type="radio" onclick="document.getElementById('buy_now_button').href=this.value;" name="plan" class="inline text-blue-500 focus:ring-blue-500" value="https://buy.stripe.com/5kQ00igt0f8n3bvfPCak001" checked>
            Plan Base 39€/mes
          </label>
          <label class="inline-flex items-center gap-x-2">
            <input type="radio" name="plan" onclick="document.getElementById('buy_now_button').href=this.value;" class="inline text-blue-500 focus:ring-blue-500" value="https://buy.stripe.com/fZu3cu5Om5xN13n46Uak002">
            Plan Startup 79€/mes
          </label>
        </div>
        <a id="buy_now_button" href="https://buy.stripe.com/5kQ00igt0f8n3bvfPCak001" target="_blank" class="bg-blue-600 w-full px-3 hover:bg-blue-500 text-center text-white py-3 font-semibold rounded transition"><?= _('Start Now') ?> &raquo;</a>
        <p class="text-xs text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse a nunc ut elit laoreet porta.</p>
      </form>

      <section class="payment-icons" style="display:flex;gap:1rem;align-items:center;">
        <svg viewBox="0 0 60 25" xmlns="http://www.w3.org/2000/svg" width="60" height="25" class="UserLogo variant-- ">
          <title>Stripe logo</title>
          <path fill="var(--userLogoColor, #0A2540)" d="M59.64 14.28h-8.06c.19 1.93 1.6 2.55 3.2 2.55 1.64 0 2.96-.37 4.05-.95v3.32a8.33 8.33 0 0 1-4.56 1.1c-4.01 0-6.83-2.5-6.83-7.48 0-4.19 2.39-7.52 6.3-7.52 3.92 0 5.96 3.28 5.96 7.5 0 .4-.04 1.26-.06 1.48zm-5.92-5.62c-1.03 0-2.17.73-2.17 2.58h4.25c0-1.85-1.07-2.58-2.08-2.58zM40.95 20.3c-1.44 0-2.32-.6-2.9-1.04l-.02 4.63-4.12.87V5.57h3.76l.08 1.02a4.7 4.7 0 0 1 3.23-1.29c2.9 0 5.62 2.6 5.62 7.4 0 5.23-2.7 7.6-5.65 7.6zM40 8.95c-.95 0-1.54.34-1.97.81l.02 6.12c.4.44.98.78 1.95.78 1.52 0 2.54-1.65 2.54-3.87 0-2.15-1.04-3.84-2.54-3.84zM28.24 5.57h4.13v14.44h-4.13V5.57zm0-4.7L32.37 0v3.36l-4.13.88V.88zm-4.32 9.35v9.79H19.8V5.57h3.7l.12 1.22c1-1.77 3.07-1.41 3.62-1.22v3.79c-.52-.17-2.29-.43-3.32.86zm-8.55 4.72c0 2.43 2.6 1.68 3.12 1.46v3.36c-.55.3-1.54.54-2.89.54a4.15 4.15 0 0 1-4.27-4.24l.01-13.17 4.02-.86v3.54h3.14V9.1h-3.13v5.85zm-4.91.7c0 2.97-2.31 4.66-5.73 4.66a11.2 11.2 0 0 1-4.46-.93v-3.93c1.38.75 3.1 1.31 4.46 1.31.92 0 1.53-.24 1.53-1C6.26 13.77 0 14.51 0 9.95 0 7.04 2.28 5.3 5.62 5.3c1.36 0 2.72.2 4.09.75v3.88a9.23 9.23 0 0 0-4.1-1.06c-.86 0-1.44.25-1.44.9 0 1.85 6.29.97 6.29 5.88z" fill-rule="evenodd"></path>
        </svg>

        <img src="https://github.com/datatrans/payment-logos/raw/master/assets/cards/visa.svg" alt="Visa" width="60">
        <img src="https://github.com/datatrans/payment-logos/raw/master/assets/cards/mastercard.svg" alt="MasterCard" width="60">
        <img src="https://github.com/datatrans/payment-logos/raw/master/assets/apm/sepa.svg" alt="SEPA" width="60">
      </section>

      <div class="overflow-y-auto text-gray-300 text-sm space-y-2">
        <p>⟶ John Doe, Lorem Corp: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vitae elit libero, a pharetra augue."</p>
        <p>⟶ Jane Smith, Ipsum Agency: "Sed posuere consectetur est at lobortis. Curabitur blandit tempus porttitor."</p>
        <p>⟶ Alice Brown, Demo Ltd: "Maecenas sed diam eget risus varius blandit sit amet non magna. Donec ullamcorper nulla non metus."</p>

        <? include dirname(__FILE__) . "/forms-rgpd.php"; ?>
      </div>
    </div>
  </div>
</div>
