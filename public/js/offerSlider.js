window.offerSlider = function() {
  return {
    currentIndex: 0,
    startX: 0,
    offers: [],
    init() {
      // Definindo o Alpine store globalmente para garantir que o estado seja compartilhado
      if (!Alpine.store('offerSelection')) {
        Alpine.store('offerSelection', {
          selectedOffers: [], // Array global para armazenar as seleções
        });
      }

      // Recuperar o estado do localStorage, se existir
      const savedSelections = JSON.parse(localStorage.getItem('selectedOffers'));
      if (savedSelections) {
        Alpine.store('offerSelection').selectedOffers = savedSelections;
      } else {
        // Se não houver estado salvo, inicialize com um array de seleções desmarcadas
        this.fetchOffers();
      }
    },

    fetchOffers() {
      fetch('/api/checkout/customers/get_orderbump_list', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-Token': csrfToken,
        },
        body: JSON.stringify({
          checkoutToken: checkoutToken,
        }),
      })
      .then(response => response.json())
      .then(data => {
        this.offers = data.products;
        // Inicializando o estado de seleção no store
        Alpine.store('offerSelection').selectedOffers = new Array(this.offers.length).fill(false);
        // Carregar as ofertas previamente selecionadas, se necessário
        this.loadPreviousSelections();
      })
      .catch(error => console.error('Erro ao carregar as ofertas:', error));
    },

    loadPreviousSelections() {
      // Verifica se há algum estado salvo nas sessões para marcas já resgatadas
      const savedSelections = sessionStorage.getItem('selectedOffers');
      if (savedSelections) {
        Alpine.store('offerSelection').selectedOffers = JSON.parse(savedSelections);
      }
    },

    sendSelectedOffer(index) {
      const selectedOffer = this.offers[index];
      const isSelected = Alpine.store('offerSelection').selectedOffers[index];

      // Se o usuário marcou a oferta, adicionar ao carrinho
      if (isSelected) {
        fetch('/api/checkout/customers/select_offer_orderbump', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-Token': csrfToken,
          },
          body: JSON.stringify({
            checkoutToken: checkoutToken,
            offerId: selectedOffer.order_bump_id,
          }),
        })
        .then(response => response.json())
        .then(data => {
          console.log(data);
          // Salva a seleção no sessionStorage
          sessionStorage.setItem('selectedOffers', JSON.stringify(Alpine.store('offerSelection').selectedOffers));
          fetchCartItems(); // Chama a função para atualizar o carrinho
          calculateTotal(checkoutToken);
        })
        .catch(error => console.error('Erro ao adicionar oferta ao carrinho:', error));
      } else {
        // Se o usuário desmarcar a oferta, remover do carrinho
        fetch('/api/checkout/customers/remove_offer_orderbump', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-Token': csrfToken,
          },
          body: JSON.stringify({
            checkoutToken: checkoutToken,
            offerId: selectedOffer.order_bump_id,
          }),
        })
        .then(response => response.json())
        .then(data => {
          console.log(data);
          // Salva a seleção no sessionStorage
          sessionStorage.setItem('selectedOffers', JSON.stringify(Alpine.store('offerSelection').selectedOffers));
          fetchCartItems(); // Chama a função para atualizar o carrinho
          calculateTotal(checkoutToken);
        })
        .catch(error => console.error('Erro ao remover oferta do carrinho:', error));
      }
    },

    startSwipe(event) {
      this.startX = event.touches[0].clientX;
    },

    endSwipe(event) {
      let endX = event.changedTouches[0].clientX;
      let diff = this.startX - endX;

      if (diff > 50) {
        this.nextOffer();
      } else if (diff < -50) {
        this.prevOffer();
      }
    },

    nextOffer() {
      this.currentIndex = (this.currentIndex + 1) % this.offers.length;
    },

    prevOffer() {
      this.currentIndex = (this.currentIndex - 1 + this.offers.length) % this.offers.length;
    }
  };
};
