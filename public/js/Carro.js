// document.addEventListener('DOMContentLoaded', function () {
//     const carritoContainer = document.getElementById('carritoItems');
//     const totalDisplay = document.getElementById('totalRonda');
//     let totalRonda = 0;

//     // Recalcular el total de la ronda
//     window.actualizarTotalRonda = function () {
//         totalRonda = 0;
//         const carritoItems = carritoContainer.querySelectorAll('.carrito-item');
//         carritoItems.forEach(item => {
//             const precioProducto = parseFloat(item.dataset.precio);
//             const cantidadProducto = parseInt(item.dataset.cantidad);
//             totalRonda += precioProducto * cantidadProducto;
//         });

//         if (totalDisplay) {
//             totalDisplay.textContent = totalRonda.toFixed(2);
//         }
//     };

//     // Función para inicializar controles de cantidad
//     function initializeQuantityControls(carritoItem) {
//         const decrementBtn = carritoItem.querySelector('.cantidad-btn-decrement');
//         const incrementBtn = carritoItem.querySelector('.cantidad-btn-increment');
//         const cantidadText = carritoItem.querySelector('.cantidad-text');
//         const productPriceElement = carritoItem.querySelector('.product-price');

//         const precioProducto = parseFloat(carritoItem.dataset.precio);

//         decrementBtn.addEventListener('click', function () {
//             let cantidadActual = parseInt(carritoItem.dataset.cantidad);
//             if (cantidadActual > 1) {
//                 cantidadActual--;
//                 carritoItem.dataset.cantidad = cantidadActual;
//                 cantidadText.textContent = cantidadActual;
//                 productPriceElement.textContent = `MX$${(precioProducto * cantidadActual).toFixed(2)}`;
//                 window.actualizarTotalRonda();
//             }
//         });

//         incrementBtn.addEventListener('click', function () {
//             let cantidadActual = parseInt(carritoItem.dataset.cantidad);
//             cantidadActual++;
//             carritoItem.dataset.cantidad = cantidadActual;
//             cantidadText.textContent = cantidadActual;
//             productPriceElement.textContent = `MX$${(precioProducto * cantidadActual).toFixed(2)}`;
//             window.actualizarTotalRonda();
//         });
//     }

//     // Función para agregar productos al carrito
//     window.addToCart = function (product) {
//         const carritoItem = document.createElement('div');
//         carritoItem.classList.add('carrito-item');
//         carritoItem.dataset.precio = product.precio;
//         carritoItem.dataset.cantidad = 1;

//         // Generar HTML para la imagen del producto
//         const imageHTML = `
//             <img src="${product.foto}" alt="${product.nombre}" 
//                 class="product-image" 
//                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px; margin-right: 10px;">
//         `;

//         carritoItem.innerHTML = `
//             <div class="product-info" style="display: flex; align-items: center;">
//                 ${imageHTML}
//                 <div>
//                     <p class="product-name" style="margin: 0; font-weight: bold;">${product.nombre}</p>
//                     <p class="product-description" style="margin: 0; font-size: 0.9em; color: #666;">
//                         ${product.descripcion || 'Sin descripción'}
//                     </p>
//                 </div>
//             </div>
//             <div class="product-controls" style="display: flex; align-items: center; gap: 10px;">
//                 <div class="quantity-controls" style="display: flex; align-items: center; gap: 5px;">
//                     <button class="cantidad-btn cantidad-btn-decrement" 
//                         style="background-color: #e60000; color: white; border: none; width: 30px; height: 30px; border-radius: 5px;">−</button>
//                     <span class="cantidad-text" style="font-weight: bold;">1</span>
//                     <button class="cantidad-btn cantidad-btn-increment" 
//                         style="background-color: #e60000; color: white; border: none; width: 30px; height: 30px; border-radius: 5px;">+</button>
//                 </div>
//                 <span class="product-price" style="font-weight: bold;">MX$${product.precio.toFixed(2)}</span>
//                 <button class="eliminar-btn" style="background: none; border: none; color: #e60000; cursor: pointer; font-size: 1.2em;">
//                     <i class="fas fa-trash"></i>
//                 </button>
//             </div>
//         `;

//         carritoContainer.appendChild(carritoItem);
//         initializeQuantityControls(carritoItem);
//         window.actualizarTotalRonda();
//     };
// });
