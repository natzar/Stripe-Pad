class Stripe_Pad_Feedback {
    constructor() {
        this.selectedRating = 0;
        this.hash = null;
        this.context = null;

        this.createModal();
        // Exemple per carregar canvas-confetti
        loadScript('https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js', () => {
            console.log('🎉 Confetti carregat!');
        });
    }

    createModal() {
        const modalHTML = `
      <div id="feedback-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-xl p-6 relative">
          <button id="feedback-close" class="absolute top-4 right-4 text-gray-500 hover:text-black">✕</button>
          <h2 class="text-lg font-semibold text-gray-800 mb-4">Comentarios de <span id="modal-domain-name">tu sitio</span></h2>
          <div id="modal-context-text" class="text-sm text-gray-600 mb-4"></div>
          <div class="mb-4">
            <p class="text-sm font-medium text-gray-700 mb-2">¿Cuál es tu grado de satisfacción con esta experiencia?</p>
            <div id="rating-stars" class="flex gap-1 text-2xl text-gray-300 mb-2 cursor-pointer">
              <span data-value="1">★</span><span data-value="2">★</span><span data-value="3">★</span><span data-value="4">★</span><span data-value="5">★</span>
            </div>
            <textarea id="feedback-message" class="w-full border border-gray-300 rounded p-2 text-sm" rows="3" placeholder="¿Cuál es el principal motivo de esta puntuación?"></textarea>
          </div>
          <div class="text-xs text-gray-600 mb-4 flex gap-2">
            <span class="text-blue-600 font-bold">ℹ️</span>
            <p>Para que podamos proteger mejor tu privacidad, no incluyas datos personales ni de tu cuenta. Si necesitas ayuda, ponte en contacto con
              <a href="contact" class="text-blue-600 hover:underline">Servicio de atención al cliente para empresas</a>.
            </p>
          </div>
          <div class="mb-4 flex items-center gap-2">
            <input type="checkbox" id="feedback-updates" class="form-checkbox">
            <label for="feedback-updates" class="text-sm text-gray-700">Recibir actualizaciones sobre este comentario</label>
          </div>
          <div class="flex justify-end gap-2">
            <button id="feedback-cancel" class="px-4 py-2 text-sm border rounded text-gray-700 hover:bg-gray-100">Cancelar</button>
            <button id="feedback-submit" class="px-4 py-2 text-sm bg-yellow-400 hover:bg-yellow-600 text-yellow-700  rounded">Enviar opinión</button>
          </div>
        </div>
      </div>`;

        const wrapper = document.createElement('div');
        wrapper.innerHTML = modalHTML;
        document.body.appendChild(wrapper);

        document.getElementById('feedback-close').onclick = () => this.closeModal();
        document.getElementById('feedback-cancel').onclick = () => this.closeModal();
        document.getElementById('feedback-submit').onclick = () => this.submit();

        document.querySelectorAll('#rating-stars span').forEach(star => {
            star.addEventListener('mouseover', (e) => this.highlightStars(parseInt(e.target.dataset.value)));
            star.addEventListener('mouseout', () => this.highlightStars(this.selectedRating));
            star.addEventListener('click', (e) => {
                this.selectedRating = parseInt(e.target.dataset.value);
                this.highlightStars(this.selectedRating);
            });
        });
    }

    open(hash, contextText) {
        this.hash = hash;
        this.context = contextText;
        this.selectedRating = 0;
        document.getElementById('modal-context-text').innerText = contextText;
        document.getElementById('modal-domain-name').innerText = this.getDomainName();
        document.getElementById('feedback-message').value = '';
        this.highlightStars(0);
        document.getElementById('feedback-modal').classList.remove('hidden');
        return false;
    }

    closeModal() {
        document.getElementById('feedback-modal').classList.add('hidden');
    }

    highlightStars(value) {
        const stars = document.querySelectorAll('#rating-stars span');
        stars.forEach((star, i) => {
            star.classList.toggle('text-yellow-400', i < value);
            star.classList.toggle('text-gray-300', i >= value);
        });
    }

    submit() {
        const msg = document.getElementById('feedback-message').value;
        const wantsUpdates = document.getElementById('feedback-updates').checked;
        if (!msg || this.selectedRating === 0) {
            alert('Por favor, completa el mensaje y selecciona una puntuación.');
            return;
        }
        this.postAjax(base_url + "webhooks/sp-feedback.php", {
            url: window.location.href,
            tag: 'feedback-modal',
            comment: msg,
            points: this.selectedRating,
            //updates: wantsUpdates,
            hash: this.hash,
            context: this.context,
            usersId: usersId,
            browser: this.detectBrowser()
        }, () => {
            this.closeModal();
            if (window.confetti) {
                confetti({ particleCount: 100, spread: 70, origin: { y: 0.6 } });
            }
        });
    }

    postAjax(url, data, success) {
        const params = typeof data == 'string' ? data : Object.keys(data).map(
            k => encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
        ).join('&');

        const xhr = new XMLHttpRequest();
        xhr.open('POST', url);
        xhr.onreadystatechange = function () {
            if (xhr.readyState > 3 && xhr.status == 200) {
                success(xhr.responseText);
            }
        };
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(params);
        return xhr;
    }

    detectBrowser() {
        const ua = navigator.userAgent;
        if (ua.indexOf("Chrome") > -1) return "Chrome";
        if (ua.indexOf("Firefox") > -1) return "Firefox";
        if (ua.indexOf("Safari") > -1) return "Safari";
        if (ua.indexOf("MSIE") > -1 || !!document.documentMode) return "IE";
        return "Unknown";
    }

    getDomainName() {
        const hostname = window.location.hostname.replace("www.", "");
        const domainName = hostname.split('.')[0];
        return domainName.charAt(0).toUpperCase() + domainName.slice(1);
    }
}

function loadScript(src, callback) {
    const script = document.createElement('script');
    script.src = src;
    script.async = true;
    script.onload = () => {
        if (typeof callback === 'function') callback();
    };
    script.onerror = () => {
        console.error(`Error carregant el script: ${src}`);
    };
    document.head.appendChild(script);
}


const stripepad_feedback_modal = new Stripe_Pad_Feedback();



// click

