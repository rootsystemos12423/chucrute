<!-- Componente de Pop-up -->
<div 
    x-data 
    x-show="$store.popup.visible" 
    x-transition.scale.opacity.duration.300ms
    class="fixed bottom-10 left-1/2 transform -translate-x-1/2 bg-white border shadow-xl rounded-lg p-6 flex items-center gap-4 w-80 text-base"
    :class="{
        'border-red-500 text-red-700': $store.popup.type === 'error',
        'border-blue-500 text-blue-700': $store.popup.type === 'loading',
        'border-green-500 text-green-700': $store.popup.type === 'success'
    }"
    @click="$store.popup.visible = false"
>
    <template x-if="$store.popup.type === 'loading'">
        <svg class="w-6 h-6 animate-spin text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v4m0 8v4m8-8h-4M4 12H0m15.556-6.556l-2.828 2.828m0 6.344l2.828 2.828M6.556 6.556l2.828 2.828m0 6.344l-2.828 2.828" />
        </svg>
    </template>

    <template x-if="$store.popup.type === 'error'">
        <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M12 18h0M12 6h0" />
        </svg>
    </template>

    <template x-if="$store.popup.type === 'success'">
        <svg class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
    </template>

    <span x-text="$store.popup.message" class="font-medium"></span>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('popup', {
        visible: false,
        message: '',
        type: 'loading',

        show(type, msg, duration = 3000) {
            this.type = type;
            this.message = msg;
            this.visible = true;

            if (type !== 'loading') {
                setTimeout(() => {
                    this.visible = false;
                }, duration);
            }
        }
    });

    window.showLoading = (message = "Carregando...") => {
        Alpine.store('popup').show('loading', message);
    };

    window.showError = (message = "Ocorreu um erro.") => {
        Alpine.store('popup').show('error', message);
    };

    window.showSuccess = (message = "Sucesso!") => {
        Alpine.store('popup').show('success', message);
    };
});
</script>
