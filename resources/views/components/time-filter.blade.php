<div>
    <div class="flex items-center gap-2 md:gap-6 justify-end">
        <div>
            <div class="flex items-center justify-center gap-3">
                <div class="bg-gray-100 p-1 rounded-full flex">
                    @foreach (['today' => 'Hoje', 'yesterday' => 'Ontem', 'week' => 'Semana', 'month' => 'Mês'] as $value => $label)
                        <label class="cursor-pointer">
                            <input 
                                class="hidden time-filter" 
                                type="radio" 
                                name="time-frame" 
                                value="{{ $value }}" 
                                {{ $value === 'today' ? 'checked' : '' }}> 
                            <div class="py-2 px-3 text-sm text-center time-label {{ $value === 'today' ? 'bg-[#ff0071] text-white rounded' : '' }}">
                                {{ $label }}
                            </div>
                        </label>
                    @endforeach

                    <!-- Calendário para período personalizado -->
                    <label class="cursor-pointer flex items-center px-2">
                        <input 
                            type="date" 
                            id="custom-date" 
                            class="py-2 px-2 bg-gray-100 text-sm border rounded focus:bg-white focus:outline-none focus:ring focus:border-blue-300">
                    </label>
                </div>
            </div>
        </div>
    </div> 

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const filters = document.querySelectorAll(".time-filter");
            const labels = document.querySelectorAll(".time-label");
            const customDateInput = document.getElementById("custom-date");

            function fetchData(timeFrame) {
                fetch("/api/dashboard/filter-data/reports", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ timeFrame })
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Dados recebidos:", data);
                    // Aqui você pode atualizar a interface com os novos dados
                })
                .catch(error => console.error("Erro ao buscar dados:", error));
            }

            // Buscar os dados para "Hoje" ao carregar a página
            fetchData("today");

            filters.forEach((input, index) => {
                input.addEventListener("change", function () {
                    const selectedTime = this.value;

                    // Remover a classe de todos os labels
                    labels.forEach(label => label.classList.remove("bg-[#ff0071]", "text-white", "rounded"));

                    // Adicionar a classe no label correspondente
                    labels[index].classList.add("bg-[#ff0071]", "text-white", "rounded");

                    // Limpar o campo de data personalizada
                    customDateInput.value = "";

                    // Buscar dados para o período selecionado
                    fetchData(selectedTime);
                });
            });

            // Evento para capturar a data personalizada
            customDateInput.addEventListener("change", function () {
                const selectedDate = this.value;

                if (selectedDate) {
                    // Remover a classe de todos os labels
                    labels.forEach(label => label.classList.remove("bg-[#ff0071]", "text-white", "rounded"));

                    // Buscar dados para a data específica
                    fetchData(selectedDate);
                }
            });
        });
    </script>
</div>
