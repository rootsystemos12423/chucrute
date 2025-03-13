<div x-data="offerSlider()" x-init="init" class="relative w-full overflow-hidden mt-4">
  <div class="p-2 orderbump rounded-full text-center w-48 mx-auto mb-4 flex items-center animate-shake">
    <span class="text-[12px] font-bold text-[{{ $customizations['appearance_tag_color_second'] }}]">🎉 VOCÊ TEM UMA OFERTA!</span>
  </div>
  <div class="flex transition-transform duration-300 ease-in-out max-w-screen md:w-full"
      :style="'transform: translateX(-' + currentIndex * 100 + '%)'"
      @touchstart="startSwipe($event)" 
      @touchend="endSwipe($event)">
    
    <template x-for="(offer, index) in offers" :key="index">
      <div class="w-full min-w-full p-4 space-y-3 rounded border-dotted orderbump" 
           :class="Alpine.store('offerSelection').selectedOffers[index] ? 'border-[{{ $customizations['appearance_tag_color_second'] }}] border-4' : 'border-[#d0d0d0] border-2'">
        <div class="flex justify-between items-center gap-4 xl:flex-row flex-col">
          <img :src="offer.image" class="h-24 w-24 rounded-md object-cover max-sm:h-20 max-sm:w-20">
          <div class="flex flex-col space-y-2 text-center xl:text-left">
            <span class="text-xs font-bold text-gray-600 max-w-48" x-text="offer.name"></span>
            <div class="flex gap-1 items-center">
              <span class="text-xs line-through text-gray-400" 
                    x-text="'R$ ' + parseFloat(offer.oldPrice).toLocaleString('pt-BR', { minimumFractionDigits: 2 })">
              </span>

              <span class="text-md font-bold text-[{{ $customizations['appearance_tag_color_second'] }}]" 
                    x-text="'R$ ' + parseFloat(offer.newPrice).toLocaleString('pt-BR', { minimumFractionDigits: 2 })">
              </span>

            </div>
          </div>
        </div>
        <hr class="border-t-2 border-dotted border-[#d0d0d0]">
        
        <div class="space-y-2 text-gray-600">
          <h2 class="text-sm font-bold" x-text="offer.title"></h2>
          <p class="text-xs" x-text="offer.description"></p>
        </div>
    
        <!-- Checkbox clicável -->
        <label :for="'ofertaImperdivel' + index" class="flex items-center gap-2 orderbump-btn text-white text-xs font-bold rounded-lg p-3 sm:p-4 w-full sm:w-auto cursor-pointer transition">
          <input type="checkbox" 
                 :id="'ofertaImperdivel' + index" 
                 class="hidden peer"
                 x-model="Alpine.store('offerSelection').selectedOffers[index]"
                 @change="sendSelectedOffer(index)">                                  
      
          <div class="w-4 h-4 peer-checked:text-[{{$customizations['appearance_tag_color_second']}}] peer-checked:block border-2 border-white rounded-md text-center flex items-center justify-center peer-checked:bg-white peer-checked:border-white">
              <!-- O SVG será exibido quando o checkbox estiver selecionado -->
              <i class="fa fa-check text-[{{$customizations['appearance_tag_color_second']}}]" x-show="Alpine.store('offerSelection').selectedOffers[index]" aria-hidden="true"></i>
          </div>
      
          + Adicionar oferta Imperdível
      </label>      

        <div class="flex items-center justify-center gap-2 pt-2">
          <template x-for="(offer, idx) in offers" :key="idx">
            <div 
                :class="currentIndex === idx ? 'bg-[{{$customizations['appearance_tag_color_second']}}]' : 'bg-white border border-[{{$customizations['appearance_tag_color_second']}}]'"
                class="h-3 w-3 sm:h-4 sm:w-4 rounded-full cursor-pointer"
                @click="currentIndex = idx">
            </div>
          </template>
        </div>
      </div>
    </template>
  </div>
</div>
