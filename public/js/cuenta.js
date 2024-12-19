document.addEventListener('DOMContentLoaded', function () {
    const userName = "{{ session('user')['first_name'] }}";
    const resumenCuentaElement = document.getElementById('resumen-cuenta');
    const totalCuentaElement = document.getElementById('total-cuenta');

    fetch(`https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas/mesa/resumen/${userName}`)
        .then(response => response.json())
        .then(data => {
            let resumenHtml = '<ul>';
            data.forEach(item => {
                resumenHtml += `<li>${item.producto} - Cantidad: ${item.cantidad}</li>`;
            });
            resumenHtml += '</ul>';
            resumenCuentaElement.innerHTML = resumenHtml;
        })
        .catch(error => {
            resumenCuentaElement.innerHTML = '<p>Error al cargar el resumen de la cuenta.</p>';
            console.error('Error:', error);
        });

    fetch(`https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas/mesa/total/${userName}`)
        .then(response => response.json())
        .then(data => {
            totalCuentaElement.textContent = data;
        })
        .catch(error => {
            totalCuentaElement.textContent = 'Error';
            console.error('Error:', error);
        });
});