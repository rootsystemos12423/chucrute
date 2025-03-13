<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Finalizar Pedido</title>
      <script src="https://cdn.tailwindcss.com"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Sora:wght@100..800&display=swap" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/card@2.5.0/dist/card.min.js"></script>
      <script>
         var csrfToken = "{{ csrf_token() }}"; // Obtendo o CSRF token diretamente do Blade
      </script>        
      <!-- Scripts -->
      @vite(['resources/css/app.css', 'resources/js/app.js'])
      <!-- Styles -->
      @livewireStyles
   </head>
   @if($checkout)
   <body class="bg-gray-100 font text-white overflow-x-hidden antialiased">
      <script>
         const checkoutToken = "{{ $checkout->cart->token }}";
         console.log('checkoutToken:', checkoutToken);
      </script>
      <style>
         body{
            font-family: "Work Sans", serif;
         }
         :root {
            --default-radius: 5px;
            --texts-font-family: {{ $customizations['appearance_tipografy_primary'] ?? 'Work Sans, sans-serif' }};
            --titles-font-family: {{ $customizations['appearance_tipografy_second'] ?? 'Work Sans, sans-serif' }};
            --titles-uppercase: initial;
            --btn-uppercase: initial;
            --texts-font-regular: 400;
            --texts-font-medium: 500;
            --texts-font-bold: 700;
            --titles-font-regular: 400;
            --titles-font-medium: 500;
            --titles-font-bold: 700;
            --btn-primary-bg-color: {{ $customizations['appearance_button_color'] ?? '#6EC1D4' }};
            --btn-primary-txt-color: {{ $customizations['appearance_text_color'] ?? '#FFFFFF' }};
            --btn-secondary-bg-color: {{ $customizations['appearance_button_color_second'] ?? '#999999' }};
            --btn-secondary-txt-color: {{ $customizations['appearance_text_color_second'] ?? '#FFFFFF' }};
            --btn-tertiary-txt-color: {{ $customizations['appearance_tag_color_second'] ?? '#6EC1D4' }};
            --stopwatch-txt-color: {{ $customizations['cabecalho_cronometro_color'] ?? '#FFFFFF' }};
            --stopwatch-bg-color: {{ $customizations['cabecalho_bar_color'] ?? '#151515' }};
            --header-bg-color: {{ $customizations['cabecalho_cor_cabecalho'] ?? '#ffffff' }};
            --header-el-color: {{ $customizations['cabecalho_cor_elementos'] ?? '#343434' }};
            --discount-tag-bg-color: {{ $customizations['appearance_tag_color_second'] ?? '#6EC1D4' }};
            --discount-tag-txt-color: {{ $customizations['appearance_number_color_second'] ?? '#FFFFFF' }};
            --step-tag-bg-color: {{ $customizations['appearance_tag_color'] ?? '#333333' }};
            --step-tag-txt-color: {{ $customizations['appearance_number_color'] ?? '#FFFFFF' }};
            --desktop-active-color: {{ $customizations['appearance_steps_color'] ?? '#999999' }};
            --cart-total-color: {{ $customizations['appearance_totalvalue_color'] ?? '#44C485' }};
            --title-color: {{ $customizations['appearance_title_color'] ?? '#666666' }};
            --description-color: {{ $customizations['appearance_description_color'] ?? '#666666' }};
            --progress-bar-bg-color: {{ $customizations['appearance_progress_bar_color'] ?? '#6EC1D4' }};
            --progress-bar-text-color: {{ $customizations['appearance_number_color_third'] ?? '#FFFFFF' }};
            --ob-bg-color: {{ $customizations['orderbump_bg_color'] ?? '#FFFFD1' }};
            --ob-border-color: {{ $customizations['orderbump_border_color'] ?? '#D0D0D0' }};
            --ob-title-color: {{ $customizations['ob-title-color'] ?? '#666666' }};
            --ob-txt-color: {{ $customizations['ob-txt-color'] ?? '#666666' }};
            --ob-btn-bg-color: {{ $customizations['orderbump_button_color'] ?? '#FE509C' }};
            --ob-btn-txt-color: {{ $customizations['appearance_text_color'] ?? '#FFFFFF' }};
            --footer-border-color: transparent;
            --footer-bg-color: {{ $customizations['rodape_cor_rodape'] ?? '#fff' }};
            --footer-txt-color: {{ $customizations['rodape_cor_text'] ?? '#666666' }};
            --footer-mobile-position: {{ $customizations['rodape_position_mobile'] ?? 'center' }};
         }

         /* Classes baseadas nas variáveis */
         .btn-primary {
            background-color: var(--btn-primary-bg-color);
            color: var(--btn-primary-txt-color);
            border-radius: var(--default-radius);
         }

         .btn-secondary {
            background-color: var(--btn-secondary-bg-color);
            color: var(--btn-secondary-txt-color);
            border-radius: var(--default-radius);
         }

         .btn-tertiary {
            color: var(--btn-tertiary-txt-color);
         }

         .stopwatch {
            color: var(--stopwatch-txt-color);
            background-color: var(--stopwatch-bg-color);
         }

         .header {
            background-color: var(--header-bg-color);
            color: var(--header-el-color);
         }

         .discount-tag {
            background-color: var(--discount-tag-bg-color);
            color: var(--discount-tag-txt-color);
         }

         .step-tag {
            background-color: var(--step-tag-bg-color);
            color: var(--step-tag-txt-color);
         }

         .desktop-active {
            color: var(--desktop-active-color);
         }

         .cart-total {
            color: var(--cart-total-color);
         }

         .title {
            color: var(--title-color);
         }

         .description {
            color: var(--description-color);
         }

         .progress-bar {
            background-color: var(--progress-bar-bg-color);
            color: var(--progress-bar-text-color);
         }

         .orderbump {
            background-color: var(--ob-bg-color);
            color: var(--ob-txt-color);
         }

         .orderbump-btn {
            background-color: var(--ob-btn-bg-color);
            color: var(--ob-btn-txt-color);
         }

         .footer {
            background-color: var(--footer-bg-color);
            color: var(--footer-txt-color);
            text-align: var(--footer-mobile-position);
         }

         .discount-flag {
            background-color: var(--discount-tag-bg-color);
            color: var(--discount-tag-txt-color);
         }

         .cart-total {
            color: var(--cart-total-color);
         }

      </style>

      <div x-data="{ 
         step: {{ $checkout->steps }}, 
         isMobile: window.innerWidth < 640 
         }" 
      x-init="window.addEventListener('resize', () => isMobile = window.innerWidth < 640)">
      <div class="w-full pt-0 p-2 bg-white flex items-center justify-center header">
         <div class="px-4 py-3 w-full max-w-[1200px] flex justify-between items-center">
            <div class="">
               @if(isset($customizations['cabecalho_logo_path']) && $customizations['cabecalho_logo_path'])
               <img class="max-w-[100px] h-full" src="{{ asset($customizations['cabecalho_logo_path']) }}" alt="Loja Logo">
               @else
                     <h1 class="text-xl font-extrabold p-2">BEOUT</h1>
               @endif           
            </div>
            <div>
               <svg class="fill-[{{ $customizations['cabecalho_cor_elementos'] }}]" width="89" height="19" viewBox="0 0 89 19" fill="#898792" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" clip-rule="evenodd" d="M9.75 14.1875V8.5C9.75 8.05127 9.38623 7.6875 8.9375 7.6875L2.4375 7.6875C1.98877 7.6875 1.625 8.05127 1.625 8.5L1.625 14.1875C1.625 14.6362 1.98877 15 2.4375 15H8.9375C9.38623 15 9.75 14.6362 9.75 14.1875ZM11.375 8.5V14.1875C11.375 15.5337 10.2837 16.625 8.9375 16.625H2.4375C1.09131 16.625 -5.8844e-08 15.5337 0 14.1875L2.48609e-07 8.5C3.07453e-07 7.15381 1.09131 6.0625 2.4375 6.0625L8.9375 6.0625C10.2837 6.0625 11.375 7.15381 11.375 8.5Z"></path>
                     <path fill-rule="evenodd" clip-rule="evenodd" d="M5.6875 3.625C4.79004 3.625 4.0625 4.35254 4.0625 5.25V6.875H2.4375V5.25C2.4375 3.45507 3.89257 2 5.6875 2C7.48243 2 8.9375 3.45507 8.9375 5.25V6.875H7.3125V5.25C7.3125 4.35254 6.58496 3.625 5.6875 3.625Z"></path>
                     <path fill-rule="evenodd" clip-rule="evenodd" d="M6.5 10.125L6.5 12.5625H4.875L4.875 10.125H6.5Z"></path>
                     <path d="M23.136 0.11C23.73 0.11 24.236 0.205333 24.654 0.396C25.072 0.586667 25.391 0.861666 25.611 1.221C25.831 1.58033 25.941 2.01667 25.941 2.53C25.941 3.04333 25.831 3.47967 25.611 3.839C25.391 4.19833 25.072 4.47333 24.654 4.664C24.236 4.85467 23.73 4.95 23.136 4.95H21.695V7.37H19.803V0.11H23.136ZM22.839 3.531C23.235 3.531 23.532 3.45033 23.73 3.289C23.9353 3.12033 24.038 2.86733 24.038 2.53C24.038 2.19267 23.9353 1.94333 23.73 1.782C23.532 1.61333 23.235 1.529 22.839 1.529H21.695V3.531H22.839Z"></path>
                     <path d="M33.0094 7.37H31.0624L30.5564 5.731H28.0704L27.5534 7.37H25.6504L28.2024 0.11H30.4684L33.0094 7.37ZM28.4224 4.444H30.2044L29.3134 1.507L28.4224 4.444Z"></path>
                     <path d="M36.5882 7.48C35.9429 7.48 35.3672 7.337 34.8612 7.051C34.3626 6.765 33.9739 6.34333 33.6952 5.786C33.4166 5.22867 33.2772 4.55033 33.2772 3.751C33.2772 2.96633 33.4239 2.29533 33.7172 1.738C34.0106 1.18067 34.4286 0.751667 34.9712 0.451C35.5212 0.150333 36.1666 0 36.9072 0C37.7286 0 38.3922 0.150333 38.8982 0.451C39.4042 0.744333 39.7966 1.21367 40.0752 1.859L38.3262 2.552C38.2309 2.178 38.0622 1.90667 37.8202 1.738C37.5782 1.56933 37.2776 1.485 36.9182 1.485C36.5589 1.485 36.2509 1.573 35.9942 1.749C35.7376 1.91767 35.5432 2.17067 35.4112 2.508C35.2792 2.838 35.2132 3.24867 35.2132 3.74C35.2132 4.25333 35.2792 4.68233 35.4112 5.027C35.5506 5.37167 35.7522 5.62833 36.0162 5.797C36.2876 5.95833 36.6212 6.039 37.0172 6.039C37.2299 6.039 37.4242 6.01333 37.6002 5.962C37.7762 5.91067 37.9302 5.83733 38.0622 5.742C38.1942 5.63933 38.2969 5.51467 38.3702 5.368C38.4436 5.214 38.4802 5.03433 38.4802 4.829V4.719H36.8192V3.454H40.0862V7.37H38.7992L38.6562 5.665L38.9642 5.929C38.8102 6.42767 38.5316 6.81267 38.1282 7.084C37.7322 7.348 37.2189 7.48 36.5882 7.48Z"></path>
                     <path d="M48.1344 7.37H46.1874L45.6814 5.731H43.1954L42.6784 7.37H40.7754L43.3274 0.11H45.5934L48.1344 7.37ZM43.5474 4.444H45.3294L44.4384 1.507L43.5474 4.444Z"></path>
                     <path d="M57.3828 0.11V7.37H55.7108V4.037L55.7658 1.804H55.7438L53.9508 7.37H52.4218L50.6288 1.804H50.6068L50.6618 4.037V7.37H48.9788V0.11H51.6738L52.8178 3.806L53.2248 5.346H53.2468L53.6648 3.817L54.7978 0.11H57.3828Z"></path>
                     <path d="M58.9905 7.37V0.11H64.6445V1.573H60.8825V3.047H63.8745V4.422H60.8825V5.907H64.7875V7.37H58.9905Z"></path>
                     <path d="M72.4749 0.11V7.37H70.3739L68.1189 3.443L67.5689 2.365H67.5579L67.6019 3.707V7.37H65.9299V0.11H68.0309L70.2859 4.037L70.8359 5.115H70.8469L70.8029 3.773V0.11H72.4749Z"></path>
                     <path d="M80.1883 0.11V1.573H77.8233V7.37H75.9313V1.573H73.5553V0.11H80.1883Z"></path>
                     <path d="M84.225 0C84.9583 0 85.589 0.150333 86.117 0.451C86.6523 0.744333 87.063 1.16967 87.349 1.727C87.635 2.28433 87.778 2.95533 87.778 3.74C87.778 4.52467 87.635 5.19567 87.349 5.753C87.063 6.31033 86.6523 6.73933 86.117 7.04C85.589 7.33333 84.9583 7.48 84.225 7.48C83.4917 7.48 82.8573 7.33333 82.322 7.04C81.7867 6.73933 81.376 6.31033 81.09 5.753C80.804 5.19567 80.661 4.52467 80.661 3.74C80.661 2.95533 80.804 2.28433 81.09 1.727C81.376 1.16967 81.7867 0.744333 82.322 0.451C82.8573 0.150333 83.4917 0 84.225 0ZM84.225 1.485C83.873 1.485 83.576 1.56933 83.334 1.738C83.092 1.90667 82.9087 2.15967 82.784 2.497C82.6593 2.827 82.597 3.24133 82.597 3.74C82.597 4.23133 82.6593 4.64567 82.784 4.983C82.9087 5.32033 83.092 5.57333 83.334 5.742C83.576 5.91067 83.873 5.995 84.225 5.995C84.577 5.995 84.8703 5.91067 85.105 5.742C85.347 5.57333 85.5303 5.32033 85.655 4.983C85.7797 4.64567 85.842 4.23133 85.842 3.74C85.842 3.24133 85.7797 2.827 85.655 2.497C85.5303 2.15967 85.347 1.90667 85.105 1.738C84.8703 1.56933 84.577 1.485 84.225 1.485Z"></path>
                     <path d="M21.03 18.37V13.84C21.03 13.7067 21.03 13.57 21.03 13.43C21.0367 13.2833 21.0433 13.13 21.05 12.97C20.8233 13.19 20.5633 13.38 20.27 13.54C19.9833 13.6933 19.6867 13.8033 19.38 13.87L19.18 12.94C19.32 12.92 19.4833 12.8733 19.67 12.8C19.8567 12.7267 20.05 12.6333 20.25 12.52C20.45 12.4067 20.6333 12.2867 20.8 12.16C20.9667 12.0267 21.0967 11.8967 21.19 11.77H22.09V18.37H21.03Z"></path>
                     <path d="M26.1634 18.47C25.3701 18.47 24.7468 18.1833 24.2934 17.61C23.8468 17.03 23.6234 16.1833 23.6234 15.07C23.6234 13.9567 23.8468 13.1133 24.2934 12.54C24.7468 11.96 25.3701 11.67 26.1634 11.67C26.9634 11.67 27.5868 11.96 28.0334 12.54C28.4868 13.1133 28.7134 13.9567 28.7134 15.07C28.7134 16.1833 28.4868 17.03 28.0334 17.61C27.5868 18.1833 26.9634 18.47 26.1634 18.47ZM26.1634 17.56C26.4834 17.56 26.7501 17.47 26.9634 17.29C27.1834 17.1033 27.3468 16.8267 27.4534 16.46C27.5668 16.0867 27.6234 15.6233 27.6234 15.07C27.6234 14.5167 27.5668 14.0567 27.4534 13.69C27.3468 13.3167 27.1834 13.04 26.9634 12.86C26.7501 12.6733 26.4834 12.58 26.1634 12.58C25.8434 12.58 25.5734 12.6733 25.3534 12.86C25.1401 13.04 24.9801 13.3167 24.8734 13.69C24.7668 14.0567 24.7134 14.5167 24.7134 15.07C24.7134 15.6233 24.7668 16.0867 24.8734 16.46C24.9801 16.8267 25.1401 17.1033 25.3534 17.29C25.5734 17.47 25.8434 17.56 26.1634 17.56Z"></path>
                     <path d="M32.4427 18.47C31.6494 18.47 31.0261 18.1833 30.5727 17.61C30.1261 17.03 29.9027 16.1833 29.9027 15.07C29.9027 13.9567 30.1261 13.1133 30.5727 12.54C31.0261 11.96 31.6494 11.67 32.4427 11.67C33.2427 11.67 33.8661 11.96 34.3127 12.54C34.7661 13.1133 34.9927 13.9567 34.9927 15.07C34.9927 16.1833 34.7661 17.03 34.3127 17.61C33.8661 18.1833 33.2427 18.47 32.4427 18.47ZM32.4427 17.56C32.7627 17.56 33.0294 17.47 33.2427 17.29C33.4627 17.1033 33.6261 16.8267 33.7327 16.46C33.8461 16.0867 33.9027 15.6233 33.9027 15.07C33.9027 14.5167 33.8461 14.0567 33.7327 13.69C33.6261 13.3167 33.4627 13.04 33.2427 12.86C33.0294 12.6733 32.7627 12.58 32.4427 12.58C32.1227 12.58 31.8527 12.6733 31.6327 12.86C31.4194 13.04 31.2594 13.3167 31.1527 13.69C31.0461 14.0567 30.9927 14.5167 30.9927 15.07C30.9927 15.6233 31.0461 16.0867 31.1527 16.46C31.2594 16.8267 31.4194 17.1033 31.6327 17.29C31.8527 17.47 32.1227 17.56 32.4427 17.56Z"></path>
                     <path d="M37.362 18.37L41.682 11.77H42.602L38.292 18.37H37.362ZM37.622 11.67C37.962 11.67 38.2554 11.7467 38.502 11.9C38.7554 12.0533 38.9487 12.2667 39.082 12.54C39.222 12.8133 39.292 13.1367 39.292 13.51C39.292 13.8767 39.222 14.2 39.082 14.48C38.9487 14.7533 38.7554 14.9667 38.502 15.12C38.2554 15.2733 37.962 15.35 37.622 15.35C37.2887 15.35 36.9954 15.2733 36.742 15.12C36.4887 14.9667 36.292 14.7533 36.152 14.48C36.0187 14.2 35.952 13.8767 35.952 13.51C35.952 13.1367 36.0187 12.8133 36.152 12.54C36.292 12.2667 36.4887 12.0533 36.742 11.9C36.9954 11.7467 37.2887 11.67 37.622 11.67ZM37.622 12.45C37.4554 12.45 37.312 12.4933 37.192 12.58C37.072 12.66 36.982 12.78 36.922 12.94C36.862 13.0933 36.832 13.2833 36.832 13.51C36.832 13.73 36.862 13.92 36.922 14.08C36.982 14.24 37.072 14.36 37.192 14.44C37.312 14.52 37.4554 14.56 37.622 14.56C37.7954 14.56 37.942 14.52 38.062 14.44C38.182 14.36 38.272 14.24 38.332 14.08C38.392 13.92 38.422 13.73 38.422 13.51C38.422 13.2833 38.392 13.0933 38.332 12.94C38.272 12.78 38.182 12.66 38.062 12.58C37.942 12.4933 37.7954 12.45 37.622 12.45ZM42.342 14.79C42.682 14.79 42.9754 14.8667 43.222 15.02C43.4754 15.1733 43.6687 15.39 43.802 15.67C43.942 15.9433 44.012 16.2633 44.012 16.63C44.012 17.0033 43.942 17.3267 43.802 17.6C43.6687 17.8733 43.4754 18.0867 43.222 18.24C42.9754 18.3933 42.682 18.47 42.342 18.47C42.0087 18.47 41.7154 18.3933 41.462 18.24C41.2087 18.0867 41.012 17.8733 40.872 17.6C40.7387 17.3267 40.672 17.0033 40.672 16.63C40.672 16.2633 40.7387 15.9433 40.872 15.67C41.012 15.39 41.2087 15.1733 41.462 15.02C41.7154 14.8667 42.0087 14.79 42.342 14.79ZM42.342 15.58C42.1754 15.58 42.032 15.62 41.912 15.7C41.792 15.78 41.702 15.9 41.642 16.06C41.582 16.2133 41.552 16.4033 41.552 16.63C41.552 16.85 41.582 17.04 41.642 17.2C41.702 17.36 41.792 17.4833 41.912 17.57C42.032 17.65 42.1754 17.69 42.342 17.69C42.5154 17.69 42.662 17.65 42.782 17.57C42.902 17.4833 42.992 17.36 43.052 17.2C43.112 17.04 43.142 16.85 43.142 16.63C43.142 16.41 43.112 16.22 43.052 16.06C42.992 15.9 42.902 15.78 42.782 15.7C42.662 15.62 42.5154 15.58 42.342 15.58Z"></path>
                     <path d="M50.8628 11.67C51.4561 11.67 51.9695 11.7833 52.4028 12.01C52.8361 12.23 53.2028 12.5567 53.5028 12.99L52.7828 13.68C52.5295 13.2933 52.2428 13.0167 51.9228 12.85C51.6095 12.6767 51.2361 12.59 50.8028 12.59C50.4828 12.59 50.2195 12.6333 50.0128 12.72C49.8061 12.8067 49.6528 12.9233 49.5528 13.07C49.4595 13.21 49.4128 13.37 49.4128 13.55C49.4128 13.7567 49.4828 13.9367 49.6228 14.09C49.7695 14.2433 50.0395 14.3633 50.4328 14.45L51.7728 14.75C52.4128 14.89 52.8661 15.1033 53.1328 15.39C53.3995 15.6767 53.5328 16.04 53.5328 16.48C53.5328 16.8867 53.4228 17.24 53.2028 17.54C52.9828 17.84 52.6761 18.07 52.2828 18.23C51.8961 18.39 51.4395 18.47 50.9128 18.47C50.4461 18.47 50.0261 18.41 49.6528 18.29C49.2795 18.17 48.9528 18.0067 48.6728 17.8C48.3928 17.5933 48.1628 17.3567 47.9828 17.09L48.7228 16.35C48.8628 16.5833 49.0395 16.7933 49.2528 16.98C49.4661 17.16 49.7128 17.3 49.9928 17.4C50.2795 17.5 50.5961 17.55 50.9428 17.55C51.2495 17.55 51.5128 17.5133 51.7328 17.44C51.9595 17.3667 52.1295 17.26 52.2428 17.12C52.3628 16.9733 52.4228 16.8 52.4228 16.6C52.4228 16.4067 52.3561 16.2367 52.2228 16.09C52.0961 15.9433 51.8561 15.83 51.5028 15.75L50.0528 15.42C49.6528 15.3333 49.3228 15.21 49.0628 15.05C48.8028 14.89 48.6095 14.6967 48.4828 14.47C48.3561 14.2367 48.2928 13.9767 48.2928 13.69C48.2928 13.3167 48.3928 12.98 48.5928 12.68C48.7995 12.3733 49.0961 12.13 49.4828 11.95C49.8695 11.7633 50.3295 11.67 50.8628 11.67Z"></path>
                     <path d="M55.0288 18.37V11.77H59.8088V12.69H56.0988V14.59H58.9988V15.49H56.0988V17.45H59.9488V18.37H55.0288Z"></path>
                     <path d="M63.9491 18.47C63.3291 18.47 62.7924 18.3333 62.3391 18.06C61.8857 17.7867 61.5324 17.4 61.2791 16.9C61.0257 16.3933 60.8991 15.7833 60.8991 15.07C60.8991 14.37 61.0291 13.7667 61.2891 13.26C61.5557 12.7533 61.9291 12.3633 62.4091 12.09C62.8957 11.81 63.4524 11.67 64.0791 11.67C64.7657 11.67 65.3191 11.7967 65.7391 12.05C66.1657 12.3033 66.5057 12.6967 66.7591 13.23L65.7691 13.7C65.6424 13.3333 65.4324 13.06 65.1391 12.88C64.8524 12.6933 64.5024 12.6 64.0891 12.6C63.6757 12.6 63.3124 12.6967 62.9991 12.89C62.6924 13.0833 62.4524 13.3667 62.2791 13.74C62.1057 14.1067 62.0191 14.55 62.0191 15.07C62.0191 15.5967 62.0957 16.0467 62.2491 16.42C62.4024 16.7867 62.6324 17.0667 62.9391 17.26C63.2524 17.4533 63.6357 17.55 64.0891 17.55C64.3357 17.55 64.5657 17.52 64.7791 17.46C64.9924 17.3933 65.1791 17.3 65.3391 17.18C65.4991 17.0533 65.6224 16.8967 65.7091 16.71C65.8024 16.5167 65.8491 16.29 65.8491 16.03V15.84H63.9291V14.97H66.7991V18.37H65.9991L65.9391 17.04L66.1391 17.14C65.9791 17.56 65.7124 17.8867 65.3391 18.12C64.9724 18.3533 64.5091 18.47 63.9491 18.47Z"></path>
                     <path d="M73.7654 11.77V15.84C73.7654 16.7133 73.5354 17.37 73.0754 17.81C72.6154 18.25 71.9454 18.47 71.0654 18.47C70.1987 18.47 69.5321 18.25 69.0654 17.81C68.6054 17.37 68.3754 16.7133 68.3754 15.84V11.77H69.4454V15.71C69.4454 16.33 69.5787 16.79 69.8454 17.09C70.112 17.39 70.5187 17.54 71.0654 17.54C71.6187 17.54 72.0287 17.39 72.2954 17.09C72.5621 16.79 72.6954 16.33 72.6954 15.71V11.77H73.7654Z"></path>
                     <path d="M78.2852 11.77C78.9919 11.77 79.5519 11.9467 79.9652 12.3C80.3852 12.6533 80.5952 13.13 80.5952 13.73C80.5952 14.35 80.3852 14.83 79.9652 15.17C79.5519 15.5033 78.9919 15.67 78.2852 15.67L78.1852 15.73H76.6552V18.37H75.5952V11.77H78.2852ZM78.2052 14.84C78.6386 14.84 78.9586 14.7533 79.1652 14.58C79.3786 14.4 79.4852 14.1267 79.4852 13.76C79.4852 13.4 79.3786 13.13 79.1652 12.95C78.9586 12.77 78.6386 12.68 78.2052 12.68H76.6552V14.84H78.2052ZM78.8352 15.06L80.9852 18.37H79.7552L77.9152 15.48L78.8352 15.06Z"></path>
                     <path d="M84.9954 11.67C85.6354 11.67 86.1887 11.8067 86.6554 12.08C87.122 12.3533 87.482 12.7433 87.7354 13.25C87.9887 13.7567 88.1154 14.3633 88.1154 15.07C88.1154 15.7767 87.9887 16.3833 87.7354 16.89C87.482 17.3967 87.122 17.7867 86.6554 18.06C86.1887 18.3333 85.6354 18.47 84.9954 18.47C84.3621 18.47 83.812 18.3333 83.3454 18.06C82.8787 17.7867 82.5187 17.3967 82.2654 16.89C82.0121 16.3833 81.8854 15.7767 81.8854 15.07C81.8854 14.3633 82.0121 13.7567 82.2654 13.25C82.5187 12.7433 82.8787 12.3533 83.3454 12.08C83.812 11.8067 84.3621 11.67 84.9954 11.67ZM84.9954 12.6C84.5821 12.6 84.2254 12.6967 83.9254 12.89C83.6321 13.0833 83.4054 13.3633 83.2454 13.73C83.0854 14.0967 83.0054 14.5433 83.0054 15.07C83.0054 15.59 83.0854 16.0367 83.2454 16.41C83.4054 16.7767 83.6321 17.0567 83.9254 17.25C84.2254 17.4433 84.5821 17.54 84.9954 17.54C85.4154 17.54 85.7721 17.4433 86.0654 17.25C86.3654 17.0567 86.5954 16.7767 86.7554 16.41C86.9154 16.0367 86.9954 15.59 86.9954 15.07C86.9954 14.5433 86.9154 14.0967 86.7554 13.73C86.5954 13.3633 86.3654 13.0833 86.0654 12.89C85.7721 12.6967 85.4154 12.6 84.9954 12.6Z"></path>
               </svg>
            </div>
         </div>
      </div>         
         <div class="w-full max-w-2xl mx-auto p-4 block sm:hidden">
            <ul class="flex items-center justify-between relative">
                <!-- Etapa 1 -->
                <li class="relative flex-1 flex flex-col items-center text-center">
                  <div class="w-10 h-10 flex items-center justify-center rounded-full z-10 transition-colors duration-300" 
                  :class="{ 'step-tag': [1, 2, 3].includes(step) }">             
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                           <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                        </svg>                                         
                    </div>
                    <div class="mt-2 text-xs" :class="{
                     'font-semibold text-black': step === 1,
                     'text-gray-500': [2, 3].includes(step)
                      }">Informações</div>
                </li>
        
                <!-- Linha de conexão -->
                <li class="flex-1 relative">
                  <div class="absolute top-[-15px] left-[-30px] w-[150px] h-1" :class="{
                     'bg-gray-300': step === 1,
                     'step-tag': [2, 3].includes(step)
                 }"></div>
                </li>
        
                <!-- Etapa 2 -->
                <li class="relative flex-1 flex flex-col items-center text-center">
                  <div class="w-10 h-10 flex items-center justify-center rounded-full z-10 transition-colors duration-300"
                  :class="step === 1 ? 'bg-white text-gray-500' : 'step-tag'">          
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                           <path d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25ZM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.375a3 3 0 1 1 6 0h3a.75.75 0 0 0 .75-.75V15Z" />
                           <path d="M8.25 19.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0ZM15.75 6.75a.75.75 0 0 0-.75.75v11.25c0 .087.015.17.042.248a3 3 0 0 1 5.958.464c.853-.175 1.522-.935 1.464-1.883a18.659 18.659 0 0 0-3.732-10.104 1.837 1.837 0 0 0-1.47-.725H15.75Z" />
                           <path d="M19.5 19.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                        </svg>                      
                    </div>
                    <div class="mt-2 text-xs" :class="step === 2 ? 'text-black font-semibold' : 'text-gray-500'">Entrega</div>
                </li>
        
                <!-- Linha de conexão -->
                <li class="flex-1 relative">
                  <div class="absolute top-[-15px] left-[-30px] w-[150px] h-1"
                        :class="step === 3 ? 'step-tag' : 'bg-gray-300'">
                  </div>
              </li>
        
                <!-- Etapa 3 -->
                <li class="relative flex-1 flex flex-col items-center text-center">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full z-10 transition-colors duration-300" :class="{
                        'bg-white text-gray-500': step === 1,
                        'bg-white text-gray-500': step === 2,
                        'step-tag': step === 3
                     }">
                     <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M4.5 3.75a3 3 0 0 0-3 3v.75h21v-.75a3 3 0 0 0-3-3h-15Z" />
                        <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-7.5Zm-18 3.75a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5h-6a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" clip-rule="evenodd" />
                      </svg>                      
                    </div>
                    <div class="mt-2 text-xs text-gray-500":class="{
                     'text-gray-500': step === 1,
                     'text-gray-500': step === 2,
                     'text-black font-semibold': step === 3
                  }">Pagamento</div>
                </li>
            </ul>
        </div> 
         <!-- Informações Pessoais -->
         <div class="w-full flex flex-col items-center">
           <div class="flex flex-col-reverse sm:flex-row justify-center sm:max-w-[1200px] w-full"> 
            <!-- Main Content -->
            <div class="flex justify-end items-start lg:flex-row flex-col p-2 sm:gap-4 gap-2">            
               <div class="flex flex-col w-full lg:max-w-2/3 gap-6">
                  <section  id="lead_personal_info" class="p-6 rounded-lg border border-gray-200" :class="{
                              'block': !isMobile || (isMobile && step === 1), 
                              'hidden': isMobile && step !== 1,
                              'bg-white': step === 1,
                              'bg-[#f9fdf7]': step !== 1
                        }"  x-data="formHandlerPersonalInfo()" >
                     <input type="hidden" name="_token" x-ref="csrfToken" value="{{ csrf_token() }}">
                     <div class="flex gap-2 items-start justify-between pb-2">
                        <div class="flex gap-2">
                           <span class="rounded-full text-white w-4 h-4 font-extrabold text-xs justify-center p-3 flex items-center" :class="step === 1 ? 'step-tag' : 'bg-[#36b376]'">1</span>
                           <div>
                              <h2 class="text-md font-bold text-gray-600" :class="step === 1 ? 'text-gray-500' : 'text-[#36b376]'">Identifique-se</h2>
                              <p class="text-sm mb-4 text-start text-gray-600" :class="step === 1 ? 'block' : 'hidden'">
                                 Utilizaremos seu e-mail para: identificar seu perfil, histórico de compra, notificação de pedidos e carrinho de compras.
                              </p>
                           </div>
                        </div>
                        <div x-show="step !== 1">
                           <button @click="step = 1">
                              <img class="text-gray-500 w-5" id="icon-edit-personal-data" src="https://awesome-assets.yampi.me/checkout/build/mix/assets/img/icons/pencil-edit.svg" style="margin-left: auto;">
                           </button>
                        </div>
                     </div>
                     <div id="step1-summary-container" class="text-gray-500" x-show="step !== 1" style="padding: 1rem; display: none; word-break: break-all">
                        @if($checkout->steps > 1)
                        <p style="padding-top: 0.6rem; font-size: small"><b>Nome completo: </b> <span> {{ $checkout->customer_name }} </span></p>
                        <p style="padding-top: 0.6rem; font-size: small"><b>CPF: </b> <span> {{ $checkout->customer_taxId }} </span></p>
                        <p style="padding-top: 0.6rem; font-size: small"><b>Celular: </b> <span> {{ $checkout->customer_telphone }} </span></p>
                        <p style="padding-top: 0.6rem; font-size: small"><b>E-mail: </b> <span> {{ $checkout->customer_email }} </span></p>
                        @else
                        <p style="padding-top: 0.6rem; font-size: small"><b>Nome completo: </b> <span x-text="form.name"></span></p>
                        <p style="padding-top: 0.6rem; font-size: small"><b>CPF: </b> <span x-text="form.cpf"></span></p>
                        <p style="padding-top: 0.6rem; font-size: small"><b>Celular: </b> <span x-text="form.phone"></span></p>
                        <p style="padding-top: 0.6rem; font-size: small"><b>E-mail: </b> <span x-text="form.email"></span></p>
                        @endif
                     </div>
                     <div class="flex flex-col justify-center gap-6" x-show="step === 1">
                        <div>
                           <label class="block text-xs font-medium text-gray-700 mb-2">Nome completo</label>
                           <input type="text" x-model="form.name" class="text-xs text-gray-800 bg-[#f4f6f8] w-full p-4 focus:border-black border border-gray-200 rounded-md" placeholder="ex.: Maria de Almeida Cruz">
                           <p class="text-red-500 text-xs" x-show="errors.name" x-text="errors.name"></p>
                        </div>
                        <div>
                           <label class="block text-xs font-medium text-gray-700 mb-2">E-mail <span class="text-[10px] btn-tertiary">(Para Envio do Código de Rastreio)</span></label>
                           <input type="email" x-model="form.email" @input="validateEmail" class="text-xs text-gray-800 bg-[#f4f6f8] w-full p-4 focus:border-black border border-gray-200 rounded-md" placeholder="Ex.: seu.e-mail@gmail.com">
                           <p class="text-red-500 text-xs" x-show="errors.email" x-text="errors.email"></p>
                        </div>
                        <div>
                           <label class="block text-xs font-medium text-gray-700 mb-2">CPF</label>
                           <input type="text" x-model="form.cpf" @input="validateCPF" class="text-xs text-gray-800 bg-[#f4f6f8] p-4 focus:border-black border border-gray-200 rounded-md" placeholder="000.000.000-00">
                           <p class="text-red-500 text-xs" x-show="errors.cpf" x-text="errors.cpf"></p>
                        </div>
                        <div>
                           <label class="block text-xs font-medium text-gray-700 mb-2">Celular/WhatsApp</label>
                           <input type="text" x-model="form.phone" @input="validatePhone" class="text-xs text-gray-800 bg-[#f4f6f8] w-full p-4 focus:border-black border border-gray-200 rounded-md" placeholder="(00) 00000-0000">
                           <p class="text-red-500 text-xs" x-show="errors.phone" x-text="errors.phone"></p>
                        </div>
                        <button @click="submitformHandlerPersonalInfo" class="w-full btn-primary py-4 rounded-md font-bold text-sm transition-colors flex gap-4 justify-center items-center">Continuar <svg width="17" height="13" viewBox="0 0 17 13" fill="white" xmlns="http://www.w3.org/2000/svg">
                           <path d="M10.4913 0.083736L8.9516 1.66506C8.84623 1.7729 8.84652 1.94512 8.95215 2.05271L11.5613 4.71372L0.277266 4.71372C0.124222 4.71372 -3.2782e-07 4.83794 -3.21005e-07 4.99098L-2.22234e-07 7.20921C-2.1542e-07 7.36225 0.124222 7.48648 0.277266 7.48648L11.5613 7.48648L8.95216 10.1475C8.84678 10.2551 8.84652 10.427 8.9516 10.5348L10.4913 12.1162C10.5435 12.1699 10.615 12.2002 10.6899 12.2002C10.7647 12.2002 10.8363 12.1697 10.8884 12.1162L16.5579 6.29335C16.6103 6.23958 16.6366 6.16968 16.6366 6.10008C16.6366 6.03022 16.6103 5.96062 16.5579 5.90655L10.8884 0.083736C10.8363 0.0302186 10.7647 4.91753e-07 10.6899 4.94966e-07C10.615 4.98178e-07 10.5435 0.0302186 10.4913 0.083736Z"></path>
                           </svg></button>
                     </div>
                  </section>
                  <script>
                     function formHandlerPersonalInfo() {
                         return {
                             form: {
                                 email: '',
                                 name: '',
                                 cpf: '',
                                 phone: '',
                                 checkoutToken: checkoutToken,
                             },
                             errors: {
                                 email: '',
                                 cpf: '',
                                 phone: '',
                                 name: '',  // Adicionando erro para o nome
                             },
                             validateEmail() {
                                 const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                                 this.errors.email = emailPattern.test(this.form.email) ? '' : 'E-mail inválido';
                             },
                             validateCPF() {
                                 let cpf = this.form.cpf.replace(/\D/g, ''); // Remove caracteres não numéricos
                                 
                                 if (cpf.length > 11) {
                                     cpf = cpf.slice(0, 11); // Limita ao máximo de 11 números
                                 }
                 
                                 // Aplica a máscara automaticamente
                                 this.form.cpf = cpf
                                     .replace(/^(\d{3})(\d)/, '$1.$2')
                                     .replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3')
                                     .replace(/^(\d{3})\.(\d{3})\.(\d{3})(\d)/, '$1.$2.$3-$4');
                 
                                 // Verifica se está no formato correto
                                 const cpfPattern = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
                                 if (!cpfPattern.test(this.form.cpf)) {
                                     this.errors.cpf = 'CPF inválido';
                                     return;
                                 }
                 
                                 // Remove pontos e traço para validar os dígitos
                                 cpf = cpf.replace(/\D/g, '');
                 
                                 // Elimina CPFs inválidos conhecidos (como 000.000.000-00, 111.111.111-11, etc.)
                                 if (/^(\d)\1+$/.test(cpf)) {
                                     this.errors.cpf = 'CPF inválido';
                                     return;
                                 }
                 
                                 // Validação do primeiro dígito verificador
                                 let sum = 0;
                                 for (let i = 0; i < 9; i++) {
                                     sum += parseInt(cpf[i]) * (10 - i);
                                 }
                                 let firstCheck = (sum * 10) % 11;
                                 if (firstCheck === 10 || firstCheck === 11) firstCheck = 0;
                 
                                 if (firstCheck !== parseInt(cpf[9])) {
                                     this.errors.cpf = 'CPF inválido';
                                     return;
                                 }
                 
                                 // Validação do segundo dígito verificador
                                 sum = 0;
                                 for (let i = 0; i < 10; i++) {
                                     sum += parseInt(cpf[i]) * (11 - i);
                                 }
                                 let secondCheck = (sum * 10) % 11;
                                 if (secondCheck === 10 || secondCheck === 11) secondCheck = 0;
                 
                                 if (secondCheck !== parseInt(cpf[10])) {
                                     this.errors.cpf = 'CPF inválido';
                                     return;
                                 }
                 
                                 // Se passou por todas as verificações, o CPF é válido
                                 this.errors.cpf = '';
                             },
                 
                             validatePhone() {
                                 let phone = this.form.phone.replace(/\D/g, ''); // Remove caracteres não numéricos
                                 
                                 if (phone.length > 11) {
                                     phone = phone.slice(0, 11); // Limita ao máximo de 11 números
                                 }
                                 
                                 // Aplica a máscara automaticamente
                                 this.form.phone = phone
                                     .replace(/^(\d{2})(\d)/, '($1) $2')
                                     .replace(/^(\(\d{2}\)) (\d{5})(\d)/, '$1 $2-$3');
                 
                                 // Valida se está no formato correto
                                 const phonePattern = /^\(\d{2}\) \d{5}-\d{4}$/;
                                 this.errors.phone = phonePattern.test(this.form.phone) ? '' : 'Celular inválido';
                             },
                 
                             async submitformHandlerPersonalInfo() {
                                 // Validações dos campos
                                 this.validateEmail();
                                 this.validateCPF();
                                 this.validatePhone();
                                 
                                 // Verifica se o campo 'name' está vazio
                                 if (!this.form.name) {
                                     this.errors.name = 'Nome é obrigatório';
                                     return;
                                 } else {
                                     this.errors.name = ''; // Limpa o erro se o campo estiver preenchido
                                 }
                 
                                 // Verifica se há outros erros antes de enviar os dados
                                 if (this.errors.email || this.errors.cpf || this.errors.phone || this.errors.name) {
                                     return;
                                 }
                 
                                 try {
                                     console.log('Enviando dados...', this.form);  // Logando os dados que estão sendo enviados
                 
                                     const response = await fetch('/api/checkout/customers/personal_data', {
                                         method: 'POST',
                                         headers: {
                                             'Content-Type': 'application/json',
                                             'Accept': 'application/json',
                                             'X-CSRF-Token': csrfToken,  // CSRF token no cabeçalho
                                         },
                                         body: JSON.stringify(this.form)
                                     });
                 
                                     if (!response.ok) {
                                         console.error('Resposta não ok:', response);  // Logando a resposta para ver o status
                                         throw new Error('Erro ao enviar os dados');
                                     }
                 
                                     const data = await response.json();
                                     console.log('Resposta recebida:', data);
                                     this.step++;
                                 } catch (error) {
                                     console.error('Erro ao enviar os dados:', error);  // Logando o erro completo
                                     alert('Erro ao enviar os dados. Tente novamente.');
                                 }
                             }
                         };
                     }
                 </script>                                     
                  <section id="lead_ship_adress" class="p-6 rounded-lg border border-gray-200" :class="{
                     'hidden': isMobile && step !== 2,
                     'block': !isMobile,
                     'bg-white bg-opacity-40': step === 1,
                     'bg-white': step === 2,
                     'bg-[#f9fdf7]': step === 3
                   }"
                  x-data="checkoutForm()">
                     <div class="flex gap-2 justify-between items-start pb-2">
                        <div class="flex items-start gap-2">
                           <span class="rounded-full w-4 h-4 font-extrabold text-xs justify-center p-3 flex items-center" :class="{
                                 'bg-gray-500': step === 1,
                                 'step-tag': step === 2,
                                 'bg-[#36b376]': step === 3
                              }">2</span>
                           <div>
                              <h2 class="text-md font-semibold"  :class="{
                                 'text-gray-500': step !== 3,
                                 'text-[#36b376]': step === 3
                             }">Endereço De Entrega</h2>
                              <p class="text-sm mb-4" :class="step === 3 ? 'hidden' : 'text-gray-400'">Agora precisamos do seu endereço para entrega.</p>
                           </div>
                        </div>
                        <div x-show="step === 3">
                           <button @click="step = 2">
                              <img class="text-gray-500 w-5" id="icon-edit-personal-data" src="https://awesome-assets.yampi.me/checkout/build/mix/assets/img/icons/pencil-edit.svg" style="margin-left: auto;">
                           </button>
                        </div>
                     </div>
                     <div id="step1-summary-container" class="text-gray-500" x-show="step === 3" style="padding: 1rem; display: none; word-break: break-all">
                        @if($checkout->steps > 2)
                           @php
                              // Decodificando a string JSON e acessando os dados aninhados corretamente
                              $shippingAddress = json_decode($checkout->customer_shipping_address, true);
                              $address = $shippingAddress['address'] ?? []; // Verificar se a chave 'address' existe
                           @endphp
                           <p style="padding-top: 0.6rem; font-size: small"><b>Cep: </b> <span> {{ $address['cep'] ?? 'N/A' }} </span></p>
                           <p style="padding-top: 0.6rem; font-size: small"><b>Endereço: </b> <span> {{ $address['logradouro'] ?? 'N/A' }} </span></p>
                           <p style="padding-top: 0.6rem; font-size: small"><b>Numero: </b> <span> {{ $shippingAddress['numero'] ?? 'N/A' }} </span></p>
                           <p style="padding-top: 0.6rem; font-size: small"><b>Frete: </b> <span> {{ $checkout->frete->name }} - {{ $checkout->frete->min_delivery_days }} dias ou até {{ $checkout->frete->max_delivery_days }} dias - R$ {{ number_format($checkout->frete->price, 2, ',', '.') }} </span></p>
                        @else
                           <p style="padding-top: 0.6rem; font-size: small"><b>Cep: </b> <span x-text="form.cep"></span></p>
                           <p style="padding-top: 0.6rem; font-size: small"><b>Endereço: </b> <span x-text="form.endereco"></span></p>
                           <p style="padding-top: 0.6rem; font-size: small"><b>Numero: </b> <span x-text="form.numero"></span></p>
                           <p style="padding-top: 0.6rem; font-size: small"><b>Frete: </b> 
                              <span x-text="`${form.frete.name} - ${form.frete.prazo} - R$ ${form.frete.price.toFixed(2).replace('.', ',')}`"></span>
                           </p>
                        @endif
                     </div>
                     <div id="section_content" x-show="step === 2" class="flex flex-col justify-start">
                        <div x-data="freteForm">
                           <section id="firstStepFrete">
                              <div class="space-y-4">
                                 <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">CEP</label>
                                    <input 
                                       type="text" 
                                       x-model="form.cep" 
                                       placeholder="00000-000" 
                                       class="w-1/2 text-xs text-gray-800 bg-[#f4f6f8] w-full p-4 focus:border-black border border-gray-200 rounded-md"
                                       @input="fetchFrete"
                                    >
                                    <p class="text-red-500 text-xs mt-1" x-show="errors.cep">Campo obrigatório</p>
                                 </div>
                           
                                 <div x-show="!loading && freteData" class="transition-all">
                                    <div>
                                       <label class="block text-xs font-medium text-gray-700 mb-1">Endereço</label>
                                       <input 
                                          type="text" 
                                          x-model="form.endereco" 
                                          placeholder="Informe seu endereço sem número" 
                                          class="w-full text-xs text-gray-800 bg-[#f4f6f8] w-full p-4 focus:border-black border border-gray-200 rounded-md"
                                       >
                                       <p class="text-red-500 text-xs mt-1" x-show="errors.endereco">Campo obrigatório</p>
                                    </div>
                           
                                    <div class="flex space-x-4 mt-4">
                                       <div class="w-1/3">
                                          <label class="block text-xs font-medium text-gray-700 mb-1">Número</label>
                                          <input 
                                             type="text" 
                                             x-model="form.numero" 
                                             placeholder="100" 
                                             class="w-full text-xs text-gray-800 bg-[#f4f6f8] w-full p-4 focus:border-black border border-gray-200 rounded-md"
                                          >
                                          <p class="text-red-500 text-xs mt-1" x-show="errors.numero">Campo obrigatório</p>
                                       </div>
                                       <div class="w-2/3">
                                          <label class="block text-xs font-medium text-gray-700 mb-1">Bairro</label>
                                          <input 
                                             type="text" 
                                             x-model="form.bairro" 
                                             placeholder="Informe seu bairro" 
                                             class="w-full text-xs text-gray-800 bg-[#f4f6f8] w-full p-4 focus:border-black border border-gray-200 rounded-md"
                                          >
                                          <p class="text-red-500 text-xs mt-1" x-show="errors.bairro">Campo obrigatório</p>
                                       </div>
                                    </div>
                           
                                    <div class="mt-4">
                                       <label class="block text-xs font-medium text-gray-700 mb-1">Complemento</label>
                                       <input 
                                          type="text" 
                                          x-model="form.complemento" 
                                          placeholder="Informe seu complemento" 
                                          class="w-full text-xs text-gray-800 bg-[#f4f6f8] w-full p-4 focus:border-black border border-gray-200 rounded-md"
                                       >
                                    </div>
                                 </div>
                           
                                 <div x-show="loading" class="text-xs text-gray-500">Consultando o cep...</div>
                           
                                 <p x-show="errors.general" class="text-red-500 text-xs mt-2" x-text="errors.general"></p>
                           
                                 <button 
                                    x-show="!loading && freteData && step2Visible !== true" 
                                    @click="submitFrete" 
                                    class="w-full mt-4 btn-primary py-4 rounded-md font-bold text-sm transition-colors flex gap-4 justify-center items-center"
                                 >
                                    ESCOLHER FRETE
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                    </svg>
                                 </button>                              
                              </div>
                           </section>
                           
                     <script>
                          document.addEventListener('alpine:init', () => {
                           Alpine.data('freteForm', () => ({
                              form: {
                                 cep: '',
                                 endereco: '',
                                 numero: '',
                                 bairro: '',
                                 complemento: '',
                                 frete: '',
                                 checkoutToken: checkoutToken,
                              },
                              step2Visible: false,
                              errors: {},
                              freteData: null,
                              loading: false,
                              timeout: null,

                              async fetchFrete() {
                                 this.errors = {};

                                 if (!this.form.cep) {
                                    this.errors.cep = "Campo obrigatório";
                                    return;
                                 }

                                 clearTimeout(this.timeout);
                                 this.loading = true;

                                 this.timeout = setTimeout(async () => {
                                    try {
                                       const response = await fetch('/api/checkout/shipment/cep_lookup', {
                                          method: 'POST',
                                          headers: { 'Content-Type': 'application/json' },
                                          body: JSON.stringify({
                                             checkoutToken: checkoutToken,
                                             cep: this.form.cep
                                          })
                                       });

                                       if (!response.ok) throw new Error('Erro ao consultar o frete');

                                       this.freteData = await response.json();
                                       this.form.endereco = this.freteData.logradouro || '';
                                       this.form.bairro = this.freteData.bairro || '';
                                       this.form.complemento = this.freteData.complemento || '';
                                       this.loading = false;
                                    } catch (error) {
                                       console.error(error);
                                       this.errors.general = "Não foi possível consultar o frete. Tente novamente.";
                                       this.loading = false;
                                    }
                                 }, 500);
                              },

                              async submitFrete() {
                                 this.loading = true;

                                 // Enviar os dados para o endpoint de frete
                                 try {
                                    const response = await fetch('/api/checkout/customers/receive_customer_shipment_address', {
                                       method: 'POST',
                                       headers: {
                                          'Content-Type': 'application/json',
                                       },
                                       body: JSON.stringify({
                                          address: this.freteData,
                                          numero: this.form.numero,
                                          complemento: this.form.complemento, // Adiciona o campo numero
                                          checkoutToken: checkoutToken,
                                       }),
                                    });

                                    if (!response.ok) {
                                       throw new Error('Erro ao escolher frete');
                                    }

                                    // Se o envio for bem-sucedido, você pode manipular a resposta conforme necessário
                                    const responseData = await response.json();
                                    console.log('Resposta do envio de frete:', responseData);

                                    // Correção para atribuir o valor de step2Visible
                                    this.step2Visible = true;

                                    // Exemplo de redirecionamento ou próxima ação
                                 } catch (error) {
                                    console.error(error);
                                    this.errors.general = "Não foi possível escolher o frete. Tente novamente.";
                                 } finally {
                                    this.loading = false;
                                 }
                              },
                           }));
                        });
                     </script>                           
                       
                           <section id="SecondSection" 
                                 x-data="{
                                    fretes: [], 
                                    form: { frete_id: null }, 
                                    fetchFretes() {
                                          fetch('/api/checkout/list/list_shippiment_methods', {
                                             method: 'POST',
                                             headers: { 'Content-Type': 'application/json' },
                                             body: JSON.stringify({ checkoutToken: checkoutToken })
                                          })
                                          .then(response => response.json())
                                          .then(data => {
                                             console.log('Fretes carregados:', data);
                                             this.fretes = data;
                                          })
                                          .catch(error => console.error('Erro ao buscar fretes:', error));
                                    },
                                    enviarFreteSelecionado() {
                                          if (!this.form.frete_id) {
                                             alert('Por favor, selecione um frete.');
                                             return;
                                          }
                                          fetch('/api/checkout/recive/recive_selected_shippiment_method', {
                                             method: 'POST',
                                             headers: { 'Content-Type': 'application/json' },
                                             body: JSON.stringify({
                                                checkoutToken: checkoutToken,
                                                frete_id: this.form.frete_id
                                             })
                                          })
                                          .then(response => response.json())
                                          .then(data => {
                                             console.log('Frete selecionado:', data);
                                             this.step++;
                                             calculateTotal(checkoutToken);
                                          })
                                          .catch(error => console.error('Erro ao enviar frete:', error));
                                    }
                                 }"
                                 x-init="fetchFretes()"
                                 x-show="step2Visible"
                                 x-cloak
                              >
                                 <div class="mt-6">
                                    <h3 class="text-gray-800 text-sm font-semibold mb-2">Forma de Envio</h3>
                                    <div class="space-y-2">
                                          <template x-for="frete in fretes" :key="frete.id">
                                             <label 
                                                class="flex items-center justify-between text-xs text-gray-700 cursor-pointer rounded-md p-4 border transition-all"
                                                :class="{
                                                      'bg-gray-50 border-2 border-[{{ $customizations['appearance_tag_color_second'] }}]': form.frete_id === frete.id,
                                                      'bg-white border border-gray-300': form.frete_id !== frete.id
                                                }"
                                                :for="'frete-' + frete.id"
                                             >
                                                <div>
                                                      <input 
                                                         type="radio" 
                                                         :id="'frete-' + frete.id"
                                                         name="frete" 
                                                         x-model.number="form.frete_id" 
                                                         :value="frete.id" 
                                                         class="mr-2 border-gray-300 text-black focus:ring-black"
                                                      >
                                                      <span x-text="frete.name"></span>
                                                </div>
                                                <span class="text-gray-500" x-text="`${frete.min_delivery_days} a ${frete.max_delivery_days} dias`"></span>
                                                <span class="font-semibold" x-text="frete.price > 0 ? `R$ ${parseFloat(frete.price).toFixed(2).replace('.', ',')}` : 'Grátis'"></span>
                                             </label>
                                          </template>
                                    </div>
                                    <button @click="enviarFreteSelecionado()" class="w-full mt-4 btn-primary py-4 rounded-md font-bold text-sm transition-colors flex gap-4 justify-center items-center">
                                          CONTINUAR →
                                    </button>
                                 </div>
                              </section>                
                          
                       </div>                 
                       
                     </div>
                  </section>
                  <script>
                     function checkoutForm() {
                         return {
                             form: {
                                 cep: '',
                                 endereco: '',
                                 numero: '',
                                 complemento: '',
                                 bairro: '',
                                 checkoutToken: checkoutToken,
                                 frete: '', // O frete será salvo aqui
                             },
                             errors: {
                                 cep: false,
                                 endereco: false,
                                 numero: false,
                                 bairro: false,
                             },
                             async submitForm() {
                                 // Resetando os erros
                                 this.errors = {
                                     cep: !this.form.cep.trim(),
                                     endereco: !this.form.endereco.trim(),
                                     numero: !this.form.numero.trim(),
                                     bairro: !this.form.bairro.trim(),
                                 };
                     
                                 // Se houver erros, não envia o formulário
                                 if (Object.values(this.errors).some(error => error)) {
                                     console.warn('Erro no formulário:', this.errors);
                                     return;
                                 }
                     
                                 // Verifica qual frete foi selecionado
                                 const freteSelecionado = document.querySelector('input[name="frete"]:checked');
                                 if (freteSelecionado) {
                                     this.form.frete = freteSelecionado.value;
                                 } else {
                                     alert('Selecione uma forma de envio.');
                                     return;
                                 }
                     
                                 try {
                                     console.log('Enviando dados...', this.form);
                     
                                     const response = await fetch('/api/checkout/customers/receive_customer_shipment_address', {
                                         method: 'POST',
                                         headers: {
                                             'Content-Type': 'application/json',
                                             'Accept': 'application/json',
                                             'X-CSRF-Token': csrfToken, // Certifique-se de que essa variável está definida
                                         },
                                         body: JSON.stringify(this.form),
                                     });
                     
                                     const data = await response.json();
                     
                                     if (!response.ok) {
                                         console.error('Erro ao enviar os dados:', data);
                                         alert(data.message || 'Erro ao enviar os dados.');
                                         return;
                                     }
                     
                                     console.log('Resposta recebida:', data);
                                     this.step++;
                     
                                 } catch (error) {
                                     console.error('Erro na requisição:', error);
                                     alert('Erro ao conectar ao servidor. Tente novamente.');
                                 }
                             }
                         };
                     }
                  </script>  
               </div>







               <section x-data="{ paymentMethod: '' }" id="payment_method" class="p-6 rounded-md border border-gray-200 w-full lg:max-w-2/3" :class="{
                        'hidden': isMobile && step !== 3,
                        'bg-white': step === 3,
                        'bg-white bg-opacity-40': step !== 3
                  }">
                  <div class="flex gap-2 items-start pb-2">
                     <div class="flex items-start gap-2">
                        <span class="rounded-full text-white w-4 h-4 font-extrabold text-xs justify-center p-3 flex items-center" :class="step === 3 ? 'step-tag' : 'bg-gray-500'">3</span>
                        <div>
                           <h2 class="text-md font-bold" :class="step === 3 ? 'text-gray-500' : 'text-gray-500'">Pagamento</h2>
                           <p class="text-gray-400 text-sm mb-4">Para finalizar seu pedido escolha uma forma de pagamento</p>
                        </div>
                     </div>
                  </div>


                  <div id="data-lead-checkout" x-show="step === 3" class="flex flex-col justify-start gap-3 max-w-full">
                     <!-- CARD FORM -->
                     <div class="p-4 rounded-lg max-w-full md:max-w-[350px]" :class="paymentMethod === 'card' ? 'border-2 border-[{{ $customizations['appearance_tag_color_second'] }}] bg-gray-50' : 'border border-gray-400'">
                        <div @click="paymentMethod = 'card'" class="flex flex-col gap-2 items-start cursor-pointer max-w-full md:max-w-[350px]">
                           <div class="flex items-center gap-2 relative">
                              <!-- Input Fake de Radio -->
                              <div class="relative w-4 h-4 flex items-center justify-center">
                                 <div class="w-4 h-4 rounded-full" :class="paymentMethod === 'card' ? 'border-4 border-black bg-white' : 'border border-gray-400 bg-transparent'"></div>
                              </div>
                           
                              <!-- Label -->
                              <label for="payment-credit-card" class="text-xs text-black relative">
                                 Cartão de Crédito
                                 <!-- Selo "APROVAÇÃO IMEDIATA" -->
                                 <span class="absolute top-2 -translate-y-1/2 sm:right-[-190px] right-[-170px] bg-[{{ $customizations['appearance_button_color_second'] }}] text-[{{ $customizations['appearance_text_color_second'] }}] px-2 text-[9px] font-bold rounded-md">
                                    APROVAÇÃO IMEDIATA
                                 </span>
                                 @if(isset($payment_discount_credit_card->discount_percentage) > 0)
                                       <span class="absolute top-7 -translate-y-1/2 sm:right-[-190px] right-[-170px] discount-flag px-2 text-[9px] font-bold rounded-md">
                                          {{ (int) $payment_discount_credit_card->discount_percentage }}% DE DESCONTO
                                       </span>
                                 @endif                             
                              </label>
                              
                           </div>                           
                          
                           <div id="card-group" class="flex flex-row justify-start p-2 pb-4 ml-4">
                              <div class="flex flex-row justify-center items-center gap-2 w-50">
                                 <div id="amex">
                                    <svg width="25" height="auto" viewBox="0 0 39 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M39 22.75C39 24.5375 37.5375 26 35.75 26H3.25C1.4625 26 0 24.5375 0 22.75V3.25C0 1.4625 1.4625 0 3.25 0H35.75C37.5375 0 39 1.4625 39 3.25V22.75Z" fill="white"></path>
                                       <path d="M35.75 0H3.25C1.4625 0 0 1.4625 0 3.25V22.75C0 24.5375 1.4625 26 3.25 26H35.75C37.5375 26 39 24.5375 39 22.75V3.25C39 1.4625 37.5375 0 35.75 0ZM35.75 0.65C37.1839 0.65 38.35 1.8161 38.35 3.25V22.75C38.35 24.1839 37.1839 25.35 35.75 25.35H3.25C1.8161 25.35 0.65 24.1839 0.65 22.75V3.25C0.65 1.8161 1.8161 0.65 3.25 0.65H35.75Z" fill="#B3B3B3"></path>
                                       <path d="M9.91172 11.56L10.7482 13.2998H9.00978L9.91172 11.56ZM25.2749 14.2856H22.3678V13.343H25.2749V12.4861H22.3678V11.715H25.2749V10.9864L27.4316 12.932L25.2749 14.8865V14.2856ZM28.287 12.2454L26.8619 10.8569H21.1426V15.1425H26.6725L28.2406 13.7368L29.8177 15.1425H31.2907L29.039 12.974L31.3576 10.8569H29.8184L28.287 12.2454ZM20.0492 10.8569H18.0538L16.5527 13.7286L14.9375 10.8569H12.9421V15.0142L10.8805 10.8569H9.00908L6.80458 15.1425H8.15361L8.6 14.1656H11.165L11.6783 15.1425H14.1581V11.654L15.9155 15.1425H17.0744L18.8227 11.7137V15.1425H20.0485L20.0492 10.8569ZM10.3391 15.1171H9.46462H10.3391ZM9.46815 15.0536L9.01964 16H5L8.17262 10H15.75L16.5147 11.325L17.2293 10H19.921H21.2778H27.4449L28.318 10.8238L29.2558 10H34L30.6316 12.993L33.8543 16H29.2636L28.2363 15.1165L27.2175 16H21.2778H19.921H10.8306L10.3377 15.0536H9.46815Z" fill="#129AD7"></path>
                                    </svg>
                                 </div>
                                 <div id="aura">
                                    <svg width="25" height="auto" viewBox="0 0 39 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M38.5 22.75C38.5 24.5375 37.5375 25.5 35.75 25.5H3.25001C1.46251 25.5 0.5 24.5375 0.5 22.75L0.500013 3.25C0.500013 1.4625 1.46251 0.5 3.25001 0.5H35.75C37.5375 0.5 38.5 1.4625 38.5 3.25V22.75Z" fill="#152884"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M0.5 15.2555V22.7526C0.5 24.5401 1.46256 25.5 3.25006 25.5H35.5C37.2875 25.5 38.5 24.5401 38.5 22.7526V16.1447C31.3942 13.7761 19.8791 10.3278 0.5 15.2555Z" fill="#FFED00"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M0.500006 12.759L0.5 16.5544C19.8791 11.6274 31.3942 15.0756 38.5 17.4429V13.4792C33.5477 11.6423 19.6691 7.53042 0.500006 12.759Z" fill="#EB212E"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M12.4202 10.5033C13.3946 7.81038 15.6247 5.48468 19.5 5.51003C23.3746 5.53603 25.959 7.74928 26.6565 10.645C21.6632 10.1263 18.3346 10.0353 12.4202 10.5033Z" fill="#FFED00"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M11.2244 17.759L8.58731 21.6928H9.54476L10.3014 20.502H13.1763L13.9765 21.6928H15.0054L12.1955 17.759H11.2244ZM10.5678 20.0759H10.569L10.5665 20.0798L10.5678 20.0759ZM10.569 20.0759L11.3231 18.9287C11.4758 18.6921 11.6006 18.4379 11.6936 18.1721C11.8392 18.4535 12.0017 18.7259 12.1791 18.9878L12.896 20.0759H10.569ZM22.4238 21.6892V18.8429H23.1804V19.2738C23.3292 19.1042 23.5125 18.9683 23.7173 18.8741C23.8895 18.8084 24.0728 18.7753 24.2574 18.7772C24.5532 18.7779 24.8463 18.8292 25.1245 18.9287L24.834 19.3824C24.6357 19.3128 24.4271 19.2771 24.2165 19.2764C24.0455 19.2738 23.8765 19.3063 23.7186 19.372C23.5873 19.4227 23.4768 19.5156 23.4053 19.6365C23.311 19.8088 23.2623 20.0025 23.2649 20.1994V21.6899L22.4238 21.6892ZM28.6982 21.6617C29.0128 21.5902 29.3176 21.4823 29.6062 21.3393L29.5913 21.3471C29.614 21.4771 29.6719 21.5987 29.759 21.6981H30.6397C30.5422 21.6032 30.4688 21.4856 30.4265 21.3562C30.3771 21.0761 30.3583 20.7907 30.3719 20.506V19.8632C30.3791 19.7137 30.3648 19.5642 30.331 19.4186C30.279 19.2853 30.188 19.1703 30.069 19.0903C29.8883 18.9824 29.6894 18.909 29.4821 18.8739C29.1408 18.8095 28.7944 18.7809 28.4473 18.7874C28.0683 18.7829 27.6901 18.8167 27.3183 18.8875C27.0531 18.9304 26.7996 19.0286 26.574 19.1748C26.4044 19.297 26.2757 19.4673 26.2048 19.6636L27.0277 19.7286C27.107 19.5388 27.2572 19.3874 27.447 19.3068C27.7297 19.2132 28.028 19.1722 28.3257 19.1872C28.654 19.1683 28.9816 19.2242 29.2851 19.3503C29.4424 19.4264 29.5373 19.5908 29.5243 19.765V19.8905C29.0264 19.9756 28.5246 20.0309 28.0203 20.0569C27.6875 20.0796 27.4379 20.1056 27.2728 20.1297C27.066 20.1589 26.8633 20.2096 26.6676 20.2811C26.5045 20.3403 26.3563 20.4352 26.2334 20.558C26.1288 20.6581 26.0683 20.7959 26.067 20.9409C26.067 21.1788 26.212 21.3731 26.5071 21.5265C26.8022 21.6799 27.2214 21.7553 27.7674 21.7553C28.08 21.7573 28.392 21.7261 28.6982 21.6617ZM28.1588 20.4481C28.6209 20.4182 29.0811 20.3571 29.5355 20.2648L29.5361 20.437C29.5485 20.6093 29.5004 20.7802 29.3996 20.92C29.2482 21.0812 29.0551 21.1969 28.8413 21.2541C28.5605 21.3392 28.268 21.3802 27.9742 21.375C27.7187 21.388 27.4639 21.3444 27.228 21.2463C27.059 21.1598 26.9725 21.0526 26.9725 20.9239C26.9764 20.8335 27.0193 20.7497 27.0908 20.6951C27.1877 20.6184 27.3021 20.5664 27.4236 20.5436C27.6661 20.4942 27.9118 20.4624 28.1588 20.4481ZM19.6249 21.2728V21.6901V21.6908H20.3802V18.8444H19.5371V20.3726C19.5501 20.5682 19.5014 20.7632 19.398 20.9296C19.2771 21.0778 19.112 21.1838 18.9274 21.2325C18.698 21.3079 18.4575 21.345 18.2163 21.343C17.9986 21.3495 17.7815 21.3131 17.578 21.2358C17.4298 21.1831 17.3089 21.0746 17.2407 20.9329C17.1971 20.7671 17.1802 20.5949 17.1893 20.4233V18.8451H16.3463V20.6079C16.3398 20.7606 16.3567 20.914 16.3976 21.0616C16.4477 21.2033 16.538 21.3274 16.6576 21.4184C16.8279 21.5361 17.021 21.6186 17.2238 21.6602C17.4929 21.7259 17.7685 21.7577 18.0454 21.7558C18.7097 21.7558 19.2368 21.5946 19.6249 21.2728Z" fill="#152884"></path>
                                       <path d="M35.75 0H3.25C1.4625 0 0 1.4625 0 3.25V22.75C0 24.5375 1.4625 26 3.25 26H35.75C37.5375 26 39 24.5375 39 22.75V3.25C39 1.4625 37.5375 0 35.75 0ZM35.75 0.65C37.1839 0.65 38.35 1.8161 38.35 3.25V22.75C38.35 24.1839 37.1839 25.35 35.75 25.35H3.25C1.8161 25.35 0.65 24.1839 0.65 22.75V3.25C0.65 1.8161 1.8161 0.65 3.25 0.65H35.75Z" fill="#B3B3B3"></path>
                                    </svg>
                                 </div>
                                 <!---->
                                 <div id="discover">
                                    <svg width="25" height="auto" viewBox="0 0 39 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M39 22.75C39 24.5375 37.5375 26 35.75 26H3.25C1.4625 26 0 24.5375 0 22.75V3.25C0 1.4625 1.4625 0 3.25 0H35.75C37.5375 0 39 1.4625 39 3.25V22.75Z" fill="white"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M38.3706 18V22.5634C38.3706 22.9821 38.2848 23.3812 38.1303 23.7445C37.9751 24.1077 37.7524 24.4363 37.4768 24.7119C37.2012 24.9876 36.8732 25.2102 36.5094 25.3654C36.1449 25.52 35.7464 25.6057 35.3283 25.6057H21.6642H8L38.3706 18Z" fill="#F16821"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M20.4494 10.7782C19.1128 10.7782 18.0276 11.8226 18.0276 13.1108C18.0276 14.4806 19.065 15.5056 20.4494 15.5056C21.7978 15.5056 22.8623 14.4682 22.8623 13.1392C22.8623 11.815 21.8048 10.7782 20.4494 10.7782V10.7782Z" fill="url(#paint0_linear)"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M14.123 13.1079C14.123 14.4556 15.1819 15.5007 16.5434 15.5007C16.9285 15.5007 17.2588 15.4252 17.664 15.2327V14.18C17.3052 14.538 16.9901 14.6821 16.5843 14.6821C15.6833 14.6821 15.0434 14.029 15.0434 13.101C15.0434 12.2208 15.7041 11.5268 16.5434 11.5268C16.9694 11.5268 17.2921 11.6778 17.664 12.0428V10.9901C17.272 10.7906 16.9486 10.7082 16.5642 10.7082C15.2096 10.7082 14.123 11.7748 14.123 13.1079ZM25.1373 15.5142H24.656L22.7106 10.811H23.6864L24.9094 13.8915L26.147 10.811H27.1173L25.1373 15.5142ZM27.5232 10.811V15.3971V15.3978H30.0593V14.6208H28.4166V13.3832H29.9977V12.6061H28.4166V11.5881H30.0593V10.811H27.5232ZM34 15.3971L32.556 13.4649C33.2292 13.3285 33.6011 12.8672 33.6011 12.1664C33.6011 11.3062 33.011 10.811 31.9791 10.811H30.6522V15.3971H31.5462V13.5549H31.6633L32.9009 15.3971H34ZM32.6807 12.216C32.6807 12.6765 32.3766 12.9245 31.8074 12.9245H31.5463V11.5352H31.8205C32.3766 11.5359 32.6807 11.7693 32.6807 12.216ZM12.26 15.5087C11.5786 15.5087 11.0841 15.2407 10.672 14.6354L11.2496 14.0786C11.4553 14.4768 11.7995 14.6901 12.2247 14.6901C12.6243 14.6901 12.9193 14.4151 12.9193 14.0439C12.9193 13.8514 12.8314 13.6866 12.6527 13.5688C12.5627 13.5141 12.384 13.431 12.0336 13.3084C11.1949 13.0058 10.9061 12.6831 10.9061 12.0501C10.9061 11.3014 11.5252 10.7377 12.3355 10.7377C12.8376 10.7377 13.2989 10.9094 13.6832 11.246L13.2164 11.8582C12.9817 11.5964 12.7628 11.4863 12.4941 11.4863C12.1097 11.4863 11.8265 11.7066 11.8265 11.9954C11.8265 12.2433 11.9865 12.3735 12.5218 12.5729C13.5392 12.9448 13.8418 13.2745 13.8418 14.0031C13.8418 14.8888 13.188 15.5087 12.26 15.5087ZM10.334 10.811H9.44128V15.3971H10.334V10.811ZM9.02918 13.1075C9.02918 11.7529 8.01805 10.811 6.56784 10.811H5.25476V15.3971H6.56023C7.25486 15.3971 7.75696 15.2323 8.19673 14.8673C8.71961 14.4352 9.02918 13.7814 9.02918 13.1075ZM7.61295 14.2564C7.92252 13.9815 8.10743 13.5417 8.10743 13.1012C8.10743 12.6615 7.92252 12.2348 7.61295 11.9592C7.31723 11.6912 6.96679 11.588 6.3892 11.588H6.14819V14.6207H6.3892C6.96679 14.6207 7.33108 14.5106 7.61295 14.2564Z" fill="#221F1F"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M18.2984 13.3871C18.2984 12.0989 19.3836 11.0546 20.7202 11.0546C21.3359 11.0546 21.8893 11.2686 22.311 11.6259C21.8726 11.1051 21.2057 10.7782 20.4439 10.7782C19.1073 10.7782 18.022 11.8226 18.022 13.1108C18.022 13.8636 18.3358 14.5118 18.8476 14.9433C18.502 14.5312 18.2984 13.9931 18.2984 13.3871Z" fill="#A3310B"></path>
                                       <path d="M35.75 0H3.25C1.4625 0 0 1.4625 0 3.25V22.75C0 24.5375 1.4625 26 3.25 26H35.75C37.5375 26 39 24.5375 39 22.75V3.25C39 1.4625 37.5375 0 35.75 0ZM35.75 0.65C37.1839 0.65 38.35 1.8161 38.35 3.25V22.75C38.35 24.1839 37.1839 25.35 35.75 25.35H3.25C1.8161 25.35 0.65 24.1839 0.65 22.75V3.25C0.65 1.8161 1.8161 0.65 3.25 0.65H35.75Z" fill="#B3B3B3"></path>
                                       <defs>
                                          <linearGradient id="paint0_linear" x1="16.8773" y1="12.6064" x2="19.7761" y2="16.8549" gradientUnits="userSpaceOnUse">
                                             <stop stop-color="#E25416"></stop>
                                             <stop offset="1" stop-color="#F9A020"></stop>
                                          </linearGradient>
                                       </defs>
                                    </svg>
                                 </div>
                                 <div id="elo">
                                    <svg width="25" height="auto" viewBox="0 0 39 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M39 22.75C39 24.5375 37.5375 26 35.75 26H3.25C1.4625 26 0 24.5375 0 22.75V3.25C0 1.4625 1.4625 0 3.25 0H35.75C37.5375 0 39 1.4625 39 3.25V22.75Z" fill="white"></path>
                                       <path d="M35.75 0H3.25C1.4625 0 0 1.4625 0 3.25V22.75C0 24.5375 1.4625 26 3.25 26H35.75C37.5375 26 39 24.5375 39 22.75V3.25C39 1.4625 37.5375 0 35.75 0ZM35.75 0.65C37.1839 0.65 38.35 1.8161 38.35 3.25V22.75C38.35 24.1839 37.1839 25.35 35.75 25.35H3.25C1.8161 25.35 0.65 24.1839 0.65 22.75V3.25C0.65 1.8161 1.8161 0.65 3.25 0.65H35.75Z" fill="#B3B3B3"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M26.305 9.33775V15.5945L27.3907 16.0448L26.8769 17.2786L25.8029 16.8325C25.5617 16.728 25.3984 16.5681 25.2741 16.3884C25.1552 16.2039 25.0664 15.9518 25.0664 15.6123V9.33844L26.305 9.33775ZM30.8238 12.1336C30.612 12.1336 30.4091 12.1678 30.2192 12.2313C30.2192 12.2313 29.7962 10.9653 29.7969 10.966C30.1276 10.856 30.4747 10.7993 30.8238 10.8C32.3917 10.8 33.7001 11.9136 34 13.3934L32.6923 13.6599C32.5161 12.7888 31.7461 12.1336 30.8238 12.1336ZM28.6765 16.4646L29.5599 15.4651C29.165 15.116 28.917 14.6056 28.917 14.0365C28.917 13.4681 29.1657 12.9584 29.5599 12.6093L28.6758 11.6098C28.0056 12.2035 27.5827 13.0711 27.5827 14.0365C27.582 15.0026 28.0056 15.8709 28.6765 16.4646ZM32.6923 14.4229C32.5146 15.2926 31.7454 15.9471 30.8237 15.9471C30.6181 15.9471 30.4138 15.9143 30.2184 15.8487L29.7948 17.114C30.1262 17.2247 30.4739 17.2814 30.8237 17.2807C32.3903 17.2807 33.698 16.1685 33.9999 14.69L32.6923 14.4229ZM18.0704 13.9902C18.0977 12.2016 19.5707 10.773 21.3587 10.8004C22.8761 10.8236 24.1332 11.8867 24.4631 13.3002L18.5944 15.8089C18.2535 15.2876 18.0602 14.6611 18.0704 13.9902ZM19.4143 14.238C19.4061 14.1628 19.4006 14.0863 19.4027 14.0084C19.4198 12.9543 20.2867 12.1132 21.3402 12.1303C21.9134 12.1378 22.4224 12.4009 22.7668 12.8067L19.4143 14.238ZM21.2801 15.949C21.8096 15.9566 22.2892 15.7475 22.6431 15.4032L23.5736 16.359C22.9785 16.9417 22.1594 17.295 21.261 17.2813C20.6673 17.2731 20.0872 17.1009 19.5858 16.7832L20.2949 15.6532C20.5805 15.8343 20.9173 15.9429 21.2801 15.949Z" fill="#221F1F"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M13.3699 13.9377C13.0796 15.3628 11.8198 16.4348 10.3092 16.4348C9.97238 16.4348 9.63761 16.3808 9.31787 16.2742L8.62373 18.3477C9.16688 18.5295 9.73599 18.6217 10.3092 18.621C12.8767 18.621 15.0185 16.7989 15.5118 14.377L13.3699 13.9377Z" fill="#ED412F"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M6.79068 17.2915L8.23907 15.6538C7.59276 15.0813 7.18488 14.2457 7.18488 13.3138C7.18488 12.3826 7.59276 11.5471 8.23907 10.9752L6.78999 9.33829C5.69209 10.3112 5 11.7315 5 13.3145C4.99932 14.8975 5.69209 16.3186 6.79068 17.2915" fill="#1AA5DF"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M9.31781 10.3461C9.63686 10.2395 9.97163 10.1856 10.3085 10.1856C11.8204 10.1856 13.0809 11.2596 13.3706 12.6854L15.5124 12.2489C15.0212 9.82484 12.878 8 10.3085 8C9.73661 7.99932 9.16818 8.09155 8.62504 8.2726L9.31781 10.3461Z" fill="#FFCA32"></path>
                                    </svg>
                                 </div>
                                 <div id="hipercard">
                                    <svg width="25" height="auto" viewBox="0 0 39 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M39 22.75C39 24.5375 37.5375 26 35.75 26H3.25C1.4625 26 0 24.5375 0 22.75V3.25C0 1.4625 1.4625 0 3.25 0H35.75C37.5375 0 39 1.4625 39 3.25V22.75Z" fill="white"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M16.9786 19.5205L4 19.525V19.494C4 19.4766 4.02064 19.3657 4.0458 19.2463C4.07096 19.1276 4.11031 18.938 4.13288 18.8258C4.15546 18.7135 4.19481 18.5226 4.21932 18.4019C4.24383 18.2807 4.28512 18.0794 4.31092 17.9543C4.33672 17.8291 4.37672 17.6311 4.39994 17.5143C4.42316 17.3976 4.46251 17.2067 4.48702 17.0905C4.51153 16.9738 4.55282 16.7725 4.57926 16.6429C4.60571 16.5132 4.64571 16.3152 4.66828 16.2029C4.69086 16.0907 4.72698 15.9172 4.74827 15.8178C4.76956 15.7185 4.79665 15.5843 4.80891 15.5192C4.82052 15.4547 4.85922 15.2637 4.8947 15.0947C4.93018 14.9257 4.96888 14.7354 4.98114 14.6709C4.99339 14.6064 5.03274 14.4155 5.06758 14.2465C5.10305 14.0781 5.14176 13.8872 5.15401 13.8227C5.16627 13.7582 5.20497 13.5672 5.2411 13.3989C5.27658 13.2305 5.31528 13.0428 5.32689 12.9828C5.3385 12.9228 5.36946 12.7667 5.39591 12.637C5.42236 12.5074 5.47332 12.2635 5.50815 12.0952C5.54299 11.9268 5.60298 11.6333 5.64168 11.443C5.68038 11.2527 5.72554 11.027 5.74295 10.9405C5.76037 10.8541 5.79262 10.6986 5.81391 10.5948C5.8352 10.4909 5.8739 10.3038 5.8997 10.1787C5.92551 10.0536 5.96808 9.84844 5.99388 9.72329C6.01969 9.59815 6.05903 9.40334 6.08161 9.2911C6.10419 9.17886 6.14289 8.99179 6.1674 8.87504C6.19192 8.75828 6.23449 8.55315 6.26158 8.41963C6.28868 8.28545 6.33448 8.08097 6.36286 7.96421C6.39124 7.84746 6.43123 7.70619 6.45252 7.65007C6.47316 7.59395 6.53057 7.47203 6.5796 7.37979L6.66926 7.21143L6.75054 7.10499C6.79505 7.04629 6.87504 6.95405 6.92793 6.89922C6.98083 6.84439 7.06985 6.76246 7.12597 6.71666C7.18209 6.67086 7.26336 6.60894 7.30658 6.57927C7.3498 6.54959 7.4343 6.49734 7.49494 6.4638C7.55558 6.42961 7.64008 6.38575 7.6833 6.3651C7.72652 6.34446 7.81489 6.30769 7.8794 6.28254C7.9439 6.25738 8.06775 6.21545 8.15419 6.189C8.24063 6.16256 8.40254 6.12321 8.51478 6.10127C8.62638 6.07934 8.80312 6.04967 8.90762 6.03548L9.09727 6.01032L22.0836 6.00516L35.07 6V6.03096C35.07 6.04838 35.0494 6.15933 35.0236 6.27867C34.9984 6.39736 34.9558 6.6012 34.9287 6.73085C34.9023 6.86051 34.8636 7.04758 34.8429 7.14692C34.8223 7.24626 34.783 7.4372 34.7552 7.57137C34.7281 7.70554 34.6856 7.91003 34.6617 8.02678C34.6378 8.14354 34.5985 8.33448 34.5752 8.45123C34.552 8.56799 34.5127 8.75893 34.4882 8.87504C34.4636 8.99179 34.4262 9.17564 34.4043 9.28336C34.3824 9.39109 34.343 9.5859 34.3166 9.71555C34.2901 9.84521 34.2476 10.0503 34.2224 10.171C34.1972 10.2916 34.1579 10.4793 34.136 10.587C34.114 10.6948 34.0747 10.8896 34.0482 11.0192C34.0218 11.1489 33.9799 11.354 33.9541 11.4746C33.9282 11.5953 33.8908 11.7791 33.8695 11.883C33.8489 11.9868 33.8096 12.181 33.7818 12.3152C33.7547 12.4493 33.7147 12.6435 33.6941 12.7473C33.6728 12.8512 33.6347 13.035 33.6096 13.1557C33.5844 13.2769 33.5412 13.4853 33.5141 13.6188C33.487 13.753 33.4477 13.9433 33.427 14.0426C33.4064 14.142 33.3683 14.329 33.3419 14.4587C33.3154 14.5883 33.2735 14.7935 33.2484 14.9141C33.2232 15.0347 33.1845 15.2257 33.1613 15.3379C33.1387 15.4501 33.0987 15.6443 33.0729 15.7701C33.0471 15.8952 33.0052 16.1004 32.9794 16.2255C32.9536 16.3507 32.9155 16.5384 32.8942 16.6416C32.8729 16.7454 32.8342 16.9364 32.8078 17.066C32.7813 17.1957 32.7388 17.3995 32.7123 17.5201L32.6652 17.7382L32.6091 17.8891C32.5781 17.9723 32.5317 18.0826 32.5059 18.1342C32.4801 18.1859 32.4272 18.2775 32.3885 18.3374C32.3498 18.3974 32.2962 18.4742 32.2685 18.5084C32.2408 18.5426 32.1595 18.6297 32.0866 18.7032L31.9544 18.8361L31.8266 18.9264C31.7563 18.9761 31.6809 19.027 31.6589 19.0393C31.637 19.0515 31.5525 19.0947 31.4712 19.1354C31.3899 19.176 31.2758 19.2276 31.2171 19.2502C31.1584 19.2728 31.0416 19.3108 30.9577 19.3354C30.8739 19.3599 30.7842 19.3837 30.7584 19.3889C30.7326 19.3941 30.6423 19.4128 30.5584 19.4302C30.4746 19.4482 30.3049 19.4747 30.1817 19.4895L29.9573 19.516L16.9786 19.5205Z" fill="#B7232C"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M11.193 10.249L11.2427 10.0361H10.2957L10.2751 10.1806C10.2699 10.2213 10.2505 10.3348 10.2344 10.4335L10.2273 10.4735C10.2093 10.5748 10.1835 10.7238 10.1648 10.8263C10.1441 10.9431 10.1054 11.1663 10.0796 11.3224C10.0538 11.4778 10.0209 11.6849 10.0067 11.781L9.99059 11.8881L8.92301 11.91L8.44631 11.8984C8.26763 11.8939 8.13475 11.89 8.05605 11.8875C8.05799 11.8739 8.06057 11.8584 8.06379 11.843C8.07669 11.7707 8.09991 11.6443 8.11669 11.563C8.13346 11.4804 8.16507 11.3172 8.187 11.2005C8.20893 11.0824 8.23409 10.936 8.24312 10.8741C8.25086 10.8154 8.26828 10.7173 8.28118 10.656C8.29472 10.5928 8.32053 10.4593 8.3373 10.36C8.35278 10.2703 8.36955 10.1871 8.37407 10.171L8.42632 10.0361H7.47162L7.43486 10.2393C7.42131 10.3161 7.40325 10.4245 7.39486 10.4819C7.38648 10.538 7.35745 10.7173 7.331 10.8812L7.15748 11.9655C7.13103 12.1294 7.08846 12.3829 7.06201 12.5293C7.03492 12.6764 6.99686 12.8841 6.97622 12.9918L6.88978 13.4472C6.86269 13.5904 6.82334 13.7904 6.80205 13.8936C6.78076 13.9987 6.7569 14.1194 6.74916 14.1632C6.74141 14.2058 6.71755 14.3297 6.69562 14.438C6.68013 14.5154 6.65369 14.6503 6.65369 14.678V14.7838H7.56645L7.7561 13.633C7.78319 13.473 7.82254 13.2369 7.84511 13.1073C7.86705 12.9783 7.90253 12.777 7.92317 12.6615C7.93671 12.5861 7.94832 12.5287 7.95349 12.499H9.88093L9.8777 12.5164C9.86803 12.5667 9.83835 12.7202 9.8132 12.8589L9.71773 13.3776C9.69064 13.524 9.65193 13.7323 9.63129 13.8407C9.61065 13.9484 9.56807 14.1755 9.53776 14.3439C9.52098 14.438 9.48099 14.6586 9.48099 14.6838L9.48228 14.7838H10.3963L10.4247 14.6187C10.4344 14.5645 10.4492 14.4658 10.4589 14.4006C10.4679 14.3361 10.4892 14.1994 10.5066 14.0962L10.5847 13.6407C10.6098 13.493 10.6518 13.2427 10.6789 13.0828C10.7053 12.9228 10.7447 12.6899 10.766 12.5648C10.7879 12.4396 10.8259 12.2287 10.8511 12.0945L11.1207 10.6257C11.1452 10.4793 11.1788 10.3109 11.193 10.249V10.249Z" fill="#F5F5F5"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0896 12.7025L12.1754 12.2549C12.1973 12.1381 12.2399 11.9175 12.2709 11.7627C12.3025 11.604 12.3263 11.4969 12.3334 11.4801L12.4095 11.3556L11.511 11.3666L11.4729 11.6395C11.4574 11.7523 11.4233 11.9736 11.3968 12.1329L11.3091 12.6754C11.2871 12.8135 11.2484 13.0347 11.2233 13.1683L11.1375 13.6237C11.1156 13.7404 11.0762 13.9449 11.0504 14.0784C11.0246 14.212 10.9891 14.3881 10.9724 14.47C10.9562 14.55 10.9388 14.6306 10.9336 14.65L10.8969 14.7867H11.7335L11.7626 14.7106C11.7767 14.6732 11.7774 14.6087 11.7774 14.6016C11.7774 14.5809 11.7942 14.45 11.8238 14.2662C11.8503 14.1049 11.8929 13.8423 11.9193 13.683C11.9458 13.523 11.9845 13.2902 12.0057 13.1644C12.0264 13.0399 12.0644 12.8322 12.0896 12.7025V12.7025Z" fill="#F5F5F5"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8748 10.9412L12.1128 10.9496L12.2773 10.8942L12.4425 10.7387L12.5315 10.5284L12.5392 10.211L12.4644 10.0872L12.3089 9.98074H12.0496L11.8567 10.0594L11.7374 10.1781L11.6484 10.3742L11.6271 10.6922L11.7181 10.8703L11.8748 10.9412Z" fill="#F5F5F5"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M15.4756 11.7471L15.582 11.9593L15.6536 12.2631L15.6762 12.5586L15.6581 12.7392C15.6478 12.8308 15.6252 12.9817 15.6072 13.0753L15.5755 13.2385L15.5123 13.4365C15.4769 13.5449 15.4181 13.7029 15.3814 13.7893C15.3472 13.87 15.2937 13.9796 15.262 14.0254C15.2588 14.0305 15.2555 14.0356 15.2524 14.0406C15.2424 14.0561 15.2334 14.0702 15.2285 14.079C15.2221 14.099 15.2021 14.1312 15.1414 14.2106C15.0976 14.2686 15.015 14.3622 14.9576 14.4196L14.855 14.5215L14.7324 14.604C14.6673 14.6466 14.5731 14.6995 14.5176 14.7247L14.4235 14.7679L14.059 14.8627L13.7197 14.8853L13.4294 14.8459L13.1875 14.7421L13.025 14.5782C13.0121 14.6647 12.9934 14.7898 12.9772 14.8924L12.8218 15.8768C12.8069 15.9722 12.7979 16.0548 12.7979 16.0716C12.7979 16.0999 12.7934 16.1432 12.7837 16.1703L12.7528 16.2477H11.92L11.9522 16.1128C11.9568 16.0935 11.9813 15.9735 12.0071 15.8451C12.0329 15.7161 12.0748 15.4975 12.1006 15.3588C12.1264 15.2214 12.1696 14.9879 12.1967 14.8408L12.3689 13.9067C12.3947 13.7635 12.4373 13.5242 12.4631 13.3733L12.636 12.3444C12.6618 12.1889 12.7057 11.9193 12.7334 11.7445L12.7947 11.3581H13.523L13.5204 11.4413C13.5197 11.4678 13.5107 11.5213 13.5023 11.5645C13.5189 11.5527 13.5342 11.5427 13.5411 11.5382C13.5425 11.5373 13.5436 11.5366 13.5442 11.5361C13.5952 11.5045 13.6836 11.4568 13.7416 11.4297L13.8474 11.3813L14.1035 11.3142L14.4119 11.2775L14.6944 11.2962L14.9743 11.3633L15.2569 11.511L15.4756 11.7471ZM14.7936 12.9829L14.8072 12.4133L14.7833 12.3237C14.7704 12.274 14.744 12.2011 14.7266 12.1676L14.6956 12.105L14.5782 11.9876L14.4285 11.9186L14.226 11.8779L13.9551 11.8941L13.7538 11.9586L13.6861 11.9992C13.6448 12.0224 13.5706 12.0747 13.5235 12.114L13.4558 12.1702L13.4203 12.3598C13.3977 12.4785 13.3571 12.7004 13.3306 12.8507C13.3042 13.0029 13.2642 13.2223 13.2416 13.339L13.201 13.5512L13.1874 13.7996L13.2042 13.8731C13.2145 13.9138 13.2371 13.9821 13.2545 14.0215L13.2829 14.0853L13.3835 14.1815L13.5358 14.2505L13.697 14.2789L13.9299 14.2627L14.1737 14.1795L14.2215 14.144C14.2511 14.1221 14.3002 14.0828 14.3292 14.0576C14.3531 14.037 14.4002 13.9854 14.4298 13.9434C14.4582 13.9041 14.5117 13.8157 14.5479 13.7473L14.6137 13.6228L14.662 13.4803C14.6917 13.3951 14.733 13.2513 14.7536 13.1597L14.7936 12.9829Z" fill="#F5F5F5"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M18.8936 12.2291L18.893 12.3736L18.871 12.5567C18.8581 12.6522 18.8349 12.7825 18.8201 12.847L18.7788 13.0218L16.9668 13.0096L16.5643 13.0283L16.5204 13.3134L16.5217 13.6824L16.5791 13.8836L16.6623 14.0243L16.7688 14.1197L16.8339 14.152C16.872 14.1713 16.9442 14.1997 16.9926 14.2152L17.0739 14.241L17.6112 14.2404L17.9415 14.1739L18.0963 14.1223C18.1898 14.092 18.284 14.0572 18.3098 14.0443L18.4188 13.9914L18.4911 14.061L18.4995 14.1217L18.4608 14.3081C18.4401 14.4087 18.4188 14.5216 18.4137 14.5597L18.3963 14.6874L18.1498 14.7416C18.0479 14.7635 17.8815 14.7945 17.7789 14.8087C17.6828 14.8222 17.5254 14.8396 17.4293 14.8486L17.2526 14.8648L17.0758 14.8628C16.9745 14.8616 16.8468 14.8545 16.7849 14.8467C16.7223 14.8383 16.612 14.817 16.5385 14.7996L16.4095 14.7687L16.3024 14.7216C16.2456 14.6958 16.1643 14.648 16.1166 14.6126C16.0689 14.5764 16.0011 14.5164 15.9631 14.4764C15.9224 14.4339 15.8715 14.3655 15.8463 14.3216C15.8225 14.2784 15.7883 14.2042 15.7689 14.1533C15.7502 14.1017 15.7238 14.0133 15.7102 13.954L15.6864 13.852L15.6838 13.3663L15.7096 13.1947C15.7238 13.105 15.7528 12.9606 15.7734 12.8722C15.7954 12.7806 15.8302 12.6567 15.8534 12.5896C15.876 12.5232 15.9102 12.4329 15.9283 12.3884C15.9476 12.3432 15.9889 12.2568 16.0199 12.1942C16.0515 12.131 16.1076 12.0362 16.1444 11.9814C16.1811 11.9265 16.2482 11.8452 16.2966 11.7962C16.3424 11.7511 16.4121 11.6872 16.4527 11.6543C16.4933 11.6221 16.574 11.5679 16.6359 11.5324C16.6952 11.4988 16.7984 11.4498 16.8655 11.4221L16.9842 11.3756L17.3758 11.2989L17.6996 11.2769L18.0512 11.3105L18.3363 11.3782L18.4337 11.4266C18.4795 11.4505 18.544 11.4905 18.5769 11.513C18.6143 11.5395 18.6659 11.5866 18.6956 11.6208C18.7246 11.6543 18.7665 11.7156 18.7923 11.7595L18.842 11.8523L18.8923 12.0671L18.8936 12.2291ZM18.0906 12.4893L18.1151 12.2655L18.0886 12.1049L18.0732 12.0752C18.0661 12.0623 18.0403 12.0255 18.0157 11.9991L17.9783 11.9591L17.8287 11.8907L17.6074 11.863L17.4578 11.8726C17.3668 11.8778 17.2771 11.8894 17.2526 11.8959C17.2281 11.9023 17.1604 11.9281 17.1023 11.9559L17.0133 11.9984L16.8243 12.1861L16.783 12.2687C16.7585 12.3184 16.7205 12.4087 16.6985 12.4687C16.6959 12.4745 16.694 12.4803 16.6921 12.4861C16.8243 12.488 17.072 12.4893 17.372 12.4893H18.0906Z" fill="#F5F5F5"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M21.0379 11.9761C21.1385 12.0057 21.1495 12.0057 21.1592 12.0057C21.1682 12.0057 21.2495 12.0025 21.2495 11.889C21.2501 11.8729 21.2637 11.7871 21.2869 11.6742C21.3275 11.4729 21.3275 11.4632 21.3275 11.4549C21.3275 11.3878 21.2688 11.3665 21.1559 11.3329C21.0953 11.3149 21.0018 11.2923 20.9508 11.2865L20.8598 11.2749L20.7457 11.2949C20.6863 11.3059 20.5986 11.3284 20.5463 11.3471C20.4954 11.3658 20.4148 11.4065 20.3619 11.4407C20.309 11.4749 20.2322 11.5361 20.1877 11.58C20.1651 11.6026 20.1348 11.6355 20.1045 11.6716C20.12 11.5845 20.1348 11.5058 20.1393 11.489L20.1793 11.3581H19.391V11.4755C19.3904 11.4923 19.3768 11.5942 19.3523 11.7419C19.3304 11.8748 19.2949 12.0967 19.273 12.2354C19.2511 12.3734 19.2124 12.614 19.1866 12.7688C19.1608 12.9237 19.122 13.1456 19.1001 13.2617L19.0137 13.7171C18.9879 13.8513 18.9453 14.0699 18.9189 14.2035C18.8924 14.3376 18.8608 14.495 18.8485 14.5544C18.8247 14.6705 18.8247 14.6866 18.8247 14.706V14.7866H19.651L19.6665 14.5699C19.6716 14.4937 19.691 14.3363 19.7078 14.2273C19.7252 14.1132 19.7613 13.8854 19.7884 13.7216C19.8148 13.5584 19.8639 13.2868 19.8968 13.1172C19.9329 12.9385 19.969 12.7811 19.978 12.754C19.9864 12.7301 20.0064 12.6702 20.0051 12.6514C20.0077 12.6411 20.0251 12.5947 20.0555 12.5295C20.0838 12.4676 20.1393 12.3689 20.1767 12.3128L20.2361 12.2205L20.4186 12.0515L20.627 11.9516L20.9579 11.9535L21.0379 11.9761Z" fill="#F5F5F5"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M23.713 11.8398C23.724 11.7689 23.7434 11.6528 23.7563 11.5812C23.784 11.4257 23.7801 11.4012 23.7505 11.3715C23.7318 11.3535 23.724 11.3457 23.566 11.3277C23.4944 11.3193 23.2983 11.3044 23.1312 11.2948L22.8203 11.278L22.3855 11.3122L22.0578 11.3818L21.9559 11.4225C21.9011 11.4444 21.8133 11.487 21.763 11.5173C21.7179 11.545 21.6605 11.5825 21.6334 11.6005C21.6018 11.6237 21.5205 11.6986 21.4592 11.7586L21.3289 11.8889L21.2618 11.9869C21.2231 12.0443 21.1567 12.1611 21.1141 12.2475L21.0354 12.4088L20.978 12.5739C20.9457 12.6668 20.9006 12.8177 20.878 12.9106L20.8354 13.0867L20.8058 13.3931L20.8064 13.7963L20.8412 14.044L20.9425 14.293L21.0625 14.4768L21.236 14.6471L21.4534 14.7639L21.574 14.7974C21.6456 14.8174 21.743 14.8387 21.7966 14.8471C21.8508 14.8548 21.974 14.8613 22.0707 14.8626L22.2488 14.8645L22.45 14.8407C22.5597 14.8278 22.7061 14.8058 22.7751 14.7929C22.8448 14.7794 22.9577 14.7529 23.0248 14.7329C23.1635 14.6949 23.1809 14.6794 23.1873 14.6729C23.2054 14.6587 23.2228 14.6439 23.257 14.4678C23.2731 14.3859 23.2931 14.2762 23.3021 14.224C23.3208 14.1104 23.317 14.0853 23.2892 14.0524L23.2621 14.0279H23.2286C23.1983 14.0279 23.1725 14.0434 23.1615 14.0524C23.1493 14.0595 23.0893 14.0853 23.0067 14.1163L22.868 14.1685L22.4552 14.2511L22.101 14.2388L21.9198 14.1756L21.7817 14.0543L21.6882 13.8834L21.6411 13.6518V13.4828L21.6405 13.3261L21.6998 12.9293L21.7327 12.819C21.7508 12.7578 21.7721 12.6855 21.7785 12.6597C21.785 12.6358 21.8127 12.5662 21.8385 12.5068C21.8656 12.4443 21.9146 12.3481 21.9462 12.292L21.9952 12.203L22.1294 12.0604L22.2694 11.9708L22.3707 11.9392C22.4242 11.923 22.5197 11.9011 22.579 11.8921L22.6803 11.8753L23.0144 11.8908L23.4105 11.9688L23.4937 11.9998C23.5918 12.0366 23.5918 12.0366 23.6092 12.0366C23.6827 12.0372 23.6892 11.9914 23.713 11.8398V11.8398Z" fill="#F5F5F5"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M26.2869 11.3831L26.5042 11.4979L26.6436 11.6373L26.7403 11.8547L26.7378 12.2482L26.6945 12.4894C26.6729 12.6061 26.6372 12.802 26.6121 12.9398L26.6068 12.9687C26.5823 13.1061 26.5436 13.3254 26.5217 13.4544C26.5004 13.5841 26.4636 13.8195 26.441 13.9782L26.4004 14.2691L26.3804 14.7858H25.645L25.6457 14.6071C25.6457 14.5691 25.6502 14.5072 25.6566 14.4433C25.6424 14.4588 25.6289 14.473 25.6166 14.4852C25.5702 14.5323 25.4928 14.5955 25.4412 14.6297C25.3928 14.6626 25.3122 14.7084 25.2586 14.7342L25.1722 14.7749L24.8903 14.8478L24.4413 14.8619L24.3414 14.8465C24.2878 14.8387 24.1943 14.8168 24.1324 14.8L24.0046 14.7607L23.7969 14.6297L23.744 14.5678C23.7111 14.5297 23.6653 14.462 23.6389 14.4143L23.5873 14.313L23.5421 14.0737L23.5408 13.7705L23.5899 13.4822L23.6473 13.3422C23.6782 13.2706 23.7273 13.1764 23.7602 13.128C23.7911 13.0816 23.8608 13.0003 23.9175 12.9435L24.0117 12.8494L24.1459 12.7636C24.2852 12.6765 24.3026 12.6765 24.3226 12.6765C24.3205 12.6756 24.3298 12.6712 24.3432 12.6647C24.3502 12.6614 24.3583 12.6575 24.3665 12.6533C24.4104 12.6333 24.5258 12.5946 24.6316 12.5662L24.8374 12.512L25.9018 12.5075L25.9424 12.3081L25.9418 12.2036L25.9424 12.1095L25.8663 11.9953L25.7134 11.9198L25.4515 11.874L25.0451 11.8927L24.8193 11.9321C24.6961 11.9527 24.5239 11.9888 24.4433 12.0101C24.3046 12.0482 24.2801 12.0482 24.2723 12.0482H24.2362L24.2098 12.0211C24.1762 11.9876 24.1794 11.9682 24.231 11.7695C24.2556 11.6766 24.2833 11.5605 24.2936 11.5115L24.3252 11.358L24.6478 11.356L24.8271 11.3341C24.9335 11.3206 25.1374 11.3031 25.2819 11.2941L25.5437 11.278L25.9611 11.3089L26.2869 11.3831ZM25.7908 13.1005L25.7992 13.0515H25.0677L24.8258 13.1089L24.6516 13.1947L24.4807 13.3643L24.4368 13.4559C24.411 13.5075 24.3787 13.5907 24.3652 13.6365L24.342 13.7159L24.3536 13.9868L24.3794 14.0352C24.3955 14.0655 24.4245 14.1107 24.442 14.1306L24.4703 14.1648L24.5271 14.1939C24.5613 14.2119 24.6252 14.2358 24.6639 14.2455L24.7355 14.2635L24.9638 14.2513L25.1973 14.1777L25.2457 14.1448C25.287 14.1171 25.3122 14.1036 25.3289 14.0971C25.3457 14.0848 25.3773 14.0558 25.4108 14.0216L25.4979 13.9352L25.5502 13.8475C25.5721 13.8101 25.5921 13.7752 25.5992 13.7604C25.6044 13.7417 25.6166 13.7056 25.6476 13.6256C25.6715 13.5656 25.7095 13.4469 25.7314 13.3663C25.7527 13.2856 25.7792 13.1676 25.7908 13.1005Z" fill="#F5F5F5"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M29.0825 12.0001L29.1438 11.9956L29.2121 11.9524L29.2134 11.8588C29.2134 11.8408 29.2283 11.7485 29.2495 11.6453L29.2999 11.4015L29.1947 11.3596C29.1702 11.3505 29.1141 11.3318 29.0702 11.3183L28.9915 11.2931L28.6838 11.2899L28.4116 11.3834L28.2387 11.4873L28.0659 11.6647C28.0794 11.5937 28.0955 11.5008 28.0962 11.475L28.0981 11.3576H27.435L27.3544 11.3615V11.4421C27.3531 11.4563 27.3395 11.5505 27.3228 11.6602C27.3053 11.7782 27.2692 12.004 27.2434 12.1639C27.2176 12.3226 27.1757 12.5807 27.1492 12.7368C27.1234 12.8916 27.0847 13.1135 27.0628 13.2302C27.0409 13.3463 27.0022 13.5515 26.977 13.685L26.7596 14.7861H27.624L27.6234 14.5075L27.6633 14.2475C27.6853 14.1049 27.7208 13.8785 27.7433 13.745C27.7659 13.6115 27.793 13.4405 27.8046 13.3676C27.8162 13.2947 27.8459 13.138 27.8717 13.0187C27.8988 12.8929 27.9298 12.769 27.9407 12.7374C27.9433 12.729 27.9697 12.6568 27.9691 12.6348C27.9717 12.6239 27.9923 12.5729 28.0278 12.4981L28.0846 12.3749L28.2484 12.1575L28.3323 12.0936C28.3794 12.0582 28.4574 12.0098 28.5032 11.9878L28.5761 11.9517L28.9373 11.9549L29.0825 12.0001Z" fill="#F5F5F5"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M31.6375 10.1122L31.6549 9.94193H32.4806V10.0226C32.4813 10.0419 32.4813 10.0497 32.4413 10.2432C32.4206 10.3419 32.3813 10.536 32.3548 10.6734C32.3284 10.8115 32.2884 11.0224 32.2658 11.1437L32.0878 12.11C32.062 12.2519 32.0226 12.4712 32.0013 12.5964C31.9801 12.7215 31.9472 12.9086 31.9284 13.0131C31.9104 13.1156 31.8781 13.313 31.8575 13.4504C31.8368 13.5878 31.7988 13.88 31.773 14.1L31.7259 14.5006L31.7265 14.7831H30.9409L30.9596 14.5883C30.9621 14.5619 30.966 14.5296 30.9699 14.498L30.9692 14.4993L30.7957 14.6541L30.6854 14.7141C30.628 14.7431 30.5454 14.776 30.4971 14.7896C30.448 14.8037 30.3422 14.8244 30.2687 14.8366L30.1203 14.8612L29.9642 14.8592C29.8759 14.8579 29.7636 14.8515 29.7088 14.8444C29.654 14.8373 29.5617 14.8186 29.5011 14.8018C29.4424 14.787 29.3508 14.7515 29.2934 14.7225L29.1992 14.6767L29.0457 14.5535L28.9012 14.3567L28.8683 14.2735C28.8496 14.2264 28.8238 14.1535 28.8115 14.1129L28.7909 14.0432L28.7522 13.6336L28.7993 13.1318L28.8496 12.9305C28.8773 12.8221 28.9179 12.6873 28.9425 12.6241C28.965 12.5628 29.0224 12.4338 29.0721 12.3306L29.1573 12.1532L29.2366 12.0371C29.2798 11.9758 29.3579 11.8803 29.4114 11.8229L29.5062 11.721L29.7372 11.5481L30.0481 11.3952L30.3777 11.3095L30.7357 11.2753L31.1582 11.3069L31.3208 11.3469C31.3247 11.3475 31.3866 11.3636 31.4388 11.3785L31.4872 11.085C31.513 10.9295 31.555 10.6689 31.5814 10.5044C31.6066 10.3419 31.6324 10.1658 31.6375 10.1122ZM29.7876 12.6187C29.767 12.6639 29.7495 12.7084 29.7457 12.7245C29.745 12.7245 29.7631 12.6923 29.7031 12.8813L29.6644 13.0064L29.6167 13.3548L29.6134 13.7528L29.6534 13.9282L29.736 14.0876L29.8431 14.1746L29.9095 14.203C29.9463 14.2191 30.0108 14.2385 30.0476 14.2449L30.1282 14.2591L30.3365 14.2456L30.5655 14.1727L30.643 14.1217C30.6868 14.0934 30.7449 14.0482 30.7713 14.0237C30.7958 14.0018 30.8378 13.9527 30.8623 13.9173C30.8868 13.8831 30.9255 13.814 30.9474 13.7676C30.9694 13.7224 30.9971 13.6489 31.0093 13.607L31.0629 13.4083C31.0797 13.3451 31.1113 13.1993 31.1332 13.0845C31.1375 13.0618 31.1424 13.0357 31.1477 13.0073C31.1699 12.8896 31.1994 12.7331 31.2196 12.6213C31.2454 12.4833 31.2809 12.2859 31.299 12.182C31.3111 12.1112 31.3241 12.04 31.3324 11.994L31.3364 11.9724C31.3009 11.9608 31.2332 11.9401 31.1693 11.9227L31.0306 11.8847H30.5365L30.3024 11.9659L30.2475 12.0014C30.214 12.0227 30.1527 12.0711 30.1172 12.1059C30.0805 12.1408 30.0211 12.2085 29.9876 12.2536C29.9547 12.2982 29.9063 12.3756 29.8818 12.422C29.8553 12.473 29.8134 12.5613 29.7876 12.6187Z" fill="#F5F5F5"></path>
                                       <path d="M35.75 0H3.25C1.4625 0 0 1.4625 0 3.25V22.75C0 24.5375 1.4625 26 3.25 26H35.75C37.5375 26 39 24.5375 39 22.75V3.25C39 1.4625 37.5375 0 35.75 0ZM35.75 0.65C37.1839 0.65 38.35 1.8161 38.35 3.25V22.75C38.35 24.1839 37.1839 25.35 35.75 25.35H3.25C1.8161 25.35 0.65 24.1839 0.65 22.75V3.25C0.65 1.8161 1.8161 0.65 3.25 0.65H35.75Z" fill="#B3B3B3"></path>
                                    </svg>
                                 </div>
                                 <div id="mastercard">
                                    <svg width="25" height="auto" viewBox="0 0 39 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M39 22.75C39 24.5375 37.5375 26 35.75 26H3.25C1.4625 26 0 24.5375 0 22.75V3.25C0 1.4625 1.4625 0 3.25 0H35.75C37.5375 0 39 1.4625 39 3.25V22.75Z" fill="white"></path>
                                       <path d="M35.75 0H3.25C1.4625 0 0 1.4625 0 3.25V22.75C0 24.5375 1.4625 26 3.25 26H35.75C37.5375 26 39 24.5375 39 22.75V3.25C39 1.4625 37.5375 0 35.75 0ZM35.75 0.65C37.1839 0.65 38.35 1.8161 38.35 3.25V22.75C38.35 24.1839 37.1839 25.35 35.75 25.35H3.25C1.8161 25.35 0.65 24.1839 0.65 22.75V3.25C0.65 1.8161 1.8161 0.65 3.25 0.65H35.75Z" fill="#B3B3B3"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M22.6453 18.4765C25.5349 18.4765 27.8774 16.134 27.8774 13.2444C27.8774 10.3547 25.5349 8.01221 22.6453 8.01221C19.7557 8.01221 17.4131 10.3547 17.4131 13.2444C17.4131 16.134 19.7557 18.4765 22.6453 18.4765Z" fill="#F79E1B"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2321 18.4643C19.1218 18.4643 21.4643 16.1218 21.4643 13.2321C21.4643 10.3425 19.1218 8 16.2321 8C13.3425 8 11 10.3425 11 13.2321C11 16.1218 13.3425 18.4643 16.2321 18.4643Z" fill="#EB001B"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4132 13.2322C17.4095 14.9139 18.1987 16.412 19.429 17.3721C20.6642 16.4174 21.4606 14.9237 21.4649 13.2425C21.4685 11.5607 20.6794 10.0627 19.4491 9.10254C18.2133 10.056 17.4168 11.5504 17.4132 13.2322Z" fill="#FF5F00"></path>
                                    </svg>
                                 </div>
                                 <!---->
                                 <div id="visa">
                                    <svg width="25" height="auto" viewBox="0 0 39 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M39 22.75C39 24.5375 37.5375 26 35.75 26H3.25C1.4625 26 0 24.5375 0 22.75V3.25C0 1.4625 1.4625 0 3.25 0H35.75C37.5375 0 39 1.4625 39 3.25V22.75Z" fill="white"></path>
                                       <path d="M35.75 0H3.25C1.4625 0 0 1.4625 0 3.25V22.75C0 24.5375 1.4625 26 3.25 26H35.75C37.5375 26 39 24.5375 39 22.75V3.25C39 1.4625 37.5375 0 35.75 0ZM35.75 0.65C37.1839 0.65 38.35 1.8161 38.35 3.25V22.75C38.35 24.1839 37.1839 25.35 35.75 25.35H3.25C1.8161 25.35 0.65 24.1839 0.65 22.75V3.25C0.65 1.8161 1.8161 0.65 3.25 0.65H35.75Z" fill="#B3B3B3"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M24.9729 16.0291C24.8546 16.3114 24.7371 16.5936 24.6181 16.8802C24.6277 16.8823 24.6356 16.8844 24.6423 16.8861C24.6543 16.8893 24.6627 16.8915 24.6711 16.8911C24.7714 16.8912 24.8717 16.8913 24.972 16.8915C25.524 16.8923 26.0759 16.8931 26.6278 16.8882C26.6692 16.8882 26.7316 16.8367 26.7476 16.7946C26.8658 16.4862 26.979 16.1764 27.0842 15.8637C27.1176 15.7643 27.1662 15.7317 27.2707 15.7324C28.0281 15.7368 28.7863 15.7382 29.5438 15.7317C29.6685 15.7309 29.7179 15.765 29.7404 15.8898C29.7833 16.1272 29.8336 16.3626 29.8841 16.5994C29.9045 16.6949 29.925 16.7906 29.945 16.8867H31.79C31.7873 16.8693 31.7849 16.8525 31.7825 16.8361C31.7773 16.7998 31.7723 16.7656 31.7653 16.7322C31.7035 16.4368 31.6417 16.1415 31.5799 15.8461C31.1214 13.6558 30.6629 11.4653 30.2083 9.27372C30.1858 9.16634 30.1423 9.14602 30.0451 9.14675C29.535 9.15037 29.0257 9.15037 28.5157 9.1482C28.0702 9.14675 27.7669 9.35425 27.5964 9.762C27.0836 10.9876 26.5706 12.213 26.0575 13.4383C25.6959 14.3019 25.3344 15.1655 24.9729 16.0291ZM29.0433 12.5748C29.1513 13.0926 29.2598 13.6126 29.3695 14.1376C28.8087 14.1376 28.2733 14.1376 27.7117 14.1369C28.0599 13.1777 28.4031 12.2309 28.7463 11.2841C28.7557 11.2855 28.7652 11.2863 28.7746 11.287C28.8642 11.7157 28.9536 12.1445 29.0433 12.5748Z" fill="#152884"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M25.081 9.35189C24.965 9.89459 24.8496 10.4308 24.7342 10.9713C24.5144 10.898 24.3055 10.8182 24.0907 10.7587C23.6169 10.6274 23.1337 10.5708 22.6476 10.6651C22.4728 10.6992 22.2928 10.7732 22.147 10.8748C21.8241 11.099 21.814 11.469 22.1281 11.7062C22.3683 11.8876 22.6396 12.0269 22.8979 12.1836C23.2193 12.3781 23.5589 12.5471 23.8607 12.7684C24.6283 13.3314 24.8837 14.1136 24.6232 15.0299C24.378 15.8926 23.7722 16.4099 22.9647 16.7211C22.2246 17.0062 21.4534 17.0469 20.6734 16.9838C20.183 16.9439 19.7005 16.8582 19.234 16.6957C19.1571 16.6689 19.0816 16.6377 18.9953 16.6043C19.1164 16.0355 19.2362 15.4776 19.3522 14.9312C19.6838 15.048 20.0016 15.1815 20.331 15.2715C20.8222 15.405 21.3279 15.4536 21.8292 15.3412C22.0244 15.2976 22.2239 15.2084 22.385 15.0908C22.6861 14.8703 22.7086 14.464 22.4271 14.2188C22.2152 14.0345 21.9627 13.8952 21.7218 13.7464C21.3598 13.523 20.9702 13.338 20.6306 13.0847C19.4974 12.2395 19.6998 10.9626 20.2882 10.1979C20.725 9.63049 21.3242 9.31634 22.0041 9.14801C23.0068 8.89988 23.9964 8.97098 24.97 9.30691C25.0056 9.31996 25.0382 9.33448 25.081 9.35189V9.35189Z" fill="#152884"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M19.2688 9.16081C19.2159 9.41474 19.1651 9.66432 19.1114 9.91318C18.6274 12.1761 18.1413 14.439 17.6625 16.7027C17.6313 16.85 17.5812 16.9001 17.426 16.8964C16.8796 16.8855 16.3333 16.8921 15.787 16.8921C15.7369 16.8921 15.6876 16.8921 15.6172 16.8921C15.6687 16.6497 15.7166 16.4227 15.7652 16.1963C16.26 13.884 16.7556 11.5717 17.2489 9.25875C17.2642 9.18692 17.2801 9.14557 17.3672 9.14557C17.9781 9.1492 18.5883 9.14775 19.1992 9.14847C19.2166 9.14992 19.234 9.155 19.2688 9.16081V9.16081Z" fill="#152884"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M7.04281 9.14396H7.19154C8.25227 9.14396 9.31299 9.14323 10.3737 9.14396C10.9338 9.14396 11.277 9.42982 11.3808 9.97832C11.655 11.4287 11.9293 12.879 12.2035 14.3293C12.205 14.338 12.2093 14.3467 12.2231 14.3845C12.2528 14.3192 12.2753 14.2749 12.2935 14.2285C12.9465 12.5794 13.6002 10.9302 14.2481 9.27963C14.2909 9.17008 14.3453 9.13961 14.457 9.14033C15.0541 9.14541 15.6512 9.14251 16.2476 9.14251H16.4036C16.3739 9.22014 16.3514 9.28326 16.3253 9.34493C15.2892 11.8183 14.2524 14.2909 13.2178 16.7649C13.1815 16.852 13.1409 16.8905 13.0393 16.889C12.4146 16.8839 11.79 16.8839 11.166 16.889C11.0681 16.8897 11.0347 16.8585 11.0107 16.7657C10.4855 14.724 9.95436 12.6838 9.43053 10.6415C9.35145 10.3346 9.18385 10.122 8.89727 9.98558C8.32264 9.71133 7.7161 9.5372 7.10012 9.38919C7.06965 9.38193 7.0399 9.3725 7 9.36162C7.00726 9.32244 7.01306 9.28762 7.01959 9.25279C7.02684 9.22304 7.03337 9.19185 7.04281 9.14396V9.14396Z" fill="#152884"></path>
                                    </svg>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <style>

                           .jp-card, .jp-card-back, .jp-card .jp-card-front {
                                    width: 100% !important;
                                    max-width: 100%;
                                    min-width: 100px;
                                 }
                        </style>
                        <form x-show="paymentMethod === 'card'" id="payment-form" x-transition>
                           <div class="w-full" id="card-container"></div>
                           <div class="mt-2">
                               <label class="block text-xs font-medium text-gray-700 mb-2">Número do Cartão</label>
                               <input type="text" id="card-number" placeholder="0000 0000 0000 0000" maxlength="19" class="form-control text-sm font-black text-gray-800 bg-gray-50 w-full p-4 focus:border-black focus:bg-white border border-gray-200 rounded-md">
                               <div id="card-number-error" class="text-red-500 text-xs mt-1 hidden">Campo obrigatório.</div>
                           </div>
                           <div class="mt-2">
                               <label class="block text-xs font-medium text-gray-700 mb-2">Nome como consta no cartão</label>
                               <input type="text" id="card-name" placeholder="Nome Completo" class="form-control text-sm text-gray-800 bg-gray-50 w-full p-4 focus:border-black focus:bg-white border border-gray-200 rounded-md">
                               <div id="card-name-error" class="text-red-500 text-xs mt-1 hidden">Campo obrigatório.</div>
                           </div>
                           <div class="flex gap-4 items-center mt-2">
                               <div>
                                   <label class="block text-xs font-medium text-gray-700 mb-2">Validade</label>
                                   <input type="text" id="card-expiry" placeholder="MM/AA" class="form-control text-sm text-gray-800 bg-gray-50 w-full p-4 focus:border-black focus:bg-white border border-gray-200 rounded-md">
                                   <div id="card-expiry-error" class="text-red-500 text-xs mt-1 hidden">Campo obrigatório.</div>
                               </div>
                               <div>
                                   <label class="block text-xs font-medium text-gray-700 mb-2">CVV</label>
                                   <input type="text" id="card-cvc" placeholder="123" maxlength="4" class="form-control text-sm text-gray-800 bg-gray-50 w-full p-4 focus:border-black focus:bg-white border border-gray-200 rounded-md">
                                   <div id="card-cvc-error" class="text-red-500 text-xs mt-1 hidden">Campo obrigatório.</div>
                               </div>
                           </div>
                           <div class="mt-2">
                               <label class="block text-xs font-medium text-gray-700 mb-2">CPF</label>
                               <input type="text" id="card-cpf" placeholder="000.000.000-00" class="text-sm text-gray-800 bg-gray-50 w-full p-4 focus:border-black focus:bg-white border border-gray-200 rounded-md">
                               <div id="cpf-error" class="text-red-500 text-xs mt-1 hidden">Campo obrigatório.</div>
                           </div>
                           <div>
                               <label class="block text-xs font-medium text-gray-700 mb-2">Parcelas</label>
                               <select id="installments" class="text-sm text-gray-800 bg-gray-50 w-full p-4 focus:border-black focus:bg-white border border-gray-200 rounded-md">
                                   <option value="1">1x</option>
                                   <option value="2">2x</option>
                                   <option value="3">3x</option>
                                   <option value="4">4x</option>
                                   <option value="5">5x</option>
                                   <option value="6">6x</option>
                                   <option value="7">7x</option>
                                   <option value="8">8x</option>
                                   <option value="9">9x</option>
                                   <option value="10">10x</option>
                                   <option value="11">11x</option>
                                   <option value="12">12x</option>
                               </select>
                           </div>
                       
                           @include('checkout.show.offerSlider')
                       
                           <button class="w-full mt-4 btn-primary py-4 rounded-md font-bold text-sm transition-colors flex gap-2 justify-center items-center">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                   <span class="text-sm">Comprar Agora</span>
                               </svg>
                           </button>
                       </form>
                       
                       
                       <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const overlay = document.getElementById("processing-overlay");
                            const cardForm = document.getElementById("payment-form");
                    
                            if (cardForm) {
                                cardForm.addEventListener("submit", async function (event) {
                                    event.preventDefault(); // Impede o envio padrão do formulário
                                    overlay.classList.remove("hidden"); // Exibe a sobreposição
                    
                                    // Validação dos campos obrigatórios
                                    const cardNumber = document.getElementById("card-number").value.trim();
                                    const cardName = document.getElementById("card-name").value.trim();
                                    const cardExpiry = document.getElementById("card-expiry").value.trim();
                                    const cardCvc = document.getElementById("card-cvc").value.trim();
                                    const cpf = document.getElementById("card-cpf").value.trim(); // CPF
                                    const installments = document.getElementById("installments").value;
                    
                                    let isValid = true;
                    
                                    if (!cardNumber) {
                                        document.getElementById("card-number-error").classList.remove("hidden");
                                        isValid = false;
                                    } else {
                                        document.getElementById("card-number-error").classList.add("hidden");
                                    }
                    
                                    if (!cardName) {
                                        document.getElementById("card-name-error").classList.remove("hidden");
                                        isValid = false;
                                    } else {
                                        document.getElementById("card-name-error").classList.add("hidden");
                                    }
                    
                                    if (!cardExpiry) {
                                        document.getElementById("card-expiry-error").classList.remove("hidden");
                                        isValid = false;
                                    } else {
                                        document.getElementById("card-expiry-error").classList.add("hidden");
                                    }
                    
                                    if (!cardCvc) {
                                        document.getElementById("card-cvc-error").classList.remove("hidden");
                                        isValid = false;
                                    } else {
                                        document.getElementById("card-cvc-error").classList.add("hidden");
                                    }
                    
                                    if (!cpf) {
                                        document.getElementById("cpf-error").classList.remove("hidden");
                                        isValid = false;
                                    } else {
                                        document.getElementById("cpf-error").classList.add("hidden");
                                    }
                    
                                    if (!installments) {
                                        alert("Por favor, selecione o número de parcelas.");
                                        isValid = false;
                                    }
                    
                                    if (!isValid) {
                                        overlay.classList.add("hidden"); // Não remove a sobreposição caso o formulário não seja válido
                                        return; // Impede o envio do formulário
                                    }
                    
                                    // Criação de um objeto com os dados do formulário
                                    const formData = {
                                        card_number: cardNumber,
                                        card_name: cardName,
                                        card_expiry: cardExpiry,
                                        card_cvc: cardCvc,
                                        cpf: cpf,
                                        installments: installments,
                                        checkoutToken: checkoutToken
                                    };
                                        
                                    const url = '/api/checkout/payment/processCardPayment'; // Ajuste para a rota correta
                    
                                    try {
                                        const response = await fetch(url, {
                                            method: "POST",
                                            body: JSON.stringify(formData), // Envia os dados como JSON
                                            headers: {
                                                "Content-Type": "application/json", // Defina o tipo de conteúdo como JSON
                                                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                                            }
                                        });
                    
                                        if (!response.ok) {
                                            throw new Error("Erro ao processar o pagamento.");
                                        }
                    
                                        const result = await response.json();
                    
                                        if (result.success) {
                                            // window.location.href = result.redirect_url;
                                        } else {
                                            alert("Falha no pagamento. Verifique os dados e tente novamente.");
                                        }
                    
                                    } catch (error) {
                                        console.error("Erro:", error);
                                        alert("Ocorreu um erro ao processar o pagamento.");
                                    } finally {
                                        overlay.classList.add("hidden"); // Oculta a sobreposição
                                    }
                                });
                            }
                        });
                    </script>                                                                  

                        <script>
                           document.addEventListener("DOMContentLoaded", function () {
                               new Card({
                                   form: "#payment-form",
                                   container: "#card-container",
                                   formSelectors: {
                                       numberInput: "input#card-number",
                                       expiryInput: "input#card-expiry",
                                       cvcInput: "input#card-cvc",
                                       nameInput: "input#card-name"
                                   },
                                   placeholders: {
                                       name: "NOME COMPLETO"
                                 },
                                   formatting: true,
                               });
                           });
                       </script>                       

                     </div>


                     <div @click="paymentMethod = 'pix'" :class="paymentMethod === 'pix' ? 'border-2 border-[{{ $customizations['appearance_tag_color_second'] }}] bg-gray-50' : 'border border-gray-400'" class="p-4 rounded-lg cursor-pointer max-w-full md:max-w-[350px]">
                        <!-- Pix Form -->
                        <div class="flex gap-2 items-center">
                           <div class="flex items-center gap-2 relative">
                              <!-- Input Fake de Radio -->
                              <div class="w-4 h-4 rounded-full border border-gray-400 bg-transparent" :class="paymentMethod === 'pix' ? 'border-4 border-black bg-white' : 'border border-gray-400 bg-transparent'"></div>
                           
                              <!-- Label -->
                              <label for="payment-credit-card" class="text-xs text-black relative">
                                 <div class="flex gap-2">
                                    <img class="" src="https://awesome-assets.yampi.me/checkout/build/mix/assets/img/icons/pix.svg?v=1">
                                    <span class="text-xs text-black">Pix</span>
                                 </div>
                                 <!-- Selo "APROVAÇÃO IMEDIATA" -->
                                <div>
                                 <span class="absolute top-2 -translate-y-1/2 sm:right-[-250px] right-[-240px] bg-[{{ $customizations['appearance_button_color_second'] }}] text-[{{ $customizations['appearance_text_color_second'] }}] px-2 text-[9px] font-bold rounded-md">
                                    APROVAÇÃO IMEDIATA
                                 </span>
                                 @if(isset($payment_discount_pix->discount_percentage) > 0)
                                 <span class="absolute top-7 -translate-y-1/2 sm:right-[-250px] right-[-240px] discount-flag px-2 text-[9px] font-bold rounded-md">
                                    {{ (int) $payment_discount_pix->discount_percentage }}% DE DESCONTO
                                 </span>
                                 @endif   

                              </div> 
                              </label>
                           </div>             
                        </div>
                        <form method="POST" action="{{ route('generate.pixpayment') }}" class="py-2" x-show="paymentMethod === 'pix'" x-transition>
                           @csrf
                           <input type="hidden" name="checkoutToken" value="{{ $checkout->token }}">
                           <div class="p-2">
                              <p class="text-xs text-black mt-4">
                                 A confirmação de pagamento é realizada em poucos minutos.
                                 Utilize o aplicativo do seu banco para pagar.
                             </p>
                             <div class="mt-4 p-2 border border-[{{ $customizations['appearance_tag_color_second'] }}] rounded-md">
                              <span class="text-[{{ $customizations['appearance_tag_color_second'] }}] text-xs font-semibold">IMPORTANTE: O código PIX é válido por 30 minutos após ser gerado. Faça o pagamento a tempo para garantir seus produtos.</span>
                             </div>
                             <h1 class="text-[{{ $customizations['appearance_totalvalue_color'] }}] font-bold text-lg mt-4">Valor no Pix: <span class="cart-total">R$ {{ number_format($totalValue / 100, 2, ',', '.') }}</span></h1>
                             @include('checkout.show.offerSlider')
                           </div>
                           

                           

                           <button class="w-full mt-2 btn-primary py-4 rounded-md font-bold text-sm transition-colors flex gap-2 justify-center items-center">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                              <span class="text-sm">Comprar Agora</span>
                           </button>                                         
                     </div>
                     </form>
                     <!-- Div de sobreposição -->
                     <div id="processing-overlay" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
                        <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
                           <svg class="animate-spin h-8 w-8 text-blue-600 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                           </svg>
                           <p class="text-gray-800 font-semibold">Processando pagamento...</p>
                        </div>
                     </div>

                     <script>
                     document.addEventListener("DOMContentLoaded", function () {
                        const overlay = document.getElementById("processing-overlay");
                        const pixForm = document.querySelector('form[action="{{ route("generate.pixpayment") }}"]');

                        if (pixForm) {
                           pixForm.addEventListener("submit", async function (event) {
                              event.preventDefault(); // Impede o envio padrão do formulário
                              overlay.classList.remove("hidden"); // Exibe a sobreposição

                              const formData = new FormData(pixForm);
                              const url = pixForm.action;

                              try {
                                    const response = await fetch('/api/checkout/payment/generatePixPayment', {
                                       method: "POST",
                                       body: formData,
                                       headers: {
                                          "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                                       }
                                    });

                                    if (!response.ok) {
                                       throw new Error("Erro ao processar o pagamento.");
                                    }

                                    const result = await response.json();

                                    if (result.success) {
                                       alert("Pagamento gerado com sucesso!");
                                       window.location.href = result.redirect_url;
                                    } else {
                                       alert("Falha ao gerar pagamento. Tente novamente.");
                                    }

                              } catch (error) {
                                    console.error("Erro:", error);
                                    alert("Ocorreu um erro ao processar o pagamento.");
                              } finally {
                                    overlay.classList.add("hidden"); // Oculta a sobreposição
                              }
                           });
                        }
                     });
                     </script>

                  </div>
               </section>
            </div>
            <!-- Carrinho -->
            <section x-data="{ isCartOpen: window.matchMedia('(min-width: 640px)').matches }" class="p-2 gap-6 w-full sm:max-w-[360px]">
               <div class="bg-white sm:p-4 p-2">
                  <div class="flex justify-between sm:justify-start">
                     <div>
                        <h2 class="sm:text-md text-sm text-gray-800 sm:pt-4 pt-0 flex items-center gap-1 sm:gap-0">RESUMO <p class="font-bold block sm:hidden">({{ count($checkout->cart->items) }})</p></h2>
                        <p class="text-xs text-gray-400" :class="isCartOpen === true ? 'hidden' : 'flex'">Informações da sua compra</p>
                     </div>
                     <div class="flex items-center gap-4">                         
                        <p class="font-bold text-md cart-total" :class="isCartOpen === true ? 'hidden' : 'flex'">R$ {{ number_format($totalValue / 100, 2, ',', '.') }}</p>
                        <i x-transition @click="isCartOpen = !isCartOpen" class="fa-solid text-lg text-black sm:hidden flex" :class="isCartOpen === true ? 'fa-chevron-up' : 'fa-chevron-down'"></i>  
                     </div>
                  </div>
                  <!-- Versão alternativa com Tailwind para a estrutura moderna -->
                 <div class="sm:flex-col flex-col-reverse" :class="isCartOpen === true ? 'flex' : 'hidden'" x-transition>
                  
                  <div class="pt-4 flex flex-col">
                     <span class="text-xs text-gray-800">Tem um cupom?</span>
                     <div class="flex gap-2 mt-2 items-center">
                        <div class="relative w-full">
                           <input 
                              type="text" 
                              name="cupom" 
                              class="w-full p-2 text-xs border border-gray-300 bg-gray-50 text-gray-800 rounded-md bg-[#f4f6f8] focus:border-black pl-10" 
                              placeholder="Digite o código">
                        
                           <!-- Ícone de ticket dentro do input -->
                           <svg class="absolute left-3 top-1/2 transform -translate-y-1/4 w-4 h-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                           </svg>
                        </div>
                  
                        <button 
                           type="submit" 
                           class="px-4 py-2 text-xs rounded-md bg-[#f4f6f8] border border-gray-200 btn-tertiary">
                           Adicionar
                        </button>
                     </div>
                  </div>

                  <div class="mt-6 p-4 text-xs bg-[#f9f9f9] border border-gray-200 rounded-lg">
                     <div class="flex justify-between text-gray-800 py-2">
                        <p>Produtos:</p>
                        <p class="font-[10px] cart-total" style="color: rgb(31 41 55 / var(--tw-text-opacity, 1));">R$ {{ number_format($totalValue / 100, 2, ',', '.') }}</p>
                     </div>
                     <div class="flex justify-between text-gray-800 py-2">
                        <p>Descontos:</p>
                        <p class="font-[10px]">R$ 0,00</p>
                     </div>
                     @if($freteValue > 0)
                     <div class="flex justify-between text-gray-800 py-2">
                        <p>Frete:</p>
                        <p class="font-[10px]">R$ {{ number_format($freteValue, 2, ',', '.') }}</p>
                     </div>
                     @endif
                     <div class="flex justify-between items-start text-gray-800 mt-8">
                        <p class="text-[{{ $customizations['appearance_totalvalue_color'] }}] font-bold text-xs">Total</p>
                        <div>
                           <p class="font-bold text-xl cart-total leading-3">R$ {{ number_format($totalValue / 100, 2, ',', '.') }}</p>
                           <p>em até 12x no cartão</p>
                        </div>
                     </div>
                  </div>

                  <div class="space-y-6">
                     <div class="sm:p-4 p-0 rounded-md flex flex-col items-center transition-all" id="cart-items-container">
                        <!-- Informações do produto -->
                                               
                     </div>
                  </div> 
            </div>
                  
               </div>
            </section>
           </div>
           <footer class="bg-white text-white py-12 mt-30 w-full">
            <div class="container mx-auto px-6">
                <!-- Seção de Links -->
                <div class="flex flex-col text-center justify-center items-center p-4 text-gray-600 text-sm">
                    <span>Formas de pagamento</span>
                    <div class="flex gap-1 items-center justify-center p-4 max-w-xl flex-wrap">
                     <img loading="lazy" alt="visa" width="39" height="26" src="https://icons.yampi.me/svg/card-visa.svg">
                     <img loading="lazy" alt="mastercard" width="39" height="26" src="https://icons.yampi.me/svg/card-mastercard.svg">
                     <img loading="lazy" alt="elo" width="39" height="26" src="https://icons.yampi.me/svg/card-elo.svg">
                     <img loading="lazy" alt="hiper" width="39" height="26" src="https://icons.yampi.me/svg/card-hiper.svg">
                     <img loading="lazy" alt="pix" width="39" height="26" src="https://icons.yampi.me/svg/card-pix.svg">
                     <img loading="lazy" alt="amex" width="39" height="26" src="https://icons.yampi.me/svg/card-amex.svg">
                     <img loading="lazy" alt="diners" width="39" height="26" src="https://icons.yampi.me/svg/card-diners.svg">
                     <img loading="lazy" alt="discover" width="39" height="26" src="https://icons.yampi.me/svg/card-discover.svg">
                     <img loading="lazy" alt="aura" width="39" height="26" src="https://icons.yampi.me/svg/card-aura.svg">
                     <img loading="lazy" alt="hipercard" width="39" height="26" src="https://icons.yampi.me/svg/card-hipercard.svg">
                 </div>                 
                </div>
                <div class="mt-2 text-gray-600 text-xs flex flex-col justify-center items-center text-center">
                  @if(isset($customizations['rodape_cnpj']))
                  <span>{{ $checkout->store->name }}: {{ $checkout->shop->origin }}</span>
                  <span>© 2025 {{ $customizations['rodape_razao_social'] }} CNPJ: {{ $customizations['rodape_cnpj'] }}</span>
                  @endif
                  <div class="mt-4">
                     <svg class="fill-gray-600" width="89" height="19" viewBox="0 0 89 19" fill="#898792" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" clip-rule="evenodd" d="M9.75 14.1875V8.5C9.75 8.05127 9.38623 7.6875 8.9375 7.6875L2.4375 7.6875C1.98877 7.6875 1.625 8.05127 1.625 8.5L1.625 14.1875C1.625 14.6362 1.98877 15 2.4375 15H8.9375C9.38623 15 9.75 14.6362 9.75 14.1875ZM11.375 8.5V14.1875C11.375 15.5337 10.2837 16.625 8.9375 16.625H2.4375C1.09131 16.625 -5.8844e-08 15.5337 0 14.1875L2.48609e-07 8.5C3.07453e-07 7.15381 1.09131 6.0625 2.4375 6.0625L8.9375 6.0625C10.2837 6.0625 11.375 7.15381 11.375 8.5Z"></path>
                           <path fill-rule="evenodd" clip-rule="evenodd" d="M5.6875 3.625C4.79004 3.625 4.0625 4.35254 4.0625 5.25V6.875H2.4375V5.25C2.4375 3.45507 3.89257 2 5.6875 2C7.48243 2 8.9375 3.45507 8.9375 5.25V6.875H7.3125V5.25C7.3125 4.35254 6.58496 3.625 5.6875 3.625Z"></path>
                           <path fill-rule="evenodd" clip-rule="evenodd" d="M6.5 10.125L6.5 12.5625H4.875L4.875 10.125H6.5Z"></path>
                           <path d="M23.136 0.11C23.73 0.11 24.236 0.205333 24.654 0.396C25.072 0.586667 25.391 0.861666 25.611 1.221C25.831 1.58033 25.941 2.01667 25.941 2.53C25.941 3.04333 25.831 3.47967 25.611 3.839C25.391 4.19833 25.072 4.47333 24.654 4.664C24.236 4.85467 23.73 4.95 23.136 4.95H21.695V7.37H19.803V0.11H23.136ZM22.839 3.531C23.235 3.531 23.532 3.45033 23.73 3.289C23.9353 3.12033 24.038 2.86733 24.038 2.53C24.038 2.19267 23.9353 1.94333 23.73 1.782C23.532 1.61333 23.235 1.529 22.839 1.529H21.695V3.531H22.839Z"></path>
                           <path d="M33.0094 7.37H31.0624L30.5564 5.731H28.0704L27.5534 7.37H25.6504L28.2024 0.11H30.4684L33.0094 7.37ZM28.4224 4.444H30.2044L29.3134 1.507L28.4224 4.444Z"></path>
                           <path d="M36.5882 7.48C35.9429 7.48 35.3672 7.337 34.8612 7.051C34.3626 6.765 33.9739 6.34333 33.6952 5.786C33.4166 5.22867 33.2772 4.55033 33.2772 3.751C33.2772 2.96633 33.4239 2.29533 33.7172 1.738C34.0106 1.18067 34.4286 0.751667 34.9712 0.451C35.5212 0.150333 36.1666 0 36.9072 0C37.7286 0 38.3922 0.150333 38.8982 0.451C39.4042 0.744333 39.7966 1.21367 40.0752 1.859L38.3262 2.552C38.2309 2.178 38.0622 1.90667 37.8202 1.738C37.5782 1.56933 37.2776 1.485 36.9182 1.485C36.5589 1.485 36.2509 1.573 35.9942 1.749C35.7376 1.91767 35.5432 2.17067 35.4112 2.508C35.2792 2.838 35.2132 3.24867 35.2132 3.74C35.2132 4.25333 35.2792 4.68233 35.4112 5.027C35.5506 5.37167 35.7522 5.62833 36.0162 5.797C36.2876 5.95833 36.6212 6.039 37.0172 6.039C37.2299 6.039 37.4242 6.01333 37.6002 5.962C37.7762 5.91067 37.9302 5.83733 38.0622 5.742C38.1942 5.63933 38.2969 5.51467 38.3702 5.368C38.4436 5.214 38.4802 5.03433 38.4802 4.829V4.719H36.8192V3.454H40.0862V7.37H38.7992L38.6562 5.665L38.9642 5.929C38.8102 6.42767 38.5316 6.81267 38.1282 7.084C37.7322 7.348 37.2189 7.48 36.5882 7.48Z"></path>
                           <path d="M48.1344 7.37H46.1874L45.6814 5.731H43.1954L42.6784 7.37H40.7754L43.3274 0.11H45.5934L48.1344 7.37ZM43.5474 4.444H45.3294L44.4384 1.507L43.5474 4.444Z"></path>
                           <path d="M57.3828 0.11V7.37H55.7108V4.037L55.7658 1.804H55.7438L53.9508 7.37H52.4218L50.6288 1.804H50.6068L50.6618 4.037V7.37H48.9788V0.11H51.6738L52.8178 3.806L53.2248 5.346H53.2468L53.6648 3.817L54.7978 0.11H57.3828Z"></path>
                           <path d="M58.9905 7.37V0.11H64.6445V1.573H60.8825V3.047H63.8745V4.422H60.8825V5.907H64.7875V7.37H58.9905Z"></path>
                           <path d="M72.4749 0.11V7.37H70.3739L68.1189 3.443L67.5689 2.365H67.5579L67.6019 3.707V7.37H65.9299V0.11H68.0309L70.2859 4.037L70.8359 5.115H70.8469L70.8029 3.773V0.11H72.4749Z"></path>
                           <path d="M80.1883 0.11V1.573H77.8233V7.37H75.9313V1.573H73.5553V0.11H80.1883Z"></path>
                           <path d="M84.225 0C84.9583 0 85.589 0.150333 86.117 0.451C86.6523 0.744333 87.063 1.16967 87.349 1.727C87.635 2.28433 87.778 2.95533 87.778 3.74C87.778 4.52467 87.635 5.19567 87.349 5.753C87.063 6.31033 86.6523 6.73933 86.117 7.04C85.589 7.33333 84.9583 7.48 84.225 7.48C83.4917 7.48 82.8573 7.33333 82.322 7.04C81.7867 6.73933 81.376 6.31033 81.09 5.753C80.804 5.19567 80.661 4.52467 80.661 3.74C80.661 2.95533 80.804 2.28433 81.09 1.727C81.376 1.16967 81.7867 0.744333 82.322 0.451C82.8573 0.150333 83.4917 0 84.225 0ZM84.225 1.485C83.873 1.485 83.576 1.56933 83.334 1.738C83.092 1.90667 82.9087 2.15967 82.784 2.497C82.6593 2.827 82.597 3.24133 82.597 3.74C82.597 4.23133 82.6593 4.64567 82.784 4.983C82.9087 5.32033 83.092 5.57333 83.334 5.742C83.576 5.91067 83.873 5.995 84.225 5.995C84.577 5.995 84.8703 5.91067 85.105 5.742C85.347 5.57333 85.5303 5.32033 85.655 4.983C85.7797 4.64567 85.842 4.23133 85.842 3.74C85.842 3.24133 85.7797 2.827 85.655 2.497C85.5303 2.15967 85.347 1.90667 85.105 1.738C84.8703 1.56933 84.577 1.485 84.225 1.485Z"></path>
                           <path d="M21.03 18.37V13.84C21.03 13.7067 21.03 13.57 21.03 13.43C21.0367 13.2833 21.0433 13.13 21.05 12.97C20.8233 13.19 20.5633 13.38 20.27 13.54C19.9833 13.6933 19.6867 13.8033 19.38 13.87L19.18 12.94C19.32 12.92 19.4833 12.8733 19.67 12.8C19.8567 12.7267 20.05 12.6333 20.25 12.52C20.45 12.4067 20.6333 12.2867 20.8 12.16C20.9667 12.0267 21.0967 11.8967 21.19 11.77H22.09V18.37H21.03Z"></path>
                           <path d="M26.1634 18.47C25.3701 18.47 24.7468 18.1833 24.2934 17.61C23.8468 17.03 23.6234 16.1833 23.6234 15.07C23.6234 13.9567 23.8468 13.1133 24.2934 12.54C24.7468 11.96 25.3701 11.67 26.1634 11.67C26.9634 11.67 27.5868 11.96 28.0334 12.54C28.4868 13.1133 28.7134 13.9567 28.7134 15.07C28.7134 16.1833 28.4868 17.03 28.0334 17.61C27.5868 18.1833 26.9634 18.47 26.1634 18.47ZM26.1634 17.56C26.4834 17.56 26.7501 17.47 26.9634 17.29C27.1834 17.1033 27.3468 16.8267 27.4534 16.46C27.5668 16.0867 27.6234 15.6233 27.6234 15.07C27.6234 14.5167 27.5668 14.0567 27.4534 13.69C27.3468 13.3167 27.1834 13.04 26.9634 12.86C26.7501 12.6733 26.4834 12.58 26.1634 12.58C25.8434 12.58 25.5734 12.6733 25.3534 12.86C25.1401 13.04 24.9801 13.3167 24.8734 13.69C24.7668 14.0567 24.7134 14.5167 24.7134 15.07C24.7134 15.6233 24.7668 16.0867 24.8734 16.46C24.9801 16.8267 25.1401 17.1033 25.3534 17.29C25.5734 17.47 25.8434 17.56 26.1634 17.56Z"></path>
                           <path d="M32.4427 18.47C31.6494 18.47 31.0261 18.1833 30.5727 17.61C30.1261 17.03 29.9027 16.1833 29.9027 15.07C29.9027 13.9567 30.1261 13.1133 30.5727 12.54C31.0261 11.96 31.6494 11.67 32.4427 11.67C33.2427 11.67 33.8661 11.96 34.3127 12.54C34.7661 13.1133 34.9927 13.9567 34.9927 15.07C34.9927 16.1833 34.7661 17.03 34.3127 17.61C33.8661 18.1833 33.2427 18.47 32.4427 18.47ZM32.4427 17.56C32.7627 17.56 33.0294 17.47 33.2427 17.29C33.4627 17.1033 33.6261 16.8267 33.7327 16.46C33.8461 16.0867 33.9027 15.6233 33.9027 15.07C33.9027 14.5167 33.8461 14.0567 33.7327 13.69C33.6261 13.3167 33.4627 13.04 33.2427 12.86C33.0294 12.6733 32.7627 12.58 32.4427 12.58C32.1227 12.58 31.8527 12.6733 31.6327 12.86C31.4194 13.04 31.2594 13.3167 31.1527 13.69C31.0461 14.0567 30.9927 14.5167 30.9927 15.07C30.9927 15.6233 31.0461 16.0867 31.1527 16.46C31.2594 16.8267 31.4194 17.1033 31.6327 17.29C31.8527 17.47 32.1227 17.56 32.4427 17.56Z"></path>
                           <path d="M37.362 18.37L41.682 11.77H42.602L38.292 18.37H37.362ZM37.622 11.67C37.962 11.67 38.2554 11.7467 38.502 11.9C38.7554 12.0533 38.9487 12.2667 39.082 12.54C39.222 12.8133 39.292 13.1367 39.292 13.51C39.292 13.8767 39.222 14.2 39.082 14.48C38.9487 14.7533 38.7554 14.9667 38.502 15.12C38.2554 15.2733 37.962 15.35 37.622 15.35C37.2887 15.35 36.9954 15.2733 36.742 15.12C36.4887 14.9667 36.292 14.7533 36.152 14.48C36.0187 14.2 35.952 13.8767 35.952 13.51C35.952 13.1367 36.0187 12.8133 36.152 12.54C36.292 12.2667 36.4887 12.0533 36.742 11.9C36.9954 11.7467 37.2887 11.67 37.622 11.67ZM37.622 12.45C37.4554 12.45 37.312 12.4933 37.192 12.58C37.072 12.66 36.982 12.78 36.922 12.94C36.862 13.0933 36.832 13.2833 36.832 13.51C36.832 13.73 36.862 13.92 36.922 14.08C36.982 14.24 37.072 14.36 37.192 14.44C37.312 14.52 37.4554 14.56 37.622 14.56C37.7954 14.56 37.942 14.52 38.062 14.44C38.182 14.36 38.272 14.24 38.332 14.08C38.392 13.92 38.422 13.73 38.422 13.51C38.422 13.2833 38.392 13.0933 38.332 12.94C38.272 12.78 38.182 12.66 38.062 12.58C37.942 12.4933 37.7954 12.45 37.622 12.45ZM42.342 14.79C42.682 14.79 42.9754 14.8667 43.222 15.02C43.4754 15.1733 43.6687 15.39 43.802 15.67C43.942 15.9433 44.012 16.2633 44.012 16.63C44.012 17.0033 43.942 17.3267 43.802 17.6C43.6687 17.8733 43.4754 18.0867 43.222 18.24C42.9754 18.3933 42.682 18.47 42.342 18.47C42.0087 18.47 41.7154 18.3933 41.462 18.24C41.2087 18.0867 41.012 17.8733 40.872 17.6C40.7387 17.3267 40.672 17.0033 40.672 16.63C40.672 16.2633 40.7387 15.9433 40.872 15.67C41.012 15.39 41.2087 15.1733 41.462 15.02C41.7154 14.8667 42.0087 14.79 42.342 14.79ZM42.342 15.58C42.1754 15.58 42.032 15.62 41.912 15.7C41.792 15.78 41.702 15.9 41.642 16.06C41.582 16.2133 41.552 16.4033 41.552 16.63C41.552 16.85 41.582 17.04 41.642 17.2C41.702 17.36 41.792 17.4833 41.912 17.57C42.032 17.65 42.1754 17.69 42.342 17.69C42.5154 17.69 42.662 17.65 42.782 17.57C42.902 17.4833 42.992 17.36 43.052 17.2C43.112 17.04 43.142 16.85 43.142 16.63C43.142 16.41 43.112 16.22 43.052 16.06C42.992 15.9 42.902 15.78 42.782 15.7C42.662 15.62 42.5154 15.58 42.342 15.58Z"></path>
                           <path d="M50.8628 11.67C51.4561 11.67 51.9695 11.7833 52.4028 12.01C52.8361 12.23 53.2028 12.5567 53.5028 12.99L52.7828 13.68C52.5295 13.2933 52.2428 13.0167 51.9228 12.85C51.6095 12.6767 51.2361 12.59 50.8028 12.59C50.4828 12.59 50.2195 12.6333 50.0128 12.72C49.8061 12.8067 49.6528 12.9233 49.5528 13.07C49.4595 13.21 49.4128 13.37 49.4128 13.55C49.4128 13.7567 49.4828 13.9367 49.6228 14.09C49.7695 14.2433 50.0395 14.3633 50.4328 14.45L51.7728 14.75C52.4128 14.89 52.8661 15.1033 53.1328 15.39C53.3995 15.6767 53.5328 16.04 53.5328 16.48C53.5328 16.8867 53.4228 17.24 53.2028 17.54C52.9828 17.84 52.6761 18.07 52.2828 18.23C51.8961 18.39 51.4395 18.47 50.9128 18.47C50.4461 18.47 50.0261 18.41 49.6528 18.29C49.2795 18.17 48.9528 18.0067 48.6728 17.8C48.3928 17.5933 48.1628 17.3567 47.9828 17.09L48.7228 16.35C48.8628 16.5833 49.0395 16.7933 49.2528 16.98C49.4661 17.16 49.7128 17.3 49.9928 17.4C50.2795 17.5 50.5961 17.55 50.9428 17.55C51.2495 17.55 51.5128 17.5133 51.7328 17.44C51.9595 17.3667 52.1295 17.26 52.2428 17.12C52.3628 16.9733 52.4228 16.8 52.4228 16.6C52.4228 16.4067 52.3561 16.2367 52.2228 16.09C52.0961 15.9433 51.8561 15.83 51.5028 15.75L50.0528 15.42C49.6528 15.3333 49.3228 15.21 49.0628 15.05C48.8028 14.89 48.6095 14.6967 48.4828 14.47C48.3561 14.2367 48.2928 13.9767 48.2928 13.69C48.2928 13.3167 48.3928 12.98 48.5928 12.68C48.7995 12.3733 49.0961 12.13 49.4828 11.95C49.8695 11.7633 50.3295 11.67 50.8628 11.67Z"></path>
                           <path d="M55.0288 18.37V11.77H59.8088V12.69H56.0988V14.59H58.9988V15.49H56.0988V17.45H59.9488V18.37H55.0288Z"></path>
                           <path d="M63.9491 18.47C63.3291 18.47 62.7924 18.3333 62.3391 18.06C61.8857 17.7867 61.5324 17.4 61.2791 16.9C61.0257 16.3933 60.8991 15.7833 60.8991 15.07C60.8991 14.37 61.0291 13.7667 61.2891 13.26C61.5557 12.7533 61.9291 12.3633 62.4091 12.09C62.8957 11.81 63.4524 11.67 64.0791 11.67C64.7657 11.67 65.3191 11.7967 65.7391 12.05C66.1657 12.3033 66.5057 12.6967 66.7591 13.23L65.7691 13.7C65.6424 13.3333 65.4324 13.06 65.1391 12.88C64.8524 12.6933 64.5024 12.6 64.0891 12.6C63.6757 12.6 63.3124 12.6967 62.9991 12.89C62.6924 13.0833 62.4524 13.3667 62.2791 13.74C62.1057 14.1067 62.0191 14.55 62.0191 15.07C62.0191 15.5967 62.0957 16.0467 62.2491 16.42C62.4024 16.7867 62.6324 17.0667 62.9391 17.26C63.2524 17.4533 63.6357 17.55 64.0891 17.55C64.3357 17.55 64.5657 17.52 64.7791 17.46C64.9924 17.3933 65.1791 17.3 65.3391 17.18C65.4991 17.0533 65.6224 16.8967 65.7091 16.71C65.8024 16.5167 65.8491 16.29 65.8491 16.03V15.84H63.9291V14.97H66.7991V18.37H65.9991L65.9391 17.04L66.1391 17.14C65.9791 17.56 65.7124 17.8867 65.3391 18.12C64.9724 18.3533 64.5091 18.47 63.9491 18.47Z"></path>
                           <path d="M73.7654 11.77V15.84C73.7654 16.7133 73.5354 17.37 73.0754 17.81C72.6154 18.25 71.9454 18.47 71.0654 18.47C70.1987 18.47 69.5321 18.25 69.0654 17.81C68.6054 17.37 68.3754 16.7133 68.3754 15.84V11.77H69.4454V15.71C69.4454 16.33 69.5787 16.79 69.8454 17.09C70.112 17.39 70.5187 17.54 71.0654 17.54C71.6187 17.54 72.0287 17.39 72.2954 17.09C72.5621 16.79 72.6954 16.33 72.6954 15.71V11.77H73.7654Z"></path>
                           <path d="M78.2852 11.77C78.9919 11.77 79.5519 11.9467 79.9652 12.3C80.3852 12.6533 80.5952 13.13 80.5952 13.73C80.5952 14.35 80.3852 14.83 79.9652 15.17C79.5519 15.5033 78.9919 15.67 78.2852 15.67L78.1852 15.73H76.6552V18.37H75.5952V11.77H78.2852ZM78.2052 14.84C78.6386 14.84 78.9586 14.7533 79.1652 14.58C79.3786 14.4 79.4852 14.1267 79.4852 13.76C79.4852 13.4 79.3786 13.13 79.1652 12.95C78.9586 12.77 78.6386 12.68 78.2052 12.68H76.6552V14.84H78.2052ZM78.8352 15.06L80.9852 18.37H79.7552L77.9152 15.48L78.8352 15.06Z"></path>
                           <path d="M84.9954 11.67C85.6354 11.67 86.1887 11.8067 86.6554 12.08C87.122 12.3533 87.482 12.7433 87.7354 13.25C87.9887 13.7567 88.1154 14.3633 88.1154 15.07C88.1154 15.7767 87.9887 16.3833 87.7354 16.89C87.482 17.3967 87.122 17.7867 86.6554 18.06C86.1887 18.3333 85.6354 18.47 84.9954 18.47C84.3621 18.47 83.812 18.3333 83.3454 18.06C82.8787 17.7867 82.5187 17.3967 82.2654 16.89C82.0121 16.3833 81.8854 15.7767 81.8854 15.07C81.8854 14.3633 82.0121 13.7567 82.2654 13.25C82.5187 12.7433 82.8787 12.3533 83.3454 12.08C83.812 11.8067 84.3621 11.67 84.9954 11.67ZM84.9954 12.6C84.5821 12.6 84.2254 12.6967 83.9254 12.89C83.6321 13.0833 83.4054 13.3633 83.2454 13.73C83.0854 14.0967 83.0054 14.5433 83.0054 15.07C83.0054 15.59 83.0854 16.0367 83.2454 16.41C83.4054 16.7767 83.6321 17.0567 83.9254 17.25C84.2254 17.4433 84.5821 17.54 84.9954 17.54C85.4154 17.54 85.7721 17.4433 86.0654 17.25C86.3654 17.0567 86.5954 16.7767 86.7554 16.41C86.9154 16.0367 86.9954 15.59 86.9954 15.07C86.9954 14.5433 86.9154 14.0967 86.7554 13.73C86.5954 13.3633 86.3654 13.0833 86.0654 12.89C85.7721 12.6967 85.4154 12.6 84.9954 12.6Z"></path>
                     </svg>
                  </div>
                </div>
            </div>
        </footer>
        
         </div>
      </div>
      <script src="/js/fetchCartItems.js"></script>
      <script src="/js/offerSlider.js"></script>
      @stack('modals')
      @livewireScripts
   </body>
</html>
@else
<body style="overflow-x: hidden; background-color: #f3f4f8;">
   <section class="bg-black p-2" id="head_logo_bar_components">
      <!--- Bar logo -->
      <div id="bar-logo" class="p-2">
         <a href="#" title="KIKO 7.1" style="text-decoration: auto">
         <img src="https://imgstemp.com/images/a39bac37-3248-4b0d-9b29-8b44723ad32d_72e3b938de00972942fb96c6e06393fb" alt="KIKO 7.1" style="max-width: 100%; max-height: 2.4rem;margin-left:15px;">
         </a>
      </div>
   </section>
   <div id="content" class="flex justify-center p-8">
      <div id="content-not-found-page" class="flex flex-col">
         <h1 class="text-xl text-block font-bold pb-4">Seu carrinho de compras está vazio</h1>
         <div class="flex flex-col gap-4 not-found-texts text-md">
            <p>
               Para inserir produtos em seu carrinho navegue pelas coleções ou utilize a busca do site.
               <br>
               Ao encontrar os produtos desejados basta adiciona-los em seu carrinho de compras.
            </p>
         </div>
      </div>
   </div>
   @endif