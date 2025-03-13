<x-app-layout>
  
      <div class="flex flex-col w-full px-2 pt-3 h-max xl:overflow-hidden">
            <form novalidate="" class="flex flex-col gap-8">
              <div class="flex flex-col items-start justify-start gap-5">
                <div class="flex flex-col gap-4">
                  <!---->
                  <div class="flex flex-row items-center gap-2 pl-1">
                    <div class="flex items-center gap-5 text-center flex-wrap">
                      <h1 class="text-title font-bold text-primary">CONFIGURAÇÕES GERAIS</h1>
                      <!---->
                      <p class="text-small text-secondary"></p>
                    </div>
                  </div>
                  <p class="pl-1 text-regular text-primary">Informe os dados adicionais da sua loja.</p>
                </div>
              </div>
              <div class="flex items-start justify-start gap-5">
                <div class="flex flex-col items-start justify-start w-full gap-5">
                  <div class="flex flex-col items-start justify-start w-full gap-5 p-4 rounded bg-uncontrastColor">
                    <div class="flex flex-col w-full gap-y-5">
                      <h2 class="font-bold uppercase text-regular text-primary">DADOS DO REMETENTE</h2>
                      <div class="flex flex-col items-start justify-start w-full gap-5 p-5 border rounded border-shadowColor-400">
                        <div class="flex flex-col w-6/12 gap-y-5 max-md:w-full">
                          <p class="text-regular text-primary">Nome do remetente</p>
                          <div class="flex flex-col items-start justify-start gap-2" name="name-sender" value="REDE BH">
                            <input type="text" value="REDE BH" class="w-full rounded-md border bg-uncontrastColor p-3 text-regular text-primary focus:border-highlighted focus:shadow-[0_0_0_3px_var(--highlighted-200)] focus:outline-none disabled:cursor-not-allowed disabled:bg-gray-100 disabled:opacity-60 border-shadowColor-200" disabled="" min="-Infinity" max="Infinity">
                            <!---->
                          </div>
                        </div>
                        <div class="flex flex-col w-full gap-y-5">
                          <p class="text-regular text-primary">E-mail do remetente</p>
                          <div class="flex w-full gap-3.5 max-md:flex-col">
                            <div class="flex flex-col items-start justify-start gap-2 w-6/12 max-md:w-full" name="email-sender" value="">
                              <input type="text" placeholder="" class="w-full rounded-md border bg-uncontrastColor p-3 text-regular text-primary focus:border-highlighted focus:shadow-[0_0_0_3px_var(--highlighted-200)] focus:outline-none disabled:cursor-not-allowed disabled:bg-shadowColor-50 disabled:opacity-60 border-shadowColor-200" min="-Infinity" max="Infinity">
                              <!---->
                            </div>
                            <button data-v-ef89643d="" class="text-regular select-none flex justify-center items-center gap-4 py-2.5 px-3 rounded disabled:opacity-50 disabled:pointer-events-none h-[45px] w-[115px] max-md:w-full bg-[#ff0071] text-white" type="submit"> Validar</button>
                          </div>
                          <div class="flex flex-col w-full gap-5">
                            <div>
                              <p class="text-regular text-primary">Todos os e-mails da loja estão sendo enviados a partir de <strong class="font-bold">aline@comprasegura.io,</strong> em nome de <strong class="font-bold">REDE BH,</strong> e quando respondidos por algum cliente é encaminhado para o e-mail do rementente informado acima. </p>
                            </div>
                            <div>
                              <p class="text-regular text-primary">Para alterá-lo, você deve seguir os seguintes passos:</p>
                            </div>
                            <ul>
                              <li>
                                <p class="text-regular text-primary"> 1. Informe o e-mail desejado no campo acima (Insira somente e-mails que pertençam aos seus domínios verificados ou de serviços como Gmail, Yahoo, Uol etc. Caso contrário, utilizaremos o e-mail aline@comprasegura.io).</p>
                              </li>
                              <li>
                                <p class="text-regular text-primary"> 2. Você receberá um e-mail da Amazon SES.</p>
                              </li>
                              <li>
                                <p class="text-regular text-primary"> 3. Clique no link dentro desse e-mail.</p>
                              </li>
                              <li>
                                <p class="text-regular text-primary"> 4. Volte a esta tela e clique em verificar logo acima.</p>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="flex flex-col items-start justify-start w-full gap-5 p-4 rounded bg-uncontrastColor">
                    <div class="flex flex-col w-full gap-y-5">
                      <h2 class="font-bold uppercase text-regular text-primary">CUSTO E TAXAS</h2>
                      <div class="flex flex-col items-start justify-start w-full gap-5 p-5 border rounded border-shadowColor-400">
                        <div class="flex flex-col w-full gap-y-5">
                          <h3 class="font-bold text-regular text-primary">Imposto</h3>
                          <p class="text-regular text-primary">Informe o tipo de tributação e a alíquota paga por cada venda aprovada.</p>
                        </div>
                        <div class="flex flex-col w-4/12 gap-y-5 max-md:w-full">
                          <p class="text-regular text-primary">Tipo de Tributação</p>
                          <div class="flex flex-col items-start justify-start gap-2 select-container w-8/12" rules="required">
                              <div class="relative">
                                    <label for="tributacao" class="block text-sm text-regular pb-3">Selecione a Tributação</label>
                                    <select name="tributacao" id="tributacao" class="mt-1 block text-gray-500 text-md w-84 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none">
                                      <option value="1">Faturamento - Custo</option>
                                      <option value="2">Faturamento</option>
                                    </select>
                                  </div>                                  
                            <!---->
                          </div>
                        </div>
                        <div class="flex flex-col w-2/12 gap-y-5 max-md:w-full">
                          <p class="text-regular text-primary">Alíquota</p>
                          <div class="flex flex-col items-start justify-start gap-2 w-full">
                              <x-prefix-input wire:model="additional_interest_rate" type="number" placeholder="Insira a taxa de juros" class="w-full p-2 border rounded-md" suffix="%" />
                            <!---->
                          </div>
                        </div>
                      </div>
                      <div class="flex flex-col items-start justify-start w-full gap-5 p-5 border rounded border-shadowColor-400">
                        <div class="flex flex-col w-full gap-y-5">
                          <h3 class="font-bold text-regular text-primary">Dólar</h3>
                          <p class="text-regular text-primary">Para calcular o custo do produto utilizando a moeda em dólar é necessário informar manualmente o dólar do dia.</p>
                        </div>
                        <div class="flex flex-col w-2/12 gap-y-5 max-md:w-full">
                          <p class="text-regular text-primary">Cotação do dólar</p>
                          <x-prefix-input wire:model="additional_interest_rate" type="number" placeholder="Insira a taxa de juros" class="w-full p-2 border rounded-md" suffix="R$" />
                        </div>
                      </div>
                      <div class="flex flex-col items-start justify-start w-full gap-5 p-5 border rounded border-shadowColor-400">
                        <div class="flex flex-col w-full gap-y-5">
                          <h3 class="font-bold text-regular text-primary">Custo de Produto</h3>
                          <p class="text-regular text-primary">Informe uma porcentagem do valor de venda para ser calculado por padrão como custo do produto, esse valor será aplicado quando o produto for vendido e não tiver sido informado seu custo manualmente.</p>
                        </div>
                        <div class="flex flex-col w-2/12 gap-y-5 max-md:w-full">
                          <p class="text-regular text-primary">Custo Médio</p>
                          <div class="flex flex-col items-start justify-start gap-2 w-full" name="average" value="0">
                              <x-prefix-input wire:model="additional_interest_rate" type="number" placeholder="Insira a taxa de juros" class="w-full p-2 border rounded-md" suffix="%" />
                            <!---->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="flex items-center justify-between w-full gap-5 max-md:flex-col-reverse">
                    <div class="w-full md:px-4 w-full px-0 md:px-0">
                      <div class="flex w-full items-center justify-start gap-3 rounded border border-shadowColor-100 p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="w-9 text-highlighted">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"></path>
                        </svg>
                        <a href="https://ajuda.adoorei.com.br/pt-BR/articles/8386497-verificando-o-e-mail-da-sua-loja" target="_blank" rel="noopener noreferrer" class="text-regular text-primary hover:text-highlighted">
                          <strong class="text-highlighted">Está com dúvidas?&nbsp; </strong>
                          <span class="underline">Aprenda como configurar os recursos gerais da sua loja.</span>
                        </a>
                      </div>
                    </div>
                    <div class="flex justify-end gap-5 max-md:flex max-md:w-full">
                      <button data-v-ef89643d="" class="text-regular select-none flex justify-center items-center gap-4 py-2.5 px-3 rounded disabled:opacity-50 disabled:pointer-events-none outline border-[#ff0071] text-[#ff0071]" type="submit"> Cancelar</button>
                      <button data-v-ef89643d="" class="text-regular select-none flex justify-center items-center gap-4 py-2.5 px-3 rounded disabled:opacity-50 disabled:pointer-events-none bg-[#ff0071] text-white" type="submit"> Salvar</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <div class="pt-16"></div>
          </div>

</x-app-layout>
    