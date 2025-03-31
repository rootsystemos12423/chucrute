<x-app-layout>
  
  <div class="flex flex-col w-full px-2 pt-3 h-max xl:overflow-hidden">
    <div class="mt-3 flex w-full flex-col gap-6">
      <div class="flex flex-col gap-4 text-start">
        <div class="text-title font-bold text-[#292D32]">GATEWAYS</div>
        <div class="text-small text-[#292D32]"> Gateways de pagamento disponíveis para seu e-commmerce </div>
      </div>
      <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 2xl:grid-cols-3">
        
        <a href="{{ route('gatewayconfig', ['gateway' => 'pay2win']) }}">
          <div class="flex justify-between gap-4 rounded-md border border-shadowColor-100 bg-white p-5 cursor-pointer">
            <div class="flex gap-6">
              <div class="w-[40px] h-[40px] lg:w-[40px] lg:h-[40px]">
                <img src="/images/pagamento/pay2win.png" alt="Pay2Win">
              </div>
              <div class="flex flex-col gap-3">
                <div class="text-[16px] font-bold">Pay2Win</div>
                  <div class="flex gap-2 text-[12px]">
                    <span class="bg-[#D9D9D9] rounded-[5px] py-1 px-2 text-[12px] text-[#292D32]"> Nacional </span>
                    <span class="bg-[#D9D9D9] rounded-[5px] py-1 px-2 text-[12px] text-[#292D32]"> Internacional </span>
                    <!---->
                  </div>
              </div>
            </div>
            <div>
              @if($gateway && $gateway->name === 'pay2win' && $gateway->status === 'active')
                  <div class="relative w-4 h-4">
                      <div class="absolute w-full h-full bg-green-600 rounded-full animate-ping"></div>
                      <div class="absolute w-full h-full bg-green-600 rounded-full"></div>
                  </div>
              @elseif(!$gateway)
                  <div class="relative w-4 h-4">
                      <div class="absolute w-full h-full bg-gray-400 rounded-full animate-ping"></div>
                      <div class="absolute w-full h-full bg-gray-400 rounded-full"></div>
                  </div>
              @endif
        
            </div>
          </div>
        </a>

      </div>
    </div>
    <div class="pt-16"></div>
  </div>

</x-app-layout>
      