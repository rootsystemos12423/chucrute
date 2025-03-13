// Definir a função fetchCartItems globalmente
let cartItems = [];


const fetchCartItems = async () => {
    const cartContainer = document.getElementById('cart-items-container');

    if (!cartContainer) {
        console.error("Elemento #cart-items-container não encontrado!");
        return;
    }

    try {
        const response = await fetch('/api/checkout/list/items', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ checkoutToken })
        });

        const data = await response.json();

        if (data.success && Array.isArray(data.items)) {
            cartItems = data.items;
            let cartContent = '';

            data.items.forEach(item => {
                const imageUrl = item.image ? item.image : 'https://via.placeholder.com/100';
                
                // Corrigindo a formatação do preço
                const rawPrice = item.price.replace(',', '.'); // Troca vírgula por ponto
                const formattedPrice = Number(rawPrice).toLocaleString('pt-BR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

                cartContent += `
                    <div class="flex flex-col items-center border-b border-gray-200 py-3">
                        <div class="flex flex-col">
                            <div class="flex sm:items-start items-center gap-2 py-2">
                                <img class="w-16 h-16 object-cover rounded-md" src="${imageUrl}" alt="Produto">
                                <div>
                                    <h3 class="text-xs text-gray-500 pb-1 flex items-center w-44">${item.title}</h3>
                                    <div class="pb-1 px-2">
                                        <p class="text-sm text-gray-800 font-semibold mt-1">R$ ${formattedPrice}</p>
                                    </div>
                                </div>
                                <button class="ml-2 text-gray-600 hover:text-red-600 transition-colors remove-item" data-id="${item.id}">
                                    <svg class="sm:h-5 sm:w-5 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex w-1/2 justify-around items-center text-xs bg-gray-100 rounded-md mb-1">
                            <button class="px-2 text-gray-600 text-thin transition sm:text-2xl text-lg decrease-qty" data-id="${item.id}">−</button>
                            <span class="px-2 text-gray-600 text-md product-quantity" data-id="${item.id}">${item.quantity}</span>
                            <button class="px-2 text-gray-600 text-thin transition sm:text-2xl text-lg increase-qty" data-id="${item.id}">+</button>
                        </div>
                    </div>`;
            });

            cartContainer.innerHTML = cartContent;
            attachEventListeners();
        }
    } catch (error) {
        console.error("Erro ao buscar itens do carrinho:", error);
    }
};

// Definir a função para adicionar os event listeners globalmente
const attachEventListeners = () => {
    // Evento para aumentar a quantidade
    document.querySelectorAll('.increase-qty').forEach(button => {
        button.addEventListener('click', async () => {
            const id = button.getAttribute('data-id');
            const quantityElement = document.querySelector(`.product-quantity[data-id="${id}"]`);
            const newQuantity = parseInt(quantityElement.textContent) + 1;
            await updateQuantity(id, newQuantity);
        });
    });

    // Evento para diminuir a quantidade
    document.querySelectorAll('.decrease-qty').forEach(button => {
        button.addEventListener('click', async () => {
            const id = button.getAttribute('data-id');
            const quantityElement = document.querySelector(`.product-quantity[data-id="${id}"]`);
            const newQuantity = parseInt(quantityElement.textContent) - 1;
            if (newQuantity > 0) { // Impede que a quantidade seja menor que 1
                await updateQuantity(id, newQuantity);
            }
        });
    });

    // Evento para remover um item
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', async () => {
            const id = button.getAttribute('data-id');
            await removeItem(id);
        });
    });
};

// Função para atualizar a quantidade do item no backend
const updateQuantity = async (id, newQuantity) => {
    try {
        await fetch('/api/checkout/cart/update-quantity', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ id, quantity: newQuantity })
        });

        fetchCartItems();
        calculateTotal(checkoutToken); // Atualiza o carrinho após a alteração
    } catch (error) {
        console.error("Erro ao atualizar a quantidade:", error);
    }
};

const calculateTotal = async (checkoutToken) => {
    const cartContainer = document.getElementById('cart-items-container');
    if (!cartContainer) {
        console.error("Elemento #cart-items-container não encontrado!");
        return;
    }

    try {
        const response = await fetch('/api/checkout/cart/total', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ checkoutToken })
        });

        const data = await response.json();

        if (data.success) {
            // Selecionando todos os elementos com a classe 'cart-total'
            const totalElements = document.querySelectorAll('.cart-total');
            
            totalElements.forEach(element => {
                // Atualizando o conteúdo de cada um com o total calculado
                element.textContent = `R$ ${data.total}`;
            });
        } else {
            console.error('Erro ao calcular o total do carrinho:', data.message);
        }
    } catch (error) {
        console.error("Erro ao buscar o total do carrinho:", error);
    }
};


// Função para remover um item do carrinho
const removeItem = async (id) => {
    try {
        await fetch('/api/checkout/cart/remove-item', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ id })
        });

        fetchCartItems();
        calculateTotal(checkoutToken); // Atualiza o carrinho após a remoção
    } catch (error) {
        console.error("Erro ao remover item:", error);
    }
};

// Inicializar a função quando a página for carregada
document.addEventListener('DOMContentLoaded', async () => {
    await fetchCartItems(); // Carrega os itens do carrinho ao iniciar
});
