(function loadPapaParse(callback) {
    const script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/papaparse@5.4.1/papaparse.min.js';
    script.onload = callback;
    document.head.appendChild(script);
})(() => {
    class ImportContactsModal {
        constructor() {
            this.fields = ['name', 'email', 'organization', 'info', 'category'];
            this.headers = [];
            this.data = [];
            this.createModal();
        }

        createModal() {
            const html = `
      <div id="import-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl p-6 relative">
          <button id="import-close" class="absolute top-4 right-4 text-gray-500 hover:text-black">✕</button>
          <h2 class="text-lg font-semibold text-gray-800 mb-4">Importar contactos desde CSV</h2>

          <input type="file" id="csv-input" accept=".csv" class="mb-4 border p-2 rounded w-full text-sm" />

          <div id="mapping-area" class="hidden mb-6">
            <p class="text-sm mb-2 text-gray-700">Asigna cada campo:</p>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-4" id="mapping-selects"></div>
<p class="text-sm mb-2 text-gray-700">Categoría para todos los contactos:</p>
<select id="category-id" class="w-full mb-6 border rounded p-2 text-sm">
  <option value="2" selected>Sin clasificar</option>
  <option value="1">Proveedor</option>
  <option value="3">Cliente</option>
  <option value="4">Privado</option>
  <option value="5">Destacado</option>
  <option value="6">Trabajador</option>
  <option value="7">Cliente VIP</option>
</select>

            <p class="text-sm mb-2 text-gray-700">Vista previa:</p>
            <div class="overflow-auto max-h-64 border border-gray-200 rounded">
              <table class="min-w-full text-xs text-left" id="preview-table">
                <thead class="bg-gray-100 text-gray-700 font-medium" id="preview-head"></thead>
                <tbody id="preview-body"></tbody>
              </table>
            </div>
          </div>

          <div class="flex justify-end gap-2 mt-6">
            <button id="import-cancel" class="px-4 py-2 text-sm border rounded text-gray-700 hover:bg-gray-100">Cancelar</button>
            <button id="import-confirm" class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded hidden">Importar contactos</button>
          </div>
        </div>
      </div>`;

            const wrapper = document.createElement('div');
            wrapper.innerHTML = html;
            document.body.appendChild(wrapper);

            document.getElementById('import-close').onclick = () => this.close();
            document.getElementById('import-cancel').onclick = () => this.close();
            document.getElementById('csv-input').onchange = (e) => this.handleFile(e.target.files[0]);
            document.getElementById('import-confirm').onclick = () => this.importContacts();
        }

        open() {
            document.getElementById('import-modal').classList.remove('hidden');
        }

        close() {
            document.getElementById('import-modal').classList.add('hidden');
        }

        handleFile(file) {
            if (!file) return;
            Papa.parse(file, {
                header: true,
                skipEmptyLines: true,
                complete: (result) => {
                    this.headers = result.meta.fields;
                    this.data = result.data;
                    this.renderMapping();
                }
            });
        }

        renderMapping() {
            const selects = this.fields.map(field => {
                const options = [`<option value="">(Ignorar campo)</option>`];
                this.headers.forEach(h => {
                    const selected = h.toLowerCase() === field.toLowerCase() ? 'selected' : '';
                    options.push(`<option value="${h}" ${selected}>${h}</option>`);
                });

                return `
          <div>
            <label class="block mb-1 text-sm font-medium text-gray-600">${field}</label>
            <select data-field="${field}" class="w-full border rounded p-1 text-sm">
              ${options.join('')}
            </select>
          </div>`;
            }).join('');

            document.getElementById('mapping-selects').innerHTML = selects;
            document.getElementById('mapping-area').classList.remove('hidden');
            document.getElementById('import-confirm').classList.remove('hidden');

            this.renderPreview();
        }

        renderPreview() {
            const headEl = document.getElementById('preview-head');
            const bodyEl = document.getElementById('preview-body');
            headEl.innerHTML = '<tr>' + this.headers.map(h => `<th class="px-2 py-1">${h}</th>`).join('') + '</tr>';

            const rows = this.data.slice(0, 5).map(row =>
                '<tr>' + this.headers.map(h => `<td class="border px-2 py-1">${row[h] || ''}</td>`).join('') + '</tr>'
            ).join('');

            bodyEl.innerHTML = rows;
        }

        importContacts() {
            const mappings = {};
            document.querySelectorAll('#mapping-selects select').forEach(select => {
                if (select.value) {
                    mappings[select.dataset.field] = select.value;
                }
            });

            if (!mappings.email) {
                alert("El campo 'email' es obligatorio.");
                return;
            }

            const finalContacts = this.data.map(row => {
                const contact = {};
                for (const field in mappings) {
                    contact[field] = row[mappings[field]] || '';
                }
                return contact;
            });
            const selectedCategoryId = document.getElementById('category-id').value;
            finalContacts.forEach(contact => {
                contact.contacts_categoryId = selectedCategoryId;
            });
            if (finalContacts.length === 0) {
                alert("No se encontraron contactos para importar.");
                return;
            }
            let counter = 0;
            finalContacts.forEach(contact => {
                counter++;
                fetch('https://www.agentedesoporte.es/api/v2/contact', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer deadbeef'
                    },
                    body: JSON.stringify(contact)
                })
                    .then(response => {
                        if (!response.ok) throw new Error("Error al importar");
                        return response.text();
                    })
                    .then(res => {
                        //alert(`✅ Se han importado ${finalContacts.length} contactos`);
                        //this.close();
                    })
                    .catch(err => {
                        console.error(err);
                        // alert("❌ Error al importar los contactos");
                    });

                if (counter === finalContacts.length) {
                    alert(`✅ Se han importado ${finalContacts.length} contactos`);
                    this.close();
                }
            });
        }
    }

    window.ImportContactsModal = ImportContactsModal;
});
