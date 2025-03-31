<x-app-layout>
  <div class="flex flex-col px-2 pt-3 h-max xl:overflow-hidden">
   <div x-data="{
      timeFrame: 'today',
      customDate: '',
      cards: [],
      cards02: [],
      cards03: [],
      cards04: [],
      metaData: {},
      chartData: [],
      categories: [],
      comportamento10Min: [],
      comportamentoFunnel: { values: [], labels: [], colors: [] },
      percentageCard: [],
      percentagePix: [],
      percentageMethods: [], 
      installmentsChart: { series: [], labels: [], colors: [] },
      percentagePix2: {
         total_vendas: 'R$ 0,00',
         count_vendas: 0,
         status: []
      },
       percentageCard2: {
         total_vendas: 'R$ 0,00',
         count_vendas: 0,
         status: []
      },
      fetchData() {
          let filterValue = this.customDate || this.timeFrame;
          fetch('/api/dashboard/filter-data/reports', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').content
              },
              body: JSON.stringify({ timeFrame: filterValue, store_id: {{ session('store_id') }} })
          })
          .then(response => response.json())
          .then(data => {
              this.cards = data.cards;
              this.chartData = data.chart.series; // Dados do gráfico
              this.categories = data.chart.categories; // Datas do gráfico
              this.updateChart(); // Atualiza o gráfico quando os dados chegam
              this.cards02 = data.cards02;
              this.cards03 = data.cards03;
              this.cards04 = data.cards04;

              this.metaData = Array.isArray(data.metaData) ? data.metaData[0] : data.metaData;
              this.comportamento10Min = Array.isArray(data.comportamento10Min) ? data.comportamento10Min[0] : data.comportamento10Min;
              this.percentageCard = data.percentageCard.length ? data.percentageCard[0].status : [];
              this.percentagePix = data.percentagePix.length ? data.percentagePix[0].status : [];
              this.percentageMethods = data.percentageMethods.length ? data.percentageMethods[0].methods : [];

              // Atualizando dados do gráfico de parcelamento
              let chartData = data.installmentsChart[0]; 
              this.installmentsChart.series = chartData.methods;
              this.installmentsChart.labels = chartData.labels;
              this.installmentsChart.colors = chartData.colors;

              this.updateInstallmentsChart();

              this.percentagePix2 = {
                  total_vendas: data.percentagePix?.[0]?.total_vendas || 'R$ 0,00',
                  count_vendas: data.percentagePix?.[0]?.count_vendas || 0,
                  status: data.percentagePix?.[0]?.status || []
               };

               this.percentageCard2 = {
                  total_vendas: data.percentageCard?.[0]?.total_vendas || 'R$ 0,00',
                  count_vendas: data.percentageCard?.[0]?.count_vendas || 0,
                  status: data.percentageCard?.[0]?.status || []
               };
              
              // Atualizando o gráfico de funil
              if (Array.isArray(data.comportamentoFunnel) && data.comportamentoFunnel.length) {
                  const funnelData = data.comportamentoFunnel[0];
                  this.funnelValues = funnelData.values || [];
                  this.funnelLabels = funnelData.labels || [];
                  this.funnelColors = funnelData.colors || [];
              }
              
              // Atualiza o gráfico de funil com os dados extraídos
              this.updatecomportamentoFunnel();
          })
          .catch(error => console.error('Erro ao buscar dados:', error));
      },
      updateChart() {
          if (window.chart) {
              window.chart.updateOptions({
                  series: this.chartData,
                  xaxis: { categories: this.categories }
              });
          }
      },
      updateInstallmentsChart() {
          if (window.installmentsChart) {
              window.installmentsChart.updateOptions({
                  series: this.installmentsChart.series,
                  labels: this.installmentsChart.labels,
                  colors: this.installmentsChart.colors
              });
          }
      },
      updatecomportamentoFunnel() {
         // Verifica se os dados do funil foram carregados
         if (this.funnelValues.length > 0 && this.funnelLabels.length > 0) {
            // Remove gráfico antigo se já existir
            if (window.funnelGraph) {
                  document.querySelector('.funnel').innerHTML = ''; // Limpa o container
                  window.funnelGraph = null;
            }

            // Cria um novo gráfico de funil com os dados atualizados
            window.funnelGraph = new FunnelGraph({
                  container: '.funnel',
                  gradientDirection: 'vertical',
                  data: {
                     labels: this.funnelLabels,
                     colors: this.funnelColors,
                     values: this.funnelValues
                  },
                  displayPercent: true,
                  direction: 'vertical'
            });

            window.funnelGraph.draw(); // Desenha o gráfico atualizado
         }
      }

  }" x-init="fetchData()" class="flex flex-col gap-10">


     <div class="flex flex-col items-start justify-between gap-5 pt-4 md:flex-row md:items-center">
        <div class="flex flex-col items-start justify-start gap-5">
           <div class="flex flex-col gap-4">
              <div class="flex flex-row items-center gap-2 pl-1">
                 <div class="flex items-center gap-5 text-center flex-wrap">
                    <h1 class="text-title font-bold text-primary">VISÃO GERAL</h1>
                    <p class="text-small text-secondary"></p>
                 </div>
              </div>
              <p class="pl-1 text-regular text-primary">Acompanhe o desempenho do seu e-commerce</p>
           </div>
        </div>
        <div class="flex items-center gap-2 md:gap-6 justify-end">
           <div class="bg-gray-100 p-1 rounded-full flex">
              <template x-for="(label, value) in {today: 'Hoje', yesterday: 'Ontem', week: 'Semana', month: 'Mês'}" :key="value">
                 <label class="cursor-pointer">
                    <input type="radio" class="hidden" x-model="timeFrame" :value="value" @change="customDate = ''; fetchData()">
                    <div class="py-2 px-3 text-sm text-center"
                       :class="timeFrame === value ? 'bg-[#ff0071] text-white rounded' : ''">
                       <span x-text="label"></span>
                    </div>
                 </label>
              </template>
              <!-- Calendário para período personalizado -->
              <label class="cursor-pointer flex items-center px-2">
              <input type="date" x-model="customDate" @change="timeFrame = ''; fetchData()"
                 class="py-2 px-2 bg-gray-100 text-sm border rounded focus:bg-white focus:outline-none focus:ring focus:border-blue-300">
              </label>
           </div>
        </div>
     </div>
     <div class="flex flex-col items-start justify-start gap-4">
        <!-- GRID 3 ITENS INICIO -->
        <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-3">
           <template x-for="card in cards" :key="card.title">
              <div class="flex min-w-max flex-col gap-4 rounded-md border p-4 h-full"
                 :class="card.background">
                 <div class="flex items-center justify-start gap-3">
                    <span class="text-regular" :class="card.background === 'bg-[#222222]' ? 'text-white' : 'text-gray-700'">
                    <span x-text="card.title"></span>
                    </span>
                 </div>
                 <div>
                    <span class="text-subtitle font-bold"
                       :class="card.background === 'bg-[#222222]' ? 'text-white' : 'text-primary'">
                    <span x-text="card.value"></span>
                    </span>
                    <span x-show="card.extra" class="text-subtitle text-primary"
                       x-text="card.extra"></span>
                 </div>
                 <div>
                    <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-sm font-bold rounded-md"
                       :style="'background-color:' + card.percentage_color + '33; color:' + card.percentage_color">
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                          <path fill-rule="evenodd" d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z" clip-rule="evenodd"></path>
                       </svg>
                       <span x-text="card.percentage"></span>
                    </span>
                 </div>
              </div>
           </template>
        </div>
        <!-- GRID 3 ITENS FIM -->
        <!-- CHART DE RECEITA FINANCEIRA INICIO -->
        <div class="flex w-full flex-col items-start justify-center rounded-md border border-gray-300 bg-white p-2 pt-5">
           <p class="pl-2 font-bold text-primary md:pl-6">Resumo Financeiro</p>
           <div class="flex w-full flex-col items-start justify-center gap-4 pt-2 md:p-4" style="max-width: 800%;">
              <div class="w-full">
                 <div id="chart-container" style="width: 100%; height: 300px; border-radius: 12px;"></div>
              </div>
           </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
           document.addEventListener('DOMContentLoaded', function () {
               const options = {
                   chart: {
                       type: 'area',
                       height: 300,
                       fontFamily: "'Inter', -apple-system, BlinkMacSystemFont, sans-serif",
                       background: '#ffffff',
                       toolbar: { show: false },
                       zoom: { enabled: false }
                   },
                   series: [], // Inicializa sem dados
                   xaxis: { categories: [] }, // Inicializa sem categorias
                   dataLabels: { enabled: false },
                   stroke: { width: 2.5, curve: 'smooth' },
                   fill: { type: 'solid', opacity: 0.08 },
                   markers: { size: 0, hover: { size: 6 } },
                   yaxis: {
                       labels: {
                           style: { colors: '#71717a', fontSize: '13px' },
                           formatter: (value) => 'R$ ' + value.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                       },
                       grid: { borderColor: '#f4f4f5' }
                   },
                   grid: { borderColor: '#f4f4f5', xaxis: { lines: { show: false } } },
                   legend: {
                       position: 'top',
                       horizontalAlign: 'center',
                       fontSize: '13px',
                       fontWeight: 400,
                       itemMargin: { horizontal: 32 },
                       markers: { radius: 3, width: 12, height: 12 },
                       labels: { colors: '#3f3f46' }
                   }
               };
           
               window.chart = new ApexCharts(document.querySelector("#chart-container"), options);
               window.chart.render();
           });
        </script>
        <style>
           .apexcharts-legend-marker {
           width: 12px !important;
           height: 12px !important;
           }
        </style>
        <!-- CHART DE RECEITA FINANCEIRA FIM -->
        <!-- GRID 3 ITENS FIM -->
        <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-3">
           <template x-for="card in cards02" :key="card.title">
              <div class="flex min-w-max flex-col gap-4 rounded-md border p-4 h-full"
                 :class="card.background">
                 <div class="flex items-center justify-start gap-3">
                    <span class="text-regular" :class="card.background === 'bg-[#222222]' ? 'text-white' : 'text-gray-700'">
                    <span x-text="card.title"></span>
                    </span>
                 </div>
                 <div>
                    <span class="text-subtitle font-bold"
                       :class="card.background === 'bg-[#222222]' ? 'text-white' : 'text-primary'">
                    <span x-text="card.value"></span>
                    </span>
                    <span x-show="card.extra" class="text-subtitle text-primary"
                       x-text="card.extra"></span>
                 </div>
                 <div>
                    <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-small font-bold"
                       :style="'background-color:' + card.percentage_color + '33; color:' + card.percentage_color">
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                          <path fill-rule="evenodd" d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z" clip-rule="evenodd"></path>
                       </svg>
                       <span x-text="card.percentage"></span>
                    </span>
                 </div>
              </div>
           </template>
        </div>
        <!-- GRID 3 ITENS FIM -->
        <!-- GRID 3 ITENS INICIO -->
        <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-3">
           <template x-for="card in cards03" :key="card.title">
              <div class="flex min-w-max flex-col gap-4 rounded-md border p-4 h-full"
                 :class="card.background">
                 <div class="flex items-center justify-start gap-3">
                    <span class="text-regular" :class="card.background === 'bg-[#222222]' ? 'text-white' : 'text-gray-700'">
                    <span x-text="card.title"></span>
                    </span>
                 </div>
                 <div>
                    <span class="text-subtitle font-bold"
                       :class="card.background === 'bg-[#222222]' ? 'text-white' : 'text-primary'">
                    <span x-text="card.value"></span>
                    </span>
                    <span x-show="card.extra" class="text-subtitle text-primary"
                       x-text="card.extra"></span>
                 </div>
                 <div>
                    <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-small font-bold"
                       :style="'background-color:' + card.percentage_color + '33; color:' + card.percentage_color">
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                          <path fill-rule="evenodd" d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z" clip-rule="evenodd"></path>
                       </svg>
                       <span x-text="card.percentage"></span>
                    </span>
                 </div>
              </div>
           </template>
        </div>
        <!-- GRID 3 ITENS FIM -->

        <!-- GRID 3 ITENS + CHART INICIO -->
        <div class="w-full">
           <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
              <div class="col-span-1 grid w-full grid-cols-1 gap-4 sm:grid-cols-2 md:col-span-2 lg:grid-cols-3">
                 <template x-for="card in cards04" :key="card.title">
                    <div class="flex flex-col gap-4 rounded-md border border-gray-200 bg-white p-4">
                       <div class="flex items-center justify-start gap-3">
                          <span class="text-regular text-primary" x-text="card.title"></span>
                       </div>
                       <div>
                          <span class="text-subtitle font-bold text-primary" x-text="card.value"></span>
                       </div>
                       <div>
                          <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-small font-bold rounded" 
                          :style="'background-color:' + card.percentage_color + '33; color:' + card.percentage_color">
                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z" clip-rule="evenodd"></path>
                             </svg>
                             <span x-text="card.percentage"></span>
                          </span>
                       </div>
                    </div>
                 </template>
              </div>
              <div class="w-full">
                 <div class="flex min-w-max flex-col items-center justify-between gap-4 rounded-md border border-shadowColor-100 bg-white p-6 h-full w-full self-stretch">
                    <div class="flex w-full flex-row items-center justify-between gap-2">
                       <div class="flex items-center justify-start gap-3">
                          <span class="text-subtitle text-primary" x-text="metaData.metaTitulo"></span>
                       </div>
                       <span class="cursor-pointer text-regular text-primary underline" x-text="metaData.editarTexto"></span>
                    </div>
                    <div class="flex flex-col items-center justify-center p-4 w-full bg-white rounded-lg shadow-sm">
                       <!-- Gráfico Circular -->
                       <div class="relative w-32 h-32 mb-4">
                          <svg class="transform -rotate-90 w-full h-full" viewBox="0 0 100 100">
                             <!-- Fundo do círculo -->
                             <circle cx="50" cy="50" r="45" class="fill-none stroke-gray-200" stroke-width="8"/>
                             <!-- Progresso -->
                             <circle cx="50" cy="50" r="45" class="fill-none stroke-[#ff0983]" stroke-width="8"
                                stroke-dasharray="282.6"  
                                :stroke-dashoffset="282.6 * (1 - (metaData.progresso / 100))"
                                stroke-linecap="round"
                                style="transition: stroke-dashoffset 0.5s ease-out;"/>
                          </svg>
                          <!-- Texto central -->
                          <div class="absolute inset-0 flex flex-col items-center justify-center">
                             <span class="text-2xl font-bold text-gray-800" x-text="metaData.progresso + '%'"></span>
                          </div>
                       </div>
                       <div class="flex w-full flex-row items-center justify-between gap-2">
                          <div class="flex flex-col gap-2">
                             <span class="text-subtitle text-primary">Atual</span>
                             <span class="text-subtitle font-bold text-primary" x-text="metaData.valorAtual"></span>
                          </div>
                          <div class="flex flex-col gap-2">
                             <span class="text-regular text-primary">Meta</span>
                             <span class="text-subtitle font-bold text-primary" x-text="metaData.metaTotal"></span>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
           <!-- GRID 3 + CHART FIM -->
           <!-- GRID DE DADOS + CHART INICIO -->
           <div class="grid w-full grid-cols-1 gap-4 pt-4 lg:grid-cols-2">
              <div class="flex h-full flex-col gap-4">
                 <!-- DESIGN DE COMPORTAMENTO DO CLIENTE INICIO -->
                 <div class="flex w-full flex-col gap-6 rounded-md border border-gray-200 bg-white p-5 py-10 md:py-5">
                    <div class="flex justify-between items-center">
                       <span class="text-regular">Comportamento do Cliente</span>
                       <div class="rounded-md bg-neutral-100 p-2 text-neutral-500">
                          <div class="text-regular">10 minutos</div>
                       </div>
                    </div>
                    <div class="flex flex-col h-full w-full gap-6">
                     <div class="relative w-full flex justify-between items-center">
                         <div class="absolute left-0 right-0 h-[2px] bg-gray-200"></div>
                         <div class="absolute left-0 h-[2px] bg-[#ff0983] transition-all duration-300 z-30"
                             :style="'width: ' + comportamento10Min.progresso + '%'"></div>
                             <template x-for="(etapa, index) in comportamento10Min.etaps" :key="index">
                              <div class="flex flex-col items-center">
                                  <div class="relative h-7 w-7 rounded-full z-50"
                                       :class="etapa.valor > 0 ? 'bg-[#ff0983]' : 'bg-gray-200'">
                                      <!-- Animação de Ping -->
                                      <div x-show="etapa.valor > 0"
                                           class="absolute inset-0 rounded-full border-2 border-[#ff0983] animate-[ping_1.5s_ease-in-out_infinite]">
                                      </div>
                                  </div>
                              </div>
                          </template>                          
                     </div>
                       
                       <!-- Legendas -->
                       <div class="w-full flex justify-between items-center text-center">
                           <template x-for="(etapa, index) in comportamento10Min.etaps" :key="index">
                              <div class="w-[50px]">
                                 <span class="text-md font-bold" x-text="etapa.valor"></span>
                                 <p class="text-xs" x-text="etapa.nome"></p>
                              </div>
                        </template>
                       </div>

                    </div>
                 </div>
                 <!-- DESIGN DE COMPORTAMENTO DO CLIENTE FIM -->


                 <!-- CHART FUNIL INICIO -->
                 <div class="h-full w-full rounded-md border border-gray-200 bg-white p-6 lg:pr-6">
                    <p class="mb-4 font-bold text-black text-xl">Funil de Conversão</p>
                    <div class="flex justify-center w-full">
                       <div id="funnelChart" class="w-full funnel" style="height: 800px;"></div>
                    </div>
                    <style>
                       .svg-funnel-js__container {
                       max-width: 450px;
                       }
                       .svg-funnel-js {
                       display: flex !important;
                       justify-content: center !important;
                       }
                    </style>
                    <link rel="stylesheet" href="https://unpkg.com/funnel-graph-js@1.3.9/dist/css/main.min.css">
                    <link rel="stylesheet" href="https://unpkg.com/funnel-graph-js@1.3.9/dist/css/theme.min.css">
                    <script src="https://unpkg.com/funnel-graph-js@1.3.9/dist/js/funnel-graph.min.js"></script>
                    <style>
                       .label__value {
                       color: black !important;
                       }
                       .label__title {
                       color: #ff0983 !important;
                       }
                    </style>
                 </div>
                 <!-- CHART FUNIL fim -->
              </div>
              <!-- GRID DE DADOS + CHART FIM -->
              <!-- GRID DE DADOS + CHART 2.0 INICIO -->
              <div class="flex flex-col gap-4">
                 <div class="mb-2 flex w-full flex-col items-start justify-start gap-4">
                    <!-- PERCENTAGE BAR 1.0 INICIO -->
                     <div id="percentage-bar" class="flex items-center justify-start rounded border border-shadowColor-100 p-6 bg-white el-tooltip__trigger el-tooltip__trigger" style="width: 100%; height: 160px;">
                        <template x-for="(item, index) in percentageMethods" :key="index">
                           <div class="value-container flex w-full min-w-fit flex-col items-start justify-between self-stretch">
                              <span class="text-regular text-primary" x-text="item.nome"></span>
                              <div>
                                    <span class="text-regular font-bold text-primary" x-text="item.valor + '%'"></span>
                              </div>
                              <div class="bar min-h-6 w-full px-4 py-1 text-regular text-background hover:opacity-70 el-tooltip__trigger el-tooltip__trigger text-white"
                                    :class="{
                                       'rounded-l-lg': index === 0, 
                                       'rounded-r-lg': index === percentageMethods.length - 1
                                    }"
                                    :style="'background-color:' + item.cor"
                                    x-text="item.valor + '%'">
                              </div>
                           </div>
                        </template>
                  </div>                 
                    <!-- PERCENTAGE BAR 1.0 FIM -->

                    <!-- PERCENTAGE BAR 2.0 INICIO -->
                    <div id="percentage-bar" class="flex flex-col items-start justify-start rounded border border-shadowColor-100 p-6 bg-white" style="width: 100%; height: 160px;">
        
                     <!-- Título e valores do Pix -->
                     <div class="value-container w-full flex flex-col items-start justify-between self-stretch">
                        <span class="text-regular text-primary">Cartão De Crédito</span>
                        <div>
                          <span x-text="percentageCard2.total_vendas" class="text-regular font-bold text-primary"></span>
                          <span x-text="`(${percentageCard2.count_vendas})`" class="text-subtitle text-primary font-medium ml-1"></span>
                      </div>  
                    </div>
             
                     <!-- Contêiner das barras -->
                     <div class="flex w-full mt-4">
                        <template x-for="(item, index) in percentageCard" :key="index">
                            <div class="bar min-h-6 px-4 py-1 text-regular text-white hover:opacity-70 w-full"
                                :class="{
                                    'rounded-l-lg': index === 0, 
                                    'rounded-r-lg': index === percentageCard.length - 1
                                }"
                                :style="'background-color:' + (index === 0 ? '#ff0983' : index === 1 ? '#C3C1C1' : '#D1D1D1')"
                                x-text="item.valor + '%'">
                            </div>
                        </template>
                    </div>                    
   
                 </div>
                    <!-- PERCENTAGE BAR 2.0 FIM -->

                    <!-- PERCENTAGE BAR 3.0 INICIO -->
                  <div id="percentage-bar" class="flex flex-col items-start justify-start rounded border border-shadowColor-100 p-6 bg-white" style="width: 100%; height: 160px;">
        
                     <!-- Título e valores do Pix -->
                     <div class="value-container w-full flex flex-col items-start justify-between self-stretch">
                         <span class="text-regular text-primary">Pix</span>
                         <div>
                           <span x-text="percentagePix2.total_vendas" class="text-regular font-bold text-primary"></span>
                           <span x-text="`(${percentagePix2.count_vendas})`" class="text-subtitle text-primary font-medium ml-1"></span>
                       </div>  
                     </div>
             
                     <!-- Contêiner das barras -->
                     <div class="flex w-full mt-4">
                        <template x-for="(item, index) in percentagePix" :key="index">
                            <div class="bar min-h-6 px-4 py-1 text-regular text-white hover:opacity-70 w-full"
                                :class="{
                                    'rounded-l-lg': index === 0, 
                                    'rounded-r-lg': index === percentagePix.length - 1
                                }"
                                :style="'background-color:' + (index === 0 ? '#ff0983' : index === 1 ? '#C3C1C1' : '#D1D1D1')"
                                x-text="item.valor + '%'">
                            </div>
                        </template>
                    </div>                    
   
                 </div>
                    <!-- PERCENTAGE BAR 3.0 FIM -->

                    <!-- PERCENTAGE BAR 4.0 INICIO -->
                    <div id="percentage-bar" class="flex items-center justify-start rounded border border-shadowColor-100 p-6 bg-white" style="width: 100%; height: 160px;">
                       <div class="value-container flex w-full min-w-fit flex-col items-start justify-between self-stretch">
                          <span class="text-regular text-primary">Boleto</span>
                          <div>
                             <!---->
                             <span class="text-regular font-bold text-primary">R$ 0,00 <span class="text-subtitle text-primary font-medium"> (0) </span>
                             </span>
                          </div>
                          <div class="bar min-h-6 w-full px-4 py-1 text-regular text-background hover:opacity-70 el-tooltip__trigger el-tooltip__trigger bg-[#ff0983] text-white rounded-l-lg">0% </div>
                       </div>
                       <div class="value-container flex w-full min-w-fit flex-col items-start justify-between self-stretch">
                          <span class="text-regular text-primary"></span>
                          <!---->
                          <div class="bar min-h-6 w-full px-4 py-1 text-regular text-background hover:opacity-70 el-tooltip__trigger el-tooltip__trigger text-white" style="background-color: rgb(195, 193, 193);">0% </div>
                       </div>
                       <div class="value-container flex w-full min-w-fit flex-col items-start justify-between self-stretch">
                          <span class="text-regular text-primary"></span>
                          <!---->
                          <div class="bar min-h-6 w-full px-4 py-1 text-regular text-background hover:opacity-70 el-tooltip__trigger el-tooltip__trigger text-white rounded-r-lg" style="background-color: rgb(209, 209, 209);">0% </div>
                       </div>
                       <!---->
                    </div>
                    <!-- PERCENTAGE BAR 4.0 FIM -->
                 </div>
                 <!-- GRID DE DADOS + CHART 2.0 FIM -->
                 <!-- CHART PARCELAMENTO INCIO -->
                 <div class="min-h-[300px] max-h-[700px] h-full w-full self-stretch rounded-md border border-shadowColor-100 bg-white lg:w-full">
                    <div class="flex w-full flex-col items-start justify-center gap-4 p-4 h-full">
                       <div class="min-h-[300px] w-full rounded-md">
                          <div id="parcelamento-chart"></div>
                       </div>
                       <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                       <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            window.installmentsChart = new ApexCharts(document.querySelector("#parcelamento-chart"), {
                                chart: {
                                    type: 'donut',
                                    height: 300,
                                    fontFamily: "'Inter', sans-serif",
                                    background: 'transparent'
                                },
                                series: [],
                                labels: [],
                                colors: [],
                                dataLabels: {
                                    enabled: true,
                                    formatter: (val) => `${val.toFixed(0)}%`,
                                    style: {
                                        fontSize: '13px',
                                        colors: ['#ffffff']
                                    }
                                },
                                plotOptions: {
                                    pie: {
                                        donut: {
                                            size: '65%',
                                            labels: {
                                                show: true,
                                                total: {
                                                    show: true,
                                                    label: 'Parcelamento',
                                                    color: '#3f3f46',
                                                    fontSize: '14px',
                                                    formatter: () => 'Total'
                                                },
                                                value: {
                                                    color: '#18181b',
                                                    fontSize: '20px',
                                                    fontWeight: 600
                                                }
                                            }
                                        }
                                    }
                                },
                                stroke: {
                                    width: 1,
                                    colors: ['#ffffff']
                                },
                                legend: {
                                    position: 'bottom',
                                    horizontalAlign: 'center',
                                    fontSize: '13px',
                                    markers: {
                                        width: 12,
                                        height: 12,
                                        radius: 3
                                    },
                                    itemMargin: {
                                        horizontal: 15,
                                        vertical: 5
                                    }
                                },
                                tooltip: {
                                    y: {
                                        formatter: (value) => `${value}%`
                                    }
                                }
                            });
                        
                            window.installmentsChart.render();
                        });
                        </script>                 
                       <style>
                          .apexcharts-legend-text {
                          color: #3f3f46 !important;
                          font-weight: 400;
                          }
                       </style>
                    </div>
                 </div>
                 <!-- CHART PARCELAMENTO FIM -->
              </div>
           </div>
        </div>
     </div>
     <div class="pt-8"></div>
  </div>
  </div>
</x-app-layout>