<x-app-layout>

  <div class="flex flex-col w-full p-4 h-max xl:overflow-hidden">
    <!---->
    <div data-v-089cf744="" class="flex flex-col gap-10">

      <!-- INICIO HEADER -->
      <div data-v-089cf744="" class="flex flex-col items-start justify-start gap-5">
        <div data-v-089cf744="" class="flex flex-col items-start justify-start gap-5">
          <div class="flex flex-col gap-4">
            <a href="{{ route('orders') }}" class="flex max-w-max cursor-pointer items-center justify-start gap-2 text-regular text-secondary hover:text-[#ff0983]">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"></path>
              </svg> ver todos os pedidos </a>
            <div class="flex flex-row items-center gap-2 pl-1">
              <div class="flex items-center gap-5 text-center flex-wrap">
                <h1 class="text-title font-bold text-primary">PEDIDO 58969277314722</h1>
                <!---->
                <p class="text-small text-secondary"></p>
              </div>
            </div>
            <!---->
          </div>
        </div>
        <div data-v-089cf744="" class="underline cursor-pointer text-regular text-primary hover:text-[#ff0983]">Simular Carrinho</div>
      </div>
      <!-- FIM HEADER -->

      <!-- INICIO CONTENT -->
      <div data-v-089cf744="" class="flex flex-col items-start justify-start p-4 rounded-md gap-14 bg-white">
        <div data-v-089cf744="" class="flex flex-col items-start justify-between w-full gap-5 md:flex-row md:items-center">
          <div data-v-089cf744="" class="flex flex-col items-start justify-start order-1 gap-3">
            <div data-v-089cf744="" class="font-bold text-regular text-primary">Alessandra Ribeiro</div>
            <div data-v-089cf744="" class="text-regular text-primary">CPF: 261.178.188-58</div>
            <div data-v-089cf744="" class="text-regular text-primary">Email: alessandra.bianca@hotmail.com</div>
            <div data-v-089cf744="" class="text-regular text-primary">Celular: (43) 99921-2860</div>
            <div data-v-089cf744="" class="text-regular text-primary">IP: 2804:14d:883:9c82:48df:3111:64eb:dc1a</div>
          </div>
          <div data-v-089cf744="" class="flex flex-col items-center justify-center gap-3 md:order-2 max-md:w-full">
            <div data-v-089cf744="" class="inline-flex items-center px-3 py-1 rounded text-regular text-statusApproved bg-statusApproved-100">Aprovado</div>
            <div data-v-321523b0="" data-v-089cf744="" class="flex flex-col items-start justify-start gap-2 select-container w-full" id="select-bulk-status">
              <div class="flex justify-center w-full">
                <select name="status" id="status" class="p-3 border border-gray-300 rounded-md text-secondary w-64 text-center">
                  <option class="text-secondary" value="#">Aprovado</option>
                  <option class="text-secondary" value="#">Pendente</option>
                  <option class="text-secondary" value="#">Recusado</option>
                </select>
              </div>
              <!---->
            </div>
          </div>
        </div>
        <div data-v-089cf744="" class="flex flex-col items-start justify-between w-full md:flex-row">
          <div data-v-089cf744="" class="flex flex-col items-start justify-start w-full gap-3 md:w-4/12">
            <div data-v-089cf744="" class="font-bold text-regular text-primary">Detalhes do pedido</div>
            <div data-v-089cf744="" class="flex flex-col items-start justify-start gap-2">
              <div data-v-089cf744="" class="text-regular text-primary">Data do Pedido</div>
              <div data-v-089cf744="" class="text-regular text-secondary">15/02/2025, 17:48:41</div>
            </div>
            <div data-v-089cf744="" class="flex flex-col items-start justify-start gap-2">
              <div data-v-089cf744="" class="text-regular text-primary">Data da última mudança de status</div>
              <div data-v-089cf744="" class="text-regular text-secondary">15/02/2025, 17:49:26</div>
            </div>
          </div>
          <div data-v-089cf744="" class="flex flex-col items-start justify-start w-full gap-3 md:w-4/12">
            <div data-v-089cf744="" class="font-bold text-regular text-primary">Forma de Pagamento</div>
            <div data-v-089cf744="" class="flex flex-col items-start justify-start gap-5">
              <button data-v-ef89643d="" data-v-089cf744="" class="text-regular select-none flex justify-center items-center gap-4 py-2.5 px-3 rounded disabled:opacity-50 disabled:pointer-events-none outline text-[#00BB8E]" type="submit">
                <i class="fa-brands fa-whatsapp text-xl "></i>
                 Enviar no Whatsapp </button>
              <div data-v-089cf744="" class="text-regular text-primary">PIX</div>
              <div data-v-089cf744="" class="text-regular text-primary">Processado por Skalepay</div>
            </div>
          </div>
          <div data-v-089cf744="" class="flex flex-col items-start justify-start w-full gap-12 md:w-4/12">
            <div data-v-089cf744="" class="flex flex-col items-start justify-start gap-3">
              <div data-v-089cf744="" class="font-bold text-regular text-primary">Endereço de Entrega</div>
              <div data-v-089cf744="" class="flex flex-col items-start justify-start gap-5">
                <div data-v-089cf744="" class="text-regular text-primary">Rua José Manoel de Souza, 75 Apto 101 torre 2 - Vale dos Tucanos - Londrina <br data-v-089cf744=""> CEP: 86046-541 </div>
              </div>
            </div>
            <div data-v-089cf744="" class="flex items-start justify-start gap-2">
              <i class="fa-solid fa-truck text-lg"></i>
              <div data-v-089cf744="" class="flex flex-col items-start justify-start gap-2">
                <div data-v-089cf744="" class="font-bold text-regular text-primary">Código de Rastreio</div>
                <div data-v-089cf744="" class="text-regular text-primary">Aguardando envio</div>
              </div>
            </div>
          </div>
        </div>
        <div data-v-089cf744="" class="flex flex-col items-start justify-start w-full gap-3">
          <div data-v-089cf744="" class="font-bold text-regular text-primary">PRODUTOS</div>
          <table data-v-089cf744="" class="w-full border-separate border-spacing-y-2">
            <thead data-v-089cf744="">
              <tr data-v-089cf744="">
                <th data-v-089cf744="" class="py-3 text-center border-b text-regular text-primary"></th>
                <th data-v-089cf744="" class="py-3 text-center border-b text-regular text-primary">QTD.</th>
                <th data-v-089cf744="" class="py-3 text-center border-b text-regular text-primary">VALOR UNIT.</th>
                <th data-v-089cf744="" class="py-3 text-center border-b text-regular text-primary">SUBTOTAL</th>
              </tr>
            </thead>
            <tbody data-v-089cf744="">
              <tr data-v-089cf744="">
                <td data-v-089cf744="" class="py-4 border-b">
                  <div data-v-089cf744="" class="flex items-center justify-start gap-3">
                    <img data-v-089cf744="" src="https://cdn.shopify.com/s/files/1/0711/4702/8515/files/Eyeliner2_15a2d22b-44e9-4354-9acd-adcc96526ff6.webp?v=1739232429" alt="Product" class="w-10 h-12 rounded-lg">
                    <div data-v-089cf744="" class="text-regular text-primary">Eyeliner - Pullpen Preto 9g | Fran by Franciny Ehlke <br data-v-089cf744=""> Eyeliner - Pullpen Preto 9g | Fran by Franciny Ehlke </div>
                  </div>
                </td>
                <td data-v-089cf744="" class="py-4 text-center border-b text-regular text-primary">1</td>
                <td data-v-089cf744="" class="py-4 text-center border-b text-regular text-primary">R$ 33,43</td>
                <td data-v-089cf744="" class="py-4 text-center border-b text-regular text-primary">R$ 33,43</td>
              </tr>
              <tr data-v-089cf744="">
                <td data-v-089cf744="" class="py-4 border-b">
                  <div data-v-089cf744="" class="flex items-center justify-start gap-3">
                    <img data-v-089cf744="" src="https://cdn.shopify.com/s/files/1/0711/4702/8515/files/chillikit_e384d5bc-f357-4a7d-ac23-552d638ab21c.webp?v=1739232626" alt="Product" class="w-10 h-12 rounded-lg">
                    <div data-v-089cf744="" class="text-regular text-primary">Chillikit - Edição Limitada | Fran by Franciny Ehlke <br data-v-089cf744=""> Chillikit - Edição Limitada | Fran by Franciny Ehlke </div>
                  </div>
                </td>
                <td data-v-089cf744="" class="py-4 text-center border-b text-regular text-primary">1</td>
                <td data-v-089cf744="" class="py-4 text-center border-b text-regular text-primary">R$ 125,79</td>
                <td data-v-089cf744="" class="py-4 text-center border-b text-regular text-primary">R$ 125,79</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div data-v-089cf744="" class="flex flex-col items-end justify-start w-full gap-3">
          <table data-v-089cf744="" class="border-separate table-auto -mr-7 border-spacing-x-10 border-spacing-y-3">
            <tbody data-v-089cf744="">
              <tr data-v-089cf744="">
                <td data-v-089cf744="" class="text-right text-regular text-primary">Subtotal</td>
                <td data-v-089cf744="" class="text-right text-regular text-primary">R$ 159,22</td>
              </tr>
              <tr data-v-089cf744="">
                <td data-v-089cf744="" class="text-right text-regular text-primary">Frete</td>
                <td data-v-089cf744="" class="text-right text-regular text-primary">R$ 0,00</td>
              </tr>
              <tr data-v-089cf744="">
                <td data-v-089cf744="" class="text-right text-regular text-primary">Descontos</td>
                <td data-v-089cf744="" class="text-right text-regular text-primary">R$ 0,00</td>
              </tr>
              <tr data-v-089cf744="">
                <td data-v-089cf744="" class="font-bold text-right text-regular text-primary">Total</td>
                <td data-v-089cf744="" class="font-bold text-right text-regular text-primary">R$ 159,22</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="pt-16"></div>
  </div>
      
  </x-app-layout>
  