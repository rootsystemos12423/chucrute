<x-app-layout>

  <div class="flex flex-col w-full p-4 h-max xl:overflow-hidden">
    <!---->
    <div class="flex flex-col gap-10">

      <!-- INICIO HEADER -->
      <div class="flex flex-col items-start justify-start gap-5">
        <div class="flex flex-col items-start justify-start gap-5">
          <div class="flex flex-col gap-4">
            <a href="{{ route('orders') }}" class="flex max-w-max cursor-pointer items-center justify-start gap-2 text-regular text-secondary hover:text-[#ff0983]">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"></path>
              </svg> ver todos os pedidos </a>
            <div class="flex flex-row items-center gap-2 pl-1">
              <div class="flex items-center gap-5 text-center flex-wrap">
                <h1 class="text-title font-bold text-primary">PEDIDO #{{ $order->external_reference }}</h1>
                <!---->
                <p class="text-small text-secondary"></p>
              </div>
            </div>
            <!---->
          </div>
        </div>
        <div class="underline cursor-pointer text-regular text-primary hover:text-[#ff0983]">Simular Carrinho</div>
      </div>
      <!-- FIM HEADER -->

      <!-- INICIO CONTENT -->
      <div class="flex flex-col items-start justify-start p-4 rounded-md gap-14 bg-white">
        <div class="flex flex-col items-start justify-between w-full gap-5 md:flex-row md:items-center">
          <div class="flex flex-col items-start justify-start order-1 gap-3">
            <div class="font-bold text-regular text-primary">{{ $order_customer_data['name'] }}</div>
            <div class="text-regular text-primary">CPF: {{ $order_customer_data['document']['number'] }}</div>
            <div class="text-regular text-primary">Email: {{ $order_customer_data['email'] }}</div>
            <div class="text-regular text-primary">Celular: {{ $order_customer_data['phone'] }}</div>
          </div>
          <div class="flex flex-col items-center justify-center gap-3 md:order-2 max-md:w-full">
            <div class="inline-flex items-center px-3 py-1 rounded text-regular text-statusApproved bg-statusApproved-100">Aprovado</div>
            <div class="flex flex-col items-start justify-start gap-2 select-container w-full" id="select-bulk-status">
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
        <div class="flex flex-col items-start justify-between w-full md:flex-row">
          <div class="flex flex-col items-start justify-start w-full gap-3 md:w-4/12">
            <div class="font-bold text-regular text-primary">Detalhes do pedido</div>
            <div class="flex flex-col items-start justify-start gap-2">
              <div class="text-regular text-primary">Data do Pedido</div>
              <div class="text-regular text-secondary">15/02/2025, 17:48:41</div>
            </div>
            <div class="flex flex-col items-start justify-start gap-2">
              <div class="text-regular text-primary">Data da última mudança de status</div>
              <div class="text-regular text-secondary">15/02/2025, 17:49:26</div>
            </div>
          </div>
          <div class="flex flex-col items-start justify-start w-full gap-3 md:w-4/12">
            <div class="font-bold text-regular text-primary">Forma de Pagamento</div>
            <div class="flex flex-col items-start justify-start gap-5">
              <span>{{ $order->payment_method }}</span>
              <div class="text-regular text-primary">Processado por Pay2Win</div>
            </div>
          </div>
          <div class="flex flex-col items-start justify-start w-full gap-12 md:w-4/12">
            <div class="flex flex-col items-start justify-start gap-3">
              <div class="font-bold text-regular text-primary">Endereço de Entrega</div>
              <div class="flex flex-col items-start justify-start gap-5">
                <div class="text-regular text-primary">{{ $order_shipping_data['address']['street'] }}, {{ $order_shipping_data['address']['streetNumber'] }} - {{ $order_shipping_data['address']['neighborhood'] }} - {{ $order_shipping_data['address']['city'] }} <br> CEP: {{ $order_shipping_data['address']['zipCode'] }} </div>
              </div>
            </div>
            <div class="flex items-start justify-start gap-2">
              <i class="fa-solid fa-truck text-lg"></i>
              <div class="flex flex-col items-start justify-start gap-2">
                <div class="font-bold text-regular text-primary">Código de Rastreio</div>
                <div class="text-regular text-primary">Aguardando envio</div>
              </div>
            </div>
          </div>
        </div>
        <div class="flex flex-col items-start justify-start w-full gap-3">
          <div class="font-bold text-regular text-primary">PRODUTOS</div>
          <table class="w-full border-separate border-spacing-y-2">
            <thead>
              <tr>
                <th class="py-3 text-center border-b text-regular text-primary"></th>
                <th class="py-3 text-center border-b text-regular text-primary">QTD.</th>
                <th class="py-3 text-center border-b text-regular text-primary">VALOR UNIT.</th>
                <th class="py-3 text-center border-b text-regular text-primary">SUBTOTAL</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="py-4 border-b">
                  <div class="flex items-center justify-start gap-3">
                    <img src="https://cdn.shopify.com/s/files/1/0711/4702/8515/files/Eyeliner2_15a2d22b-44e9-4354-9acd-adcc96526ff6.webp?v=1739232429" alt="Product" class="w-10 h-12 rounded-lg">
                    <div class="text-regular text-primary">Eyeliner - Pullpen Preto 9g | Fran by Franciny Ehlke <br> Eyeliner - Pullpen Preto 9g | Fran by Franciny Ehlke </div>
                  </div>
                </td>
                <td class="py-4 text-center border-b text-regular text-primary">1</td>
                <td class="py-4 text-center border-b text-regular text-primary">R$ 33,43</td>
                <td class="py-4 text-center border-b text-regular text-primary">R$ 33,43</td>
              </tr>
              <tr>
                <td class="py-4 border-b">
                  <div class="flex items-center justify-start gap-3">
                    <img src="https://cdn.shopify.com/s/files/1/0711/4702/8515/files/chillikit_e384d5bc-f357-4a7d-ac23-552d638ab21c.webp?v=1739232626" alt="Product" class="w-10 h-12 rounded-lg">
                    <div class="text-regular text-primary">Chillikit - Edição Limitada | Fran by Franciny Ehlke <br> Chillikit - Edição Limitada | Fran by Franciny Ehlke </div>
                  </div>
                </td>
                <td class="py-4 text-center border-b text-regular text-primary">1</td>
                <td class="py-4 text-center border-b text-regular text-primary">R$ 125,79</td>
                <td class="py-4 text-center border-b text-regular text-primary">R$ 125,79</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="flex flex-col items-end justify-start w-full gap-3">
          <table class="border-separate table-auto -mr-7 border-spacing-x-10 border-spacing-y-3">
            <tbody>
              <tr>
                <td class="text-right text-regular text-primary">Subtotal</td>
                <td class="text-right text-regular text-primary">R$ 159,22</td>
              </tr>
              <tr>
                <td class="text-right text-regular text-primary">Frete</td>
                <td class="text-right text-regular text-primary">R$ 0,00</td>
              </tr>
              <tr>
                <td class="text-right text-regular text-primary">Descontos</td>
                <td class="text-right text-regular text-primary">R$ 0,00</td>
              </tr>
              <tr>
                <td class="font-bold text-right text-regular text-primary">Total</td>
                <td class="font-bold text-right text-regular text-primary">R$ 159,22</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="pt-16"></div>
  </div>
      
  </x-app-layout>
  