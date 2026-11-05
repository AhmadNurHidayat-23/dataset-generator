document.querySelectorAll('[data-confirm]').forEach(form => {
    form.addEventListener('submit', event => {
        if (!confirm(form.dataset.confirm)) event.preventDefault();
    });
});
document.querySelectorAll('[data-copy]').forEach(button => {
    button.addEventListener('click', async () => {
        try { await navigator.clipboard.writeText(document.querySelector(button.dataset.copy).textContent); button.textContent = 'Tersalin'; }
        catch { button.textContent = 'Pilih dan salin teks secara manual'; }
    });
});
