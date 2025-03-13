<x-app-layout>
 
      <div class="flex flex-col px-2 pt-3 h-max xl:overflow-hidden">
            <!---->
            <!---->
            <div class="flex flex-col gap-10">
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
                            <div class="hidden md:block cursor-pointer">
                                <span class="h-5 w-5 select-none rounded-full bg-shadowColor-400 text-center text-regular text-background">
                                    <svg class="" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22.5 12C22.5 17.52 18.02 22 12.5 22C6.98 22 3.61 16.44 3.61 16.44M3.61 16.44H8.13M3.61 16.44V21.44M2.5 12C2.5 6.48 6.94 2 12.5 2C19.17 2 22.5 7.56 22.5 7.56M22.5 7.56V2.56M22.5 7.56H18.06" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </div>
                            <div>
                                <div class="flex items-center justify-center gap-3">
                                    <div class="bg-gray-100 p-1 rounded-full flex">
                                        <label class="cursor-pointer">
                                            <input class="hidden" type="radio" name="time-frame" id="today">
                                            <div class="py-1 px-3 text-sm text-center">Hoje</div>
                                        </label>
                                        <label class="cursor-pointer">
                                            <input class="hidden" type="radio" name="time-frame" id="yesterday">
                                            <div class="py-1 px-3 text-sm text-center">Ontem</div>
                                        </label>
                                        <label class="cursor-pointer">
                                            <input class="hidden" type="radio" name="time-frame" id="week">
                                            <div class="py-1 px-3 text-sm text-center">Semana</div>
                                        </label>
                                        <label class="cursor-pointer">
                                            <input class="hidden" type="radio" name="time-frame" id="month">
                                            <div class="py-1 px-3 text-sm text-center">Mês</div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
              <div class="flex flex-col items-start justify-start gap-4">
                
                  <!-- GRID 3 ITENS INICIO -->

                  <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-3">
                        <div class="flex min-w-max flex-col gap-4 rounded-md border bg-white p-4 h-full">
                          <div class="flex items-center justify-start gap-3">
                            <span class="text-regular text-gray-700">Receita líquida</span>
                          </div>
                          <div>
                            <span class="text-subtitle font-bold text-primary">R$ 2.677,58</span>
                            <span class="text-subtitle text-primary"> (18) </span>
                          </div>
                          <div>
                            <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-sm rounded-md font-bold bg-[#4a9f0c33] bg-opacity-50 text-[#4a9f0c]">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z" clip-rule="evenodd"></path>
                              </svg>
                              2.60%
                            </span>
                          </div>
                        </div>
                        
                        <div class="flex min-w-max flex-col gap-4 rounded-md border border-shadowColor-100 bg-uncontrastColor dark:bg-[#222222] p-4 h-full">
                          <div class="flex items-center justify-start gap-3">
                            <span class="text-regular text-white">Lucro Liquido</span>
                          </div>
                          <div>
                            <span class="text-subtitle font-bold text-white">R$ 1.353,36</span>
                          </div>
                          <div>
                            <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-sm font-bold bg-[#4a9f0c33] bg-opacity-50 text-[#4a9f0c]">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z" clip-rule="evenodd"></path>
                              </svg>
                              7.74%
                            </span>
                          </div>
                        </div>
                      
                        <div class="flex flex-col gap-4 p-4 border rounded-md min-w-max bg-white border-shadowColor-100 h-full">
                          <div class="flex items-center justify-between">
                            <div class="flex items-center justify-start gap-3">
                              <span class="text-regular text-primary">Marketings</span>
                              <span class="w-5 h-5 text-center rounded-full bg-gray-400 text-white">i</span>
                            </div>
                            <div class="p-1 rounded-full cursor-pointer bg-highlighted-200 hover:opacity-50">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-highlighted">
                                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd"></path>
                              </svg>
                            </div>
                          </div>
                          <div>
                            <span class="font-bold text-subtitle text-primary">R$ 0,00</span>
                          </div>
                          <div>
                            <span class="flex items-center justify-start gap-2 p-1 font-bold text-sm max-w-fit text-gray-600 bg-gray-200">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M4.25 12a.75.75 0 0 1 .75-.75h14a.75.75 0 0 1 0 1.5H5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd"></path>
                              </svg>
                              0%
                            </span>
                          </div>
                        </div>
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
                    series: [
                      {
                        name: 'Lucro Líquido',
                        data: [0, 300, 600, 1200, 1800, 2400, 3000],
                        color: '#f6339a'
                      },
                      {
                        name: 'Taxas e Impostos',
                        data: [0, 0, 0, 0, 0, 0, 0],
                        color: '#00bcff'
                      },
                      {
                        name: 'Marketing',
                        data: [0, 0, 0, 0, 0, 0, 0],
                        color: '#f59e0b'
                      },
                      {
                        name: 'Custo de Produtos',
                        data: [0, 0, 0, 0, 0, 0, 0],
                        color: '#22c55e'
                      },
                      {
                        name: 'Receita Líquida',
                        data: [1200, 1300, 0, 200, 0, 0, 0],
                        color: '#8b5cf6'
                      }
                    ],
                    dataLabels: { enabled: false },
                    stroke: {
                      width: 2.5,
                      curve: 'smooth'
                    },
                    fill: {
                      type: 'solid',
                      opacity: 0.08
                    },
                    markers: {
                      size: 0,
                      hover: { size: 6 }
                    },
                    xaxis: {
                      categories: ['03/02', '04/02', '05/02', '06/02', '07/02', '08/02', '09/02'],
                      axisBorder: { color: '#e4e4e7' },
                      axisTicks: { show: false },
                      labels: {
                        style: {
                          colors: '#52525b',
                          fontSize: '13px',
                          fontWeight: 400
                        }
                      }
                    },
                    yaxis: {
                      labels: {
                        style: {
                          colors: '#71717a',
                          fontSize: '13px'
                        },
                        formatter: (value) => 'R$ ' + value.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                      },
                      grid: { borderColor: '#f4f4f5' }
                    },
                    grid: {
                      borderColor: '#f4f4f5',
                      xaxis: { lines: { show: false } }
                    },
                    tooltip: {
                      custom: ({ series, seriesIndex, dataPointIndex }) => {
                        const colors = ['#3b82f6', '#ef4444', '#22c55e', '#f59e0b', '#8b5cf6']
                        return `
                          <div class="apexcharts-tooltip" style="background: #ffffff; border: 1px solid #e4e4e7; border-radius: 8px; padding: 12px;">
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                              <div style="width: 12px; height: 12px; border-radius: 3px; background: ${colors[seriesIndex]};"></div>
                              <span style="font-weight: 500; color: #3f3f46;">${options.series[seriesIndex].name}</span>
                            </div>
                            <div style="font-size: 16px; font-weight: 600; color: #18181b;">
                              R$ ${series[seriesIndex][dataPointIndex].toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".")}
                            </div>
                          </div>
                        `
                      }
                    },
                    legend: {
                      position: 'top',
                      horizontalAlign: 'center',
                      fontSize: '13px',
                      fontWeight: 400,
                      itemMargin: { horizontal: 32 },
                      markers: {
                        radius: 3,
                        width: 12,
                        height: 12
                      },
                      labels: { colors: '#3f3f46' }
                    }
                  }
              
                  const chart = new ApexCharts(document.querySelector("#chart-container"), options)
                  chart.render()
                })
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
                  <div class="flex min-w-max flex-col gap-4 rounded-md border border-shadowColor-100 bg-white p-4 min-w-0">
                    <div class="flex items-center justify-start gap-3">
                      <span class="text-regular text-primary">Pedidos Aprovados</span>
                    </div>
                    <div>
                      <span class="text-subtitle font-bold text-primary">R$ 1.388,08</span>
                      <span class="text-subtitle text-primary"> (9) </span>
                    </div>
                    <div>
                      <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-small font-bold bg-[#4a9f0c33] bg-opacity-50 text-[#4a9f0c]">
                        <div>
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="h-5 w-5">
                            <path fill-rule="evenodd" d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z" clip-rule="evenodd"></path>
                          </svg>
                        </div> 7.74%
                      </span>
                    </div>
                  </div>
                
                  <div class="flex min-w-max flex-col gap-4 rounded-md border border-shadowColor-100 bg-white p-4 min-w-0">
                    <div class="flex items-center justify-start gap-3">
                      <span class="text-regular text-primary">Pedidos Pendentes</span>
                    </div>
                    <div>
                      <span class="text-subtitle font-bold text-primary">R$ 1.169,58</span>
                      <span class="text-subtitle text-primary"> (8) </span>
                    </div>
                    <div>
                      <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-small font-bold bg-[#4a9f0c33] bg-opacity-50 text-[#4a9f0c]">
                        <div>
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="h-5 w-5">
                            <path fill-rule="evenodd" d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z" clip-rule="evenodd"></path>
                          </svg>
                        </div> 67.12%
                      </span>
                    </div>
                  </div>
                
                  <div class="flex min-w-max flex-col gap-4 rounded-md border border-shadowColor-100 bg-white p-4 min-w-0">
                    <div class="flex items-center justify-start gap-3">
                      <span class="text-regular text-primary">Compra 1-Click</span>
                    </div>
                    <div>
                      <span class="text-subtitle font-bold text-primary">R$ 0,00</span>
                      <span class="text-subtitle text-primary"> (0) </span>
                    </div>
                    <div>
                      <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-small font-bold bg-gray-200 text-gray-600">
                        <div>
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="h-5 w-5">
                            <path fill-rule="evenodd" d="M4.25 12a.75.75 0 0 1 .75-.75h14a.75.75 0 0 1 0 1.5H5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd"></path>
                          </svg>
                        </div> 0%
                      </span>
                    </div>
                  </div>
                </div>                

            <!-- GRID 3 ITENS FIM -->

            <!-- GRID 3 ITENS INICIO -->
               
            <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-3">
                  <div class="flex min-w-max flex-col gap-4 rounded-md border bg-white p-4 min-w-0">
                    <div class="flex items-center justify-start gap-3">
                      <span class="text-regular text-primary">Recuperados</span>
                    </div>
                    <div>
                      <span class="text-subtitle font-bold text-primary">R$ 630,08</span>
                      <span class="text-subtitle text-primary"> (5) </span>
                    </div>
                    <div>
                      <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-small font-bold bg-[#d92d2033] bg-opacity-50 text-[#d92d20]">
                        <div>
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="h-5 w-5">
                            <path fill-rule="evenodd" d="M1.72 5.47a.75.75 0 0 1 1.06 0L9 11.69l3.756-3.756a.75.75 0 0 1 .985-.066 12.698 12.698 0 0 1 4.575 6.832l.308 1.149 2.277-3.943a.75.75 0 1 1 1.299.75l-3.182 5.51a.75.75 0 0 1-1.025.275l-5.511-3.181a.75.75 0 0 1 .75-1.3l3.943 2.277-.308-1.149a11.194 11.194 0 0 0-3.528-5.617l-3.809 3.81a.75.75 0 0 1-1.06 0L1.72 6.53a.75.75 0 0 1 0-1.061Z" clip-rule="evenodd"></path>
                          </svg>
                        </div> -28.11%
                      </span>
                    </div>
                  </div>
                  <div class="flex min-w-max flex-col gap-4 rounded-md border bg-white p-4 min-w-0">
                    <div class="flex items-center justify-start gap-3">
                      <span class="text-regular text-primary">Order Bump</span>
                    </div>
                    <div>
                      <span class="text-subtitle font-bold text-primary">R$ 223,94</span>
                      <span class="text-subtitle text-primary"> (1) </span>
                    </div>
                    <div>
                      <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-small font-bold bg-[#4a9f0c33] bg-opacity-50 text-[#4a9f0c]">
                        <div>
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="h-5 w-5">
                            <path fill-rule="evenodd" d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z" clip-rule="evenodd"></path>
                          </svg>
                        </div> 100%
                      </span>
                    </div>
                  </div>
                  <div class="flex min-w-max flex-col gap-4 rounded-md border bg-white p-4 min-w-0">
                    <div class="flex items-center justify-start gap-3">
                      <span class="text-regular text-primary">Upsell</span>
                    </div>
                    <div>
                      <span class="text-subtitle font-bold text-primary">R$ 0,00</span>
                      <span class="text-subtitle text-primary"> (0) </span>
                    </div>
                    <div>
                      <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-small font-bold bg-gray-200 text-gray-600">
                        <div>
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="h-5 w-5">
                            <path fill-rule="evenodd" d="M4.25 12a.75.75 0 0 1 .75-.75h14a.75.75 0 0 1 0 1.5H5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd"></path>
                          </svg>
                        </div> 0%
                      </span>
                    </div>
                  </div>
                </div>
                

            <!-- GRID 3 ITENS FIM -->

            <!-- GRID 3 ITENS + CHART INICIO -->

                <div class="w-full">
                  <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div class="col-span-1 grid w-full grid-cols-1 gap-4 sm:grid-cols-2 md:col-span-2 lg:grid-cols-3">
                      <div class="flex min-w-max flex-col gap-4 rounded-md border border-shadowColor-100 bg-white p-4 min-w-0">
                        <div class="flex items-center justify-start gap-3">
                          <span class="text-regular text-primary">Margem de Lucro</span>
                          <!---->
                        </div>
                        <div>
                          <span class="text-subtitle font-bold text-primary">50.54%</span>
                          <!---->
                        </div>
                        <div>
                          <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-small font-bold bg-[#4a9f0c33] bg-opacity-50 text-[#4a9f0c]">
                            <div>
                              <!---->
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z" clip-rule="evenodd"></path>
                              </svg>
                              <!---->
                            </div> 5.00%
                          </span>
                        </div>
                      </div>
                      <div class="flex min-w-max flex-col gap-4 rounded-md border border-shadowColor-100 bg-white p-4 min-w-0">
                        <div class="flex items-center justify-start gap-3">
                          <span class="text-regular text-primary">Ticket Médio</span>
                          <!---->
                        </div>
                        <div>
                          <span class="text-subtitle font-bold text-primary">R$ 148,75</span>
                          <!---->
                        </div>
                        <div>
                          <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-small font-bold bg-[#4a9f0c33] bg-opacity-50 text-[#4a9f0c]">
                            <div>
                              <!---->
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z" clip-rule="evenodd"></path>
                              </svg>
                              <!---->
                            </div> 8.31%
                          </span>
                        </div>
                      </div>
                      <div class="flex min-w-max flex-col gap-4 rounded-md border border-shadowColor-100 bg-white p-4 min-w-0">
                        <div class="flex items-center justify-start gap-3">
                          <span class="text-regular text-primary">Taxas e Impostos</span>
                          <span class="h-5 w-5 select-none rounded-full bg-shadowColor-400 text-center text-regular text-background el-tooltip__trigger el-tooltip__trigger">i</span>
                        </div>
                        <div>
                          <span class="text-subtitle font-bold text-primary">R$ 139,03</span>
                          <!---->
                        </div>
                        <div>
                          <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-small font-bold bg-[#d92d2033] bg-opacity-50 text-[#d92d20]">
                            <div>
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M1.72 5.47a.75.75 0 0 1 1.06 0L9 11.69l3.756-3.756a.75.75 0 0 1 .985-.066 12.698 12.698 0 0 1 4.575 6.832l.308 1.149 2.277-3.943a.75.75 0 1 1 1.299.75l-3.182 5.51a.75.75 0 0 1-1.025.275l-5.511-3.181a.75.75 0 0 1 .75-1.3l3.943 2.277-.308-1.149a11.194 11.194 0 0 0-3.528-5.617l-3.809 3.81a.75.75 0 0 1-1.06 0L1.72 6.53a.75.75 0 0 1 0-1.061Z" clip-rule="evenodd"></path>
                              </svg>
                              <!---->
                              <!---->
                            </div> -4.85%
                          </span>
                        </div>
                      </div>
                      <div class="flex min-w-max flex-col gap-4 rounded-md border border-shadowColor-100 bg-white p-4 min-w-0">
                        <div class="flex items-center justify-start gap-3">
                          <span class="text-regular text-primary">Custo de Produtos</span>
                          <!---->
                        </div>
                        <div>
                          <span class="text-subtitle font-bold text-primary">R$ 0,00</span>
                          <!---->
                        </div>
                        <div>
                          <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-small font-bold bg-gray-200 text-gray-600">
                            <div>
                              <!---->
                              <!---->
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M4.25 12a.75.75 0 0 1 .75-.75h14a.75.75 0 0 1 0 1.5H5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd"></path>
                              </svg>
                            </div> 0%
                          </span>
                        </div>
                      </div>
                      <div class="flex min-w-max flex-col gap-4 rounded-md border border-shadowColor-100 bg-white p-4 min-w-0">
                        <div class="flex items-center justify-start gap-3">
                          <span class="text-regular text-primary">CPA</span>
                          <!---->
                        </div>
                        <div>
                          <span class="text-subtitle font-bold text-primary">R$ 0,00</span>
                          <!---->
                        </div>
                        <div>
                          <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-small font-bold bg-gray-200 text-gray-600">
                            <div>
                              <!---->
                              <!---->
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M4.25 12a.75.75 0 0 1 .75-.75h14a.75.75 0 0 1 0 1.5H5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd"></path>
                              </svg>
                            </div> 0%
                          </span>
                        </div>
                      </div>
                      <div class="flex min-w-max flex-col gap-4 rounded-md border border-shadowColor-100 bg-white p-4 min-w-0">
                        <div class="flex items-center justify-start gap-3">
                          <span class="text-regular text-primary">ROI</span>
                          <!---->
                        </div>
                        <div>
                          <span class="text-subtitle font-bold text-primary">0.00</span>
                          <!---->
                        </div>
                        <div>
                          <span class="flex max-w-fit items-center justify-start gap-2 p-1 text-small font-bold bg-gray-200 text-gray-600">
                            <div>
                              <!---->
                              <!---->
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M4.25 12a.75.75 0 0 1 .75-.75h14a.75.75 0 0 1 0 1.5H5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd"></path>
                              </svg>
                            </div> 0%
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="w-full">
                      <div class="flex min-w-max flex-col items-center justify-between gap-4 rounded-md border border-shadowColor-100 bg-white p-6 h-full w-full self-stretch">
                        <div class="flex w-full flex-row items-center justify-between gap-2">
                          <div class="flex items-center justify-start gap-3">
                            <span class="text-subtitle text-primary">Minha Meta</span>
                            <!---->
                          </div>
                          <span class="cursor-pointer text-regular text-primary underline">Editar Meta</span>
                        </div>
                        <div class="flex flex-col items-center justify-center p-4 w-full bg-white rounded-lg shadow-sm">
                              <!-- Gráfico Circular -->
                              <div class="relative w-32 h-32 mb-4">
                                    <svg class="transform -rotate-90 w-full h-full" viewBox="0 0 100 100">
                                          <!-- Fundo do círculo -->
                                          <circle cx="50" cy="50" r="45" 
                                                  class="fill-none stroke-gray-200" 
                                                  stroke-width="8"/>
                                      
                                          <!-- Progresso -->
                                          <circle cx="50" cy="50" r="45" 
                                                  class="fill-none stroke-[#ff0983]" 
                                                  stroke-width="8"
                                                  stroke-dasharray="282.6"  
                                                  stroke-dashoffset="calc(282.6 * (1 - 0.80))" 
                                                  stroke-linecap="round"
                                                  style="transition: stroke-dashoffset 0.5s ease-out;"/>
                                      </svg>                                      
                                  <!-- Texto central -->
                                  <div class="absolute inset-0 flex flex-col items-center justify-center">
                                      <span class="text-2xl font-bold text-gray-800">100%</span>
                                  </div>
                              </div>
                        <div class="flex w-full flex-row items-center justify-between gap-2">
                          <div class="flex flex-col gap-2">
                            <span class="text-subtitle text-primary">Atual</span>
                            <span class="text-subtitle font-bold text-primary">R$ 2.677,58</span>
                          </div>
                          <div class="flex flex-col gap-2">
                            <span class="text-regular text-primary">Meta</span>
                            <span class="text-subtitle font-bold text-primary">R$ 0,00</span>
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
                              <!-- Linha de progresso com bolinhas -->
                              <div class="relative w-full flex justify-between items-center">
                                <!-- Linha de fundo -->
                                <div class="absolute left-0 right-0 h-[2px] bg-gray-200"></div>
                                
                                <!-- Linha de progresso (ajustar width conforme progresso) -->
                                <div class="absolute left-0 h-[2px] bg-[#ff0983] transition-all duration-300" style="width: 25%"></div>
                                
                                <!-- Bolinhas -->
                                <div class="relative z-10 flex w-full justify-between">
                                  <!-- Etapa Ativa -->
                                  <div class="flex flex-col items-center">
                                    <div class="relative h-7 w-7">
                                      <!-- Bolinha principal -->
                                      <div class="h-full w-full rounded-full bg-[#ff0983] flex items-center justify-center"></div>
                                      
                                      <!-- Efeito de ping ajustado -->
                                      <div class="absolute inset-0 rounded-full animate-[ping_1.5s_ease-in-out_infinite] border-2 border-[#ff0983]"></div>
                                    </div>
                                  </div>
                            
                                    <!-- Etapas seguintes (repetir 4x) -->
                                    <div class="flex flex-col items-center">
                                          <div class="h-7 w-7 rounded-full bg-gray-200 flex items-center justify-center"></div>
                                    </div>
                                    <div class="flex flex-col items-center">
                                          <div class="h-7 w-7 rounded-full bg-gray-200 flex items-center justify-center"></div>
                                    </div>
                                    <div class="flex flex-col items-center">
                                          <div class="h-7 w-7 rounded-full bg-gray-200 flex items-center justify-center"></div>
                                    </div>
                                    <div class="flex flex-col items-center">
                                          <div class="h-7 w-7 rounded-full bg-gray-200 flex items-center justify-center"></div>
                                    </div>
                                </div>
                              </div>
                            
                              <!-- Legendas -->
                              <div class="w-full flex justify-between items-center text-center">
                                <div class="w-[100px]">
                                  <span class="text-md font-bold">2</span>
                                  <p class="text-xs">Checkout</p>
                                </div>
                                <div class="w-[100px]">
                              <span class="text-md font-bold">0</span>  
                                  <p class="text-xs">Dados pessoais</p>
                                </div>
                                <div class="w-[100px]">
                                    <span class="text-md font-bold">0</span>  
                                  <p class="text-xs">Entrega</p>
                                </div>
                                <div class="w-[100px]">
                                    <span class="text-md font-bold">0</span>  
                                  <p class="text-xs">Pagamento</p>
                                </div>
                                <div class="w-[100px]">
                                    <span class="text-md font-bold">0</span>  
                                  <p class="text-xs">Comprou</p>
                                </div>
                              </div>
                            </div>
                        </div>

                  <!-- DESIGN DE COMPORTAMENTO DO CLIENTE FIM -->

                  <!-- CHART FUNIL INICIO -->


                  <div class="h-full w-full rounded-md border border-gray-200 bg-white p-6 lg:pr-6">
                    <p class="mb-4 font-bold text-black text-xl">Funil de Conversão</p>
                    <div class="flex justify-center w-full">
                      <div id="funnelChart" class="w-2/4 funnel" style="height: 800px;"></div>
                    </div>
                    
                    <link rel="stylesheet" href="https://unpkg.com/funnel-graph-js@1.3.9/dist/css/main.min.css">
                    <link rel="stylesheet" href="https://unpkg.com/funnel-graph-js@1.3.9/dist/css/theme.min.css">
                    
                    <script src="https://unpkg.com/funnel-graph-js@1.3.9/dist/js/funnel-graph.min.js"></script>
                    
                    <script>
                      document.addEventListener("DOMContentLoaded", function() {
                        var graph = new FunnelGraph({
                          container: '.funnel',
                          gradientDirection: 'vertical',
                          data: {
                              labels: ['Dados Pessoais', 'Entrega', 'Pagamento', 'Comprou'],
                              colors: ['#81D4FA', '#FF80AB'],
                              values: [18, 18, 14, 7]
                          },
                          displayPercent: true,
                          direction: 'vertical'
                      });

                      graph.draw();
                      });

                      
                    </script>
                    
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
                        <div class="value-container flex w-full min-w-fit flex-col items-start justify-between self-stretch">
                          <span class="text-regular text-primary">Cartão de Crédito</span>
                          <div>
                            <span class="text-regular font-bold text-primary">33.33% </span>
                            <!---->
                          </div>
                          <div class="bar min-h-6 w-full px-4 py-1 text-regular text-background hover:opacity-70 el-tooltip__trigger el-tooltip__trigger bg-[#45c9f3] rounded-l-lg text-white">33.33% </div>
                        </div>
                        <div class="value-container flex w-full min-w-fit flex-col items-start justify-between self-stretch">
                          <span class="text-regular text-primary">Pix</span>
                          <div>
                            <span class="text-regular font-bold text-primary">66.67% </span>
                            <!---->
                          </div>
                          <div class="bar min-h-6 w-full px-4 py-1 text-regular text-background hover:opacity-70 el-tooltip__trigger el-tooltip__trigger bg-[#ff0983] text-white">66.67% </div>
                        </div>
                        <div class="value-container flex w-full min-w-fit flex-col items-start justify-between self-stretch">
                          <span class="text-regular text-primary">Boleto</span>
                          <div>
                            <span class="text-regular font-bold text-primary">0% </span>
                            <!---->
                          </div>
                          <div class="bar min-h-6 w-full px-4 py-1 text-regular text-background hover:opacity-70 el-tooltip__trigger el-tooltip__trigger bg-[#18243a] text-white rounded-r-lg">0% </div>
                        </div>
                        <!---->
                      </div>
                      <!-- PERCENTAGE BAR 1.0 FIM -->

                      <!-- PERCENTAGE BAR 2.0 INICIO -->
                      <div id="percentage-bar" class="flex items-center justify-start rounded border border-shadowColor-100 p-6 bg-white" style="width: 100%; height: 160px;">
                        <div class="value-container flex w-full min-w-fit flex-col items-start justify-between self-stretch">
                          <span class="text-regular text-primary">Cartão de Crédito</span>
                          <div>
                            <!---->
                            <span class="text-regular font-bold text-primary">R$ 1.005,84 <span class="text-subtitle text-primary font-medium"> (6) </span>
                            </span>
                          </div>
                          <div class="bar rounded-l-lg min-h-6 w-full px-4 py-1 t text-white text-background hover:opacity-70 el-tooltip__trigger el-tooltip__trigger bg-[#ff0983]">83.33% </div>
                        </div>
                        <div class="value-container flex w-full min-w-fit flex-col items-start justify-between self-stretch">
                          <span class="text-regular text-primary"></span>
                          <!---->
                          <div class="bar min-h-6 w-full px-4 py-1  text-white text-background hover:opacity-70 el-tooltip__trigger el-tooltip__trigger bg-[#c3c1c1]">0% </div>
                        </div>
                        <div class="value-container flex w-full min-w-fit flex-col items-start justify-between self-stretch">
                          <span class="text-regular text-primary"></span>
                          <!---->
                          <div class="bar min-h-6 w-full px-4 py-1 text-white text-background hover:opacity-70 el-tooltip__trigger el-tooltip__trigger rounded-r-lg bg-[#d1d1d1]">16.67% </div>
                        </div>
                        <!---->
                      </div>
                      <!-- PERCENTAGE BAR 2.0 FIM -->
                      
                      <!-- PERCENTAGE BAR 3.0 INICIO -->
                      <div id="percentage-bar" class="flex items-center justify-start rounded border border-shadowColor-100 p-6 bg-white" style="width: 100%; height: 160px;">
                        <div class="value-container flex w-full min-w-fit flex-col items-start justify-between self-stretch">
                          <span class="text-regular text-primary">Pix</span>
                          <div>
                            <!---->
                            <span class="text-regular font-bold text-primary">R$ 1.671,74 <span class="text-subtitle text-primary font-medium"> (12) </span>
                            </span>
                          </div>
                          <div class="bar min-h-6 w-full px-4 py-1 text-regular text-background hover:opacity-70 el-tooltip__trigger el-tooltip__trigger bg-[#ff0983] text-white rounded-l-lg">33.33% </div>
                        </div>
                        <div class="value-container flex w-full min-w-fit flex-col items-start justify-between self-stretch">
                          <span class="text-regular text-primary"></span>
                          <!---->
                          <div class="bar min-h-6 w-full px-4 py-1 text-regular text-background hover:opacity-70 el-tooltip__trigger el-tooltip__trigger text-white" style="background-color: rgb(195, 193, 193);">66.67% </div>
                        </div>
                        <div class="value-container flex w-full min-w-fit flex-col items-start justify-between self-stretch">
                          <span class="text-regular text-primary"></span>
                          <!---->
                          <div class="bar min-h-6 w-full px-4 py-1 text-regular text-background hover:opacity-70 el-tooltip__trigger el-tooltip__trigger rounded-r-lg text-white" style="background-color: rgb(209, 209, 209);">0% </div>
                        </div>
                        <!---->
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
                          const options = {
                            chart: {
                              type: 'donut',
                              height: 300,
                              fontFamily: "'Inter', -apple-system, BlinkMacSystemFont, sans-serif",
                              background: 'transparent'
                            },
                            series: [35, 25, 20, 15, 5], // Valores em porcentagem
                            labels: ['1x sem juros', '2x sem juros', '3x sem juros', '4x sem juros', '5x ou mais'],
                            colors: ['#3b82f6', '#22c55e', '#f59e0b', '#ef4444', '#8b5cf6'],
                            dataLabels: {
                              enabled: true,
                              formatter: function (val) {
                                return val.toFixed(0) + '%'
                              },
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
                                formatter: function (value) {
                                  return value + '%'
                                }
                              }
                            }
                          }
                        
                          const chart = new ApexCharts(document.querySelector("#parcelamento-chart"), options)
                          chart.render()
                        })
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
      
  </x-app-layout>
  