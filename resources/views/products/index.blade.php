<x-app-layout>

      <div class="flex flex-col w-full px-2 pt-5 h-max xl:overflow-hidden">
            <div class="flex flex-col gap-10">
              <div class="flex flex-col items-start justify-between gap-5 md:flex-row">
                <div class="flex flex-col items-start justify-start gap-5">
                  <div class="flex flex-col gap-4">
                    <!---->
                    <div class="flex flex-row items-center gap-2 pl-1">
                      <div class="flex items-center gap-5 text-center flex-wrap">
                        <h1 class="text-title font-bold text-primary">PRODUTOS</h1>
                        <!---->
                        <p class="text-small text-secondary">({{ $count }} produtos)</p>
                      </div>
                    </div>
                    <p class="pl-1 text-regular text-primary">Encontre produtos cadastrados em sua loja.</p>
                  </div>
                </div>
                <!---->
              </div>
              <div class="h-10 w-full">
                <div class="flex flex-col items-start justify-start gap-2 w-full">
                  <div class="flex w-full items-center justify-center gap-2 rounded border p-2 border-shadowColor-200 bg-uncontrastColor">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="h-6 w-6 text-primary">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"></path>
                    </svg>
                    <input type="text" placeholder="Buscar por nome do produto..." class="w-full rounded-md border-0 bg-transparent text-regular text-primary outline-none disabled:cursor-not-allowed">
                  </div>
                  <!---->
                </div>
              </div>
              <div class="flex flex-col gap-5">
                <div id="table-container" class="table-container w-full overflow-x-auto overscroll-x-none rounded">
                  <!---->
                  <table class="w-full table-auto max-lg:min-w-max">
                    <thead>
                      <tr>
                        <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left w-[150px] max-w-[150px]">
                          <!---->
                        </th>
                        <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left">
                          <span class="min-w-max">Nome do produto</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      
                     @foreach ($products as $product)
                     @php
                        $image = json_decode($product->image, true);
                     @endphp
                      <tr class="border-b border-tableBorder bg-uncontrastColor clickable">
                        <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                          <img class="mr-5 h-20 w-20 rounded-md" src="{{ $image['src'] }}" alt="">
                        </td>
                        <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">{{ $product->title }}</td>
                      </tr>
                     @endforeach 
                      
                    </tbody>
                  </table>
                </div>
               
                {{ $products->links() }}

                
              </div>
            </div>
            <div class="pt-16"></div>
          </div>

</x-app-layout>
      