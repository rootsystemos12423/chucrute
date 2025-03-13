<x-app-layout>
  
  <div class="flex flex-col w-full px-2 pt-3 h-max xl:overflow-hidden">
    <!---->
    <div class="flex flex-col gap-10">
      <div class="flex flex-col items-start justify-between gap-5 md:flex-row">
        <div class="flex flex-col items-start justify-start gap-5">
          <div class="flex flex-col gap-4">
            <!---->
            <div class="flex flex-row items-center gap-2 pl-1">
              <div class="flex items-center gap-5 text-center flex-wrap">
                <h1 class="text-title font-bold text-primary">LOGÍSTICA</h1>
                <!---->
                <p class="text-small text-secondary">(1 Frete)</p>
              </div>
            </div>
            <p class="pl-1 text-regular text-primary">Crie ou edite fretes em sua loja.</p>
          </div>
        </div>
        <a class="rounded-md bg-[#ff0983] text-white text-sm p-3" href="{{ route('logistic.show.create') }}">CADASTRAR FRETE</a>
      </div>
  
      <div class="flex flex-col gap-5">
        <div id="table-container" class="table-container w-full overflow-x-auto overscroll-x-none rounded">
          <!---->
          <table class="w-full table-auto max-lg:min-w-max">
            <thead>
              <tr>
                <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left">
                  <span class="min-w-max">NOME DO FRETE	</span>
                </th>
                <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left">
                  <span class="min-w-max">VALOR</span>
                </th>
                <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left">
                  <span class="min-w-max"> </span>
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($fretes as $frete)
              <tr class="border-b border-tableBorder bg-uncontrastColor clickable">
                <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">{{ $frete->name }}</td>
                <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                  <div class="inline-flex items-center px-3 py-1 rounded text-regular text-statusDelivered bg-statusDelivered-100">
                    R$ {{ number_format($frete->price, 2, ',', '.') }}
                  </div>                                             
                </td>
                <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                  <div class="relative inline-flex items-center px-3 py-1 rounded text-regular text-statusDelivered">
                    <!-- Círculo maior com opacidade -->
                    <div class="w-5 h-5 rounded-full bg-green-600 bg-opacity-40"></div>
                    <!-- Círculo sólido menor -->
                    <div class="absolute inset-0 w-3 h-3 m-auto rounded-full bg-green-600"></div>
                  </div>
                </td>                
                
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
       
      </div>
    </div>
    <div class="pt-16"></div>
  </div>
     
</x-app-layout>
    