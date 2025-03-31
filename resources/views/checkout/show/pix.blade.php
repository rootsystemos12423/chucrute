<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento via Pix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- Scripts -->
      @vite(['resources/css/app.css', 'resources/js/app.js'])
      <!-- Styles -->
      @livewireStyles

      @foreach ($gPixels as $pixel)
      <script async src="https://www.googletagmanager.com/gtag/js?id={{ $pixel->conversion_id }}">
      </script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
      
        gtag('config', '{{ $pixel->conversion_id }}');
      </script>
      @endforeach
</head>
@php
    $paymentData = json_decode($order->payment_data, true);
@endphp
<body class="bg-gray-100">
    <style>
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
    <div class="w-full pt-0 p-2 flex items-center justify-center header">
        <div class="px-4 py-3 w-full max-w-[1200px] flex justify-between items-center">
           <div class="">
              @if(isset($customizations['cabecalho_logo_path']) && $customizations['cabecalho_logo_path'])
              <img class="max-w-[100px] h-full" src="{{ asset($customizations['cabecalho_logo_path']) }}" alt="Loja Logo">
              @else
                    <h1 class="text-xl font-extrabold p-2">{{ $order->store->name }}</h1>
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
    <div class="flex justify-center items-center h-full mt-2 sm:mt-16">
        <div class="rounded-sm p-2 flex justify-between items-start flex-col sm:flex-row gap-8 max-w-[1196px]">
            <!-- Seção da Mensagem -->
            <div class="flex-1 sm:mr-20 mr-0 mt-12 sm:mt-0 text-center sm:text-start flex flex-col items-center sm:items-start">
                <h1 class="sm:text-5xl text-3xl font-bold text-gray-600">Quase lá...</h1>
                <p class="sm:text-2xl text-lg text-gray-600 mt-2">
                    Pague seu Pix dentro de <span id="timer" class="font-extrabold text-gray-500">30:00</span> para garantir sua compra.
                </p>
                
                <script>
                    function startTimer(duration, display) {
                        let timer = duration, minutes, seconds;
                        const interval = setInterval(function () {
                            minutes = Math.floor(timer / 60);
                            seconds = timer % 60;
                
                            // Formata para dois dígitos
                            minutes = minutes < 10 ? "0" + minutes : minutes;
                            seconds = seconds < 10 ? "0" + seconds : seconds;
                
                            display.textContent = minutes + ":" + seconds;
                
                            if (--timer < 0) {
                                clearInterval(interval);
                                display.textContent = "Expirado";
                            }
                        }, 1000);
                    }
                
                    // Define 30 minutos (1800 segundos)
                    window.onload = function () {
                        let display = document.getElementById("timer");
                        startTimer(1800, display);
                    };
                </script>
                                
                <div class="mt-4 text-blue-400 border border-blue-400 p-3 rounded-lg text-sm">
                    O beneficiário do PIX é a <b>APPMAX</b>. Esse é o nome da empresa que intermedia nossos pagamentos.
                </div>
    
                <div class="mt-6 px-6 py-1 text-sm bg-yellow-100/60 text-yellow-600 text-center rounded-full text-center w-80 flex gap-4 items-center justify-center">
                    Aguardando pagamento...
                    <svg class="w-10 h-10" viewBox="0 0 36 8" fill="#BF9500">
                        <circle cx="4" cy="4" r="4">
                            <animate attributeName="opacity" dur="1s" values="0;1;0" repeatCount="indefinite" begin=".1"></animate>
                        </circle>
                        <circle cx="18" cy="4" r="4">
                            <animate attributeName="opacity" dur="1s" values="0;1;0" repeatCount="indefinite" begin=".2"></animate>
                        </circle>
                        <circle cx="32" cy="4" r="4">
                            <animate attributeName="opacity" dur="1s" values="0;1;0" repeatCount="indefinite" begin=".3"></animate>
                        </circle>
                    </svg>
                </div>
            </div>
    
            <!-- Seção do QR Code -->
            <div class="flex-1 sm:flex-col flex-col-reverse items-center sm:w-52 w-full justify-center">
                <div class="bg-white p-8 rounded-sn shadow-md text-center w-full">
                    <div class="hidden sm:block">
                        <p class="text-gray-700">Abra seu aplicativo de pagamento onde você utiliza o Pix e escolha a opção <span class="text-purple-600 font-bold">Ler QR Code</span></p>
                    
                        <div class="justify-center flex items-center mt-8 text-md">
                              <p class="text-gray-700 justify-center flex items-center"><svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M10.5 18.75a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" />
                                    <path fill-rule="evenodd" d="M8.625.75A3.375 3.375 0 0 0 5.25 4.125v15.75a3.375 3.375 0 0 0 3.375 3.375h6.75a3.375 3.375 0 0 0 3.375-3.375V4.125A3.375 3.375 0 0 0 15.375.75h-6.75ZM7.5 4.125C7.5 3.504 8.004 3 8.625 3H9.75v.375c0 .621.504 1.125 1.125 1.125h2.25c.621 0 1.125-.504 1.125-1.125V3h1.125c.621 0 1.125.504 1.125 1.125v15.75c0 .621-.504 1.125-1.125 1.125h-6.75A1.125 1.125 0 0 1 7.5 19.875V4.125Z" clip-rule="evenodd" />
                              </svg>
                              Aponte a câmera do seu celular</span></p>
                        </div>
            
                        <div class="mt-4">
                              <img class="mx-auto w-64 h-64" loading="lazy" src="{{ $paymentData['qrcode'] }}" alt="QR Code PIX">
                        </div>
            
                        <p class="mt-4 text-lg text-gray-800">Valor do Pix: <span class="text-[#44c485] font-bold">R$ {{ number_format($order->total_value / 100, 2, ',', '.') }}</span></p>
                        
                        <div class="mt-2 text-xs flex flex-col items-center text-gray-500 mt-8">
                            <span>Pix processado por</span>
                            <img class="w-xs h-xs p-4" src="https://icons.yampi.me/svg/appmax.svg">
                        </div>
                    </div>
                    
                    <div class="flex flex-col items-center sm:hidden">
                        <p class="mt-4 text-lg text-gray-800">Valor do Pix: <span class="text-[#44c485] font-bold">R$ {{ number_format($order->total_value / 100, 2, ',', '.') }}</span></p>

                        <div class="relative flex flex-col items-center w-2/3">
                            <button data-pix-code="{{ $paymentData['url'] }}" 
                                class="copyPixCode px-6 py-3 mt-4 mb-4 rounded-md text-white bg-[#36b376] text-md font-semibold flex items-center justify-center relative">
                                <img class="mr-3" src="https://awesome-assets.yampi.me/checkout/build/mix/assets/img/icons/copy-paste.svg" alt=""> Copiar código
                            </button>
                            <!-- Tooltip inicial (escondido) -->
                            <div class="tooltip absolute -top-6 px-3 py-1 text-sm text-white bg-gray-900 rounded-md opacity-0 transition-opacity duration-300">Código copiado!</div>
                        </div>
                        

                        <img class="border-b border-dotted border-gray-400 pb-4" src="/images/COMO_PAGAR_SEU_PIX_1.svg" alt="">
                        
                        <div class="mt-2 text-xs flex flex-col items-center text-gray-500 mt-8">
                            <span>Pix processado por</span>
                            <img class="w-[150px] h-[40px] p-2" src="https://icons.yampi.me/svg/appmax.svg">
                        </div>
                    </div>
                </div>
        
                <div class="hidden sm:flex flex-col justify-center p-6 text-center">
                    <p class="text-sm text-gray-600">Você também pode pagar escolhendo a opção
                        Pix Copia e Cola no seu aplicativo de pagamento ou Internet Banking (banco online). Neste caso, copie o código clicando no botão abaixo:</p>
                        <div class="relative flex flex-col items-center">
                            <button data-pix-code="{{ $paymentData['url'] }}" 
                                class="copyPixCode px-6 py-3 mt-4 mb-4 rounded-md text-gray-600 text-md font-semibold flex items-center justify-center relative">
                                <img class="mr-3" src="https://awesome-assets.yampi.me/checkout/build/mix/assets/img/icons/copy-paste-dark.svg" alt=""> Copiar código
                            </button>
                            <!-- Tooltip inicial (escondido) -->
                            <div class="tooltip absolute -top-6 px-3 py-1 text-sm text-white bg-gray-900 rounded-md opacity-0 transition-opacity duration-300">Código copiado!</div>
                        </div>
                    <div class="copyMessage hidden mt-2 text-green-600 font-semibold text-sm">Código copiado com sucesso!</div>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="bg-[{{$customizations['rodape_cor_rodape']}}] text-[{{$customizations['rodape_cor_text']}}] py-12 mt-30 w-full">
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const buttons = document.querySelectorAll(".copyPixCode");

            buttons.forEach(button => {
                button.addEventListener("click", function () {
                    const pixCode = this.getAttribute("data-pix-code"); // Obtém o código Pix

                    if (pixCode) {
                        // Copia o código Pix
                        const tempInput = document.createElement("input");
                        tempInput.value = pixCode;
                        document.body.appendChild(tempInput);
                        tempInput.select();
                        document.execCommand("copy");
                        document.body.removeChild(tempInput);

                        // Mostra o tooltip
                        const tooltip = this.nextElementSibling;
                        tooltip.classList.remove("opacity-0");
                        tooltip.classList.add("opacity-100");

                        // Esconde o tooltip após 2 segundos
                        setTimeout(() => {
                            tooltip.classList.remove("opacity-100");
                            tooltip.classList.add("opacity-0");
                        }, 2000);
                    }
                });
            });
        });
    </script>
        
        
    @stack('modals')
    @livewireScripts
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Supondo que você tenha a external_reference do pedido (por exemplo, a partir de um valor já disponível no seu front-end)
        var externalReference = '{{ $order->external_reference }}'; // Substitua por como você obtém isso (pode ser um valor do Laravel Blade ou variável JS)

        var pusher = new Pusher('2696d3838d296fdd359e', {
            cluster: 'sa1'
        });
    
        // Use a externalReference para assinar o canal dinâmico
        var channel = pusher.subscribe('webhooks_' + externalReference);
    
        // Escutar o evento "purchase"
        channel.bind('purchase', function(data) {
            url = '/checkout/payment/completed/' + data.external_reference;
            window.location.href = url;
        });
    </script>
    
    
</body>
</html>
