document.addEventListener('DOMContentLoaded', () => {
    // Función para verificar si el usuario está autenticado
    async function checkGoogleAuth() {
        try {
            // Obtener la URL actual
            const currentUrl = window.location.href;

            // Realizar una consulta al backend para verificar la sesión
            const response = await fetch('/api/check-auth', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            if (response.ok) {
                const data = await response.json();

                // Si el usuario no está autenticado, guardar la URL actual y redirigir
                if (!data.authenticated) {
                    // Guardar la URL actual en el almacenamiento local
                    localStorage.setItem('redirect_after_login', currentUrl);

                    // Redirigir a la autenticación de Google
                    window.location.href = '/auth/google';
                }
            } else {
                // En caso de error, redirigir a la autenticación de Google
                console.error('Error al verificar la autenticación:', response.status);
                localStorage.setItem('redirect_after_login', currentUrl);
                window.location.href = '/auth/google';
            }
        } catch (error) {
            console.error('Error al verificar la autenticación:', error);
            // Guardar la URL actual y redirigir en caso de error crítico
            localStorage.setItem('redirect_after_login', currentUrl);
            window.location.href = '/auth/google';
        }
    }

    // Llamar a la función de verificación
    checkGoogleAuth();
});
