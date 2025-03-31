<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Checkout;
use App\Models\OrderBump;
use App\Models\Store;
use App\Models\CheckoutsPaymentDiscount;
use App\Models\CheckoutCustomizationSetting;
use Illuminate\Support\Facades\Log;
use App\Models\CheckoutOrder;
use App\Models\Gateway;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\GoogleAdsPixel;
use App\Mail\OrderGeneratedMail;
use App\Mail\OrderPaidMail;

class ReportsController extends Controller
{
    public function index(){

        return view('reports');
    }

    public function filterData(Request $request)
    {
        $request->validate([
            'timeFrame' => 'required',
            'store_id' => 'required',
        ]);
    
        $timeFrame = $request->input('timeFrame');
        $query = CheckoutOrder::query();
        $previousQuery = null;
    
        // Definir período atual e anterior
        if ($timeFrame == 'today') {
            $query->whereDate('created_at', today());
            $previousQuery = CheckoutOrder::where('status', 'paid')->where('store_id', $request->store_id)->whereDate('created_at', today()->subDay());
            $startDate = now()->startOfDay();
            $endDate = now()->endOfDay();
            $previousStartDate = now()->subDay()->startOfDay();
            $previousEndDate = now()->subDay()->endOfDay();
        } elseif ($timeFrame == 'yesterday') {
            $query->whereDate('created_at', today()->subDay());
            $previousQuery = CheckoutOrder::where('status', 'paid')->where('store_id', $request->store_id)->whereDate('created_at', today()->subDays(2));
            $startDate = now()->subDay()->startOfDay();
            $endDate = now()->subDay()->endOfDay();
            $previousStartDate = now()->subDays(2)->startOfDay();
            $previousEndDate = now()->subDays(2)->endOfDay();
        } elseif ($timeFrame == 'week') {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            $previousQuery = CheckoutOrder::where('status', 'paid')->where('store_id', $request->store_id)
                ->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()]);
            $startDate = now()->startOfWeek();
            $endDate = now()->endOfWeek();
            $previousStartDate = now()->subWeek()->startOfWeek();
            $previousEndDate = now()->subWeek()->endOfWeek();
        } elseif ($timeFrame == 'month') {
            $query->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
            $previousQuery = CheckoutOrder::where('status', 'paid')->where('store_id', $request->store_id)
                ->whereBetween('created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()]);
            $startDate = now()->startOfMonth();
            $endDate = now()->endOfMonth();
            $previousStartDate = now()->subMonth()->startOfMonth();
            $previousEndDate = now()->subMonth()->endOfMonth();
        } elseif ($timeFrame && strtotime($timeFrame)) {
            $query->whereDate('created_at', $timeFrame);
            $previousQuery = CheckoutOrder::where('status', 'paid')->where('store_id', $request->store_id)->whereDate('created_at', today()->subDay());
            $date = Carbon::parse($timeFrame);
            $startDate = $date->copy()->startOfDay();
            $endDate = $date->copy()->endOfDay();
            $previousStartDate = now()->subDay()->startOfDay();
            $previousEndDate = now()->subDay()->endOfDay();
        }
    
        // Obter pedidos e calcular totais
        $orders = $query->orderBy('created_at', 'asc')->get();
        $totalPedidos = $orders->count();
        $lucroLiquido = $query->clone()->where('status', 'paid')->sum('total_value');
    
        // Calcular porcentagem de variação
        $percentage = 0;
        if ($previousQuery) {
            $previousOrders = $previousQuery->orderBy('created_at', 'asc')->get();
            $previousTotalPedidos = $previousOrders->count();
    
            if ($previousTotalPedidos > 0) {
                $percentage = (($totalPedidos - $previousTotalPedidos) / $previousTotalPedidos) * 100;
            } else {
                $percentage = $totalPedidos > 0 ? 100 : 0;
            }
        }
    
        // Preparar dados do gráfico
        $period = new CarbonPeriod($startDate, $endDate);
        $datesInPeriod = collect($period)->map(fn($date) => $date->format('Y-m-d'))->unique();
    
        $lucroLiquidoByDate = CheckoutOrder::where('status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('store_id', $request->store_id)
            ->selectRaw('DATE(created_at) as date, SUM(total_value/100) as total')
            ->groupBy('date')
            ->pluck('total', 'date');

        $receitaLiquidaByDate = CheckoutOrder::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(total_value/100) as total')
            ->where('store_id', $request->store_id)
            ->groupBy('date')
            ->pluck('total', 'date');

        $formatMoney = fn($value) => 'R$ ' . number_format($value / 100, 2, ',', '.');


        $aprovadosQuery = CheckoutOrder::where('status', 'paid')
            ->where('store_id', $request->store_id)
            ->whereBetween('created_at', [$startDate, $endDate]);

        $pendentesQuery = CheckoutOrder::where('status', 'pending')
            ->where('store_id', $request->store_id)
            ->whereBetween('created_at', [$startDate, $endDate]);

        $totalAprovados = $aprovadosQuery->sum('total_value');
        $totalPendentes = $pendentesQuery->sum('total_value');
        $countAprovados = $aprovadosQuery->count();
        $countPendentes = $pendentesQuery->count();

        // Consultas para o período ANTERIOR (comparativo)
        $previousAprovadosQuery = CheckoutOrder::where('status', 'paid')
        ->where('store_id', $request->store_id)
        ->whereBetween('created_at', [$previousStartDate, $previousEndDate]);

        $previousPendentesQuery = CheckoutOrder::where('status', 'pending')
        ->where('store_id', $request->store_id)
        ->whereBetween('created_at', [$previousStartDate, $previousEndDate]);

        $previousTotalAprovados = $previousAprovadosQuery->sum('total_value');
        $previousTotalPendentes = $previousPendentesQuery->sum('total_value');
        $previousCountAprovados = $previousAprovadosQuery->count();
        $previousCountPendentes = $previousPendentesQuery->count();

        // Calcular porcentagens
        $percentageAprovados = $this->calculatePercentage($countAprovados, $previousCountAprovados);
        $percentagePendentes = $this->calculatePercentage($countPendentes, $previousCountPendentes);

        // Calcular Order Bump para o período atual
        $currentBumpOrders = CheckoutOrder::with(['cart.items' => function($query) {
            $query->where('is_bump', 1);
        }])
        ->where('status', 'paid')
        ->where('store_id', $request->store_id)
        ->whereBetween('created_at', [$startDate, $endDate])
        ->whereHas('cart.items', function($query) {
            $query->where('is_bump', 1);
        })
        ->get();

        $totalBumpValue = $currentBumpOrders->sum('total_value');
        $totalBumpCount = $currentBumpOrders->count();

        // Calcular Order Bump para o período anterior
        $previousBumpOrders = CheckoutOrder::with(['cart.items' => function($query) {
            $query->where('is_bump', 1);
        }])
        ->where('status', 'paid')
        ->where('store_id', $request->store_id)
        ->whereBetween('created_at', [$previousStartDate, $previousEndDate])
        ->whereHas('cart.items', function($query) {
            $query->where('is_bump', 1);
        })
        ->get();

        $previousBumpCount = $previousBumpOrders->count();
        $previousBumpValue = $previousBumpOrders->sum('total_value');

        // Calcular porcentagem (baseado no valor monetário)
        $percentageBump = $previousBumpValue > 0 
        ? (($totalBumpValue - $previousBumpValue) / $previousBumpValue) * 100
        : ($totalBumpValue > 0 ? 100 : 0);

        // Calcular Ticket Médio (período atual)
        $paidOrders = CheckoutOrder::where('status', 'paid')
        ->where('store_id', $request->store_id)
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();

        $ticketMedio = $paidOrders->avg('total_value'); // Média em centavos
        $ticketMedioFormatado = $ticketMedio ? number_format($ticketMedio / 100, 2, ',', '.') : '0,00';

        // Calcular Ticket Médio (período anterior) para a porcentagem
        $previousPaidOrders = CheckoutOrder::where('status', 'paid')
        ->where('store_id', $request->store_id)
        ->whereBetween('created_at', [$previousStartDate, $previousEndDate])
        ->get();

        $previousTicketMedio = $previousPaidOrders->avg('total_value');

        // Calcular variação percentual
        $percentageTicket = 0;
        if ($previousTicketMedio > 0) {
        $percentageTicket = (($ticketMedio - $previousTicketMedio) / $previousTicketMedio) * 100;
        } elseif ($ticketMedio > 0) {
        $percentageTicket = 100; // Se não havia ticket médio antes e agora tem
        }

        $checkouts = Checkout::where('updated_at', '>=', Carbon::now()->subMinutes(10))
        ->where('store_id', $request->store_id)
        ->get();

    // Contar a quantidade por etapa
    $contagemEtapas = $checkouts->groupBy('steps')
        ->map(fn ($group) => $group->count());

    // Determinar a etapa mais avançada alcançada
    $etapaMaxima = $checkouts->max('steps') ?? -1;

    // Calcular progresso (cada etapa vale 20%)
    $progresso = $etapaMaxima >= 0 ? ($etapaMaxima + 1) * 20 : 0;

    // Mapear nomes das etapas
    $nomesEtapas = [
        0 => 'Checkout',
        1 => 'Dados pessoais', 
        2 => 'Entrega',
        3 => 'Pagamento',
        4 => 'Comprou'
    ];

    // Construir array de etapas com valores
    $etapasFormatadas = [];
    foreach ($nomesEtapas as $key => $nome) {
        $etapasFormatadas[] = [
            'nome' => $nome,
            'valor' => $contagemEtapas->get($key, 0)
        ];
    }

    // Consultar pedidos Pix e Cartão com base no período selecionado
    $pixOrders = CheckoutOrder::where('payment_method', 'pix')
    ->where('store_id', $request->store_id)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get();

    $cardOrders = CheckoutOrder::where('payment_method', 'credit_card')
    ->where('store_id', $request->store_id)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get();

    // Função para calcular porcentagens
    $calculatePercentages = function ($orders) {
    $total = $orders->count();
    if ($total === 0) return [
        'Pagos' => 0,
        'Pendentes' => 0,
        'Recusados' => 0
    ];

    return [
        'Pagos' => ($orders->where('status', 'paid')->count() / $total) * 100,
        'Pendentes' => ($orders->where('status', 'pending')->count() / $total) * 100,
        'Recusados' => ($orders->where('status', 'refused')->count() / $total) * 100
    ];
    };

    // Calcular para Pix
    $pixPercent = $calculatePercentages($pixOrders);

    // Calcular para Cartão
    $cardPercent = $calculatePercentages($cardOrders);

    // Consultar dados do período anterior para cálculo de variação
    $previousPixOrders = CheckoutOrder::where('payment_method', 'pix')
    ->where('store_id', $request->store_id)
    ->whereBetween('created_at', [$previousStartDate, $previousEndDate])
    ->get();

    $previousCardOrders = CheckoutOrder::where('payment_method', 'credit_card')
    ->where('store_id', $request->store_id)
    ->whereBetween('created_at', [$previousStartDate, $previousEndDate])
    ->get();

    // Calcular variação percentual
    $calculateVariation = function ($current, $previous) {
    if ($previous->count() === 0) {
        return $current->count() > 0 ? 100 : 0;
    }
    return (($current->count() - $previous->count()) / $previous->count()) * 100;
    };

    $pixVariation = $calculateVariation($pixOrders, $previousPixOrders);
    $cardVariation = $calculateVariation($cardOrders, $previousCardOrders);

    $totalOrders = CheckoutOrder::where('store_id', $request->store_id)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->count();

    $pixCount = CheckoutOrder::where('payment_method', 'pix')
        ->where('store_id', $request->store_id)
        ->whereBetween('created_at', [$startDate, $endDate])
        ->count();

    $cardCount = CheckoutOrder::where('payment_method', 'credit_card')
        ->where('store_id', $request->store_id)
        ->whereBetween('created_at', [$startDate, $endDate])
        ->count();

    // Calcular porcentagens (evitando divisão por zero)
    $pixPercentage = $totalOrders > 0 ? ($pixCount / $totalOrders) * 100 : 0;
    $cardPercentage = $totalOrders > 0 ? ($cardCount / $totalOrders) * 100 : 0;

    // Consultar checkouts do período selecionado pelo usuário
    $checkouts2 = Checkout::where('store_id', $request->store_id)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get();

    // Contar a quantidade por etapa
    $contagemEtapas = $checkouts2->groupBy('steps')
    ->map(fn ($group) => $group->count());

    // Mapear etapas para o funnel (steps 1 a 4) com fallback para 0
    $etapasFunnel = [
    1 => ['label' => 'Dados Pessoais', 'valor' => $contagemEtapas->get(1, 0)],
    2 => ['label' => 'Entrega', 'valor' => $contagemEtapas->get(2, 0)],
    3 => ['label' => 'Pagamento', 'valor' => $contagemEtapas->get(3, 0)],
    4 => ['label' => 'Comprou', 'valor' => $contagemEtapas->get(4, 0)]
    ];

    // Consultar pedidos com cartão de crédito no período selecionado
    $orders2 = CheckoutOrder::where('payment_method', 'credit_card')
    ->where('store_id', $request->store_id)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get();

    // Contagem de parcelas
    $installmentsCount = [
    '1x' => 0,
    '2x' => 0,
    '3x' => 0,
    '4x' => 0,
    '5+' => 0
    ];

    foreach ($orders2 as $order) {
    $installments = $order->installments;

    if ($installments == 1) {
        $installmentsCount['1x']++;
    } elseif ($installments == 2) {
        $installmentsCount['2x']++;
    } elseif ($installments == 3) {
        $installmentsCount['3x']++;
    } elseif ($installments == 4) {
        $installmentsCount['4x']++;
    } elseif ($installments >= 5) {
        $installmentsCount['5+']++;
    }
    }

    // Calcular valores totais pagos
    $pixPaidOrders = CheckoutOrder::where('payment_method', 'pix')
    ->where('status', 'paid')
    ->where('store_id', $request->store_id)
    ->whereBetween('created_at', [$startDate, $endDate]);

    $totalPixPaid = $pixPaidOrders->sum('total_value');
    $countPixPaid = $pixPaidOrders->count();


    $cardPaidOrders = CheckoutOrder::where('payment_method', 'credit_card')
    ->where('status', 'paid')
    ->where('store_id', $request->store_id)
    ->whereBetween('created_at', [$startDate, $endDate]);

    $totalCardPaid = $cardPaidOrders->sum('total_value');
    $countCardPaid = $cardPaidOrders->count();

        return response()->json([
            'success' => true,
            'cards' => [
            [
                'title' => 'Receita líquida',
                'value' => $formatMoney($orders->sum('total_value')),
                'extra' => "($totalPedidos)",
                'percentage' => number_format($percentage, 2) . '%',
                'percentage_color' => $percentage > 0 ? '#4a9f0c' : ($percentage < 0 ? '#d9534f' : '#888888'),
                'background' => 'bg-white'
            ],
            [
                'title' => 'Lucro líquido',
                'value' => $formatMoney($lucroLiquido),
                'percentage' => number_format($percentage, 2) . '%',
                'percentage_color' => $percentage > 0 ? '#4a9f0c' : ($percentage < 0 ? '#d9534f' : '#888888'),
                'background' => 'bg-[#222222]'
            ],
            [
                'title' => 'Marketings',
                'value' => 'R$ 0,00',
                'percentage' => '0%',
                'percentage_color' => '#888888',
                'background' => 'bg-white'
            ]
        ],
            'chart' => [
                'series' => [
                    [
                        'name' => 'Lucro Líquido',
                        'data' => $datesInPeriod->map(fn($date) => (float) number_format($lucroLiquidoByDate[$date] ?? 0, 2, '.', ''))->toArray(),
                        'color' => '#f6339a'
                    ],
                    [
                        'name' => 'Taxas e Impostos',
                        'data' => array_fill(0, $datesInPeriod->count(), 0),
                        'color' => '#00bcff'
                    ],
                    [
                        'name' => 'Marketing',
                        'data' => array_fill(0, $datesInPeriod->count(), 0),
                        'color' => '#f59e0b'
                    ],
                    [
                        'name' => 'Custo De Produtos',
                        'data' => array_fill(0, $datesInPeriod->count(), 0),
                        'color' => '#22c55e'
                    ],
                    [
                        'name' => 'Receita Liquida',
                        'data' => $datesInPeriod->map(fn($date) =>  number_format($receitaLiquidaByDate[$date] ?? 0, 2, '.', ''))->toArray(),
                        'color' => '#8b5cf6'
                    ],
                ],
                'categories' => $datesInPeriod->map(fn($date) => Carbon::parse($date)->format('d/m'))->toArray()
            ],
            'cards02' => [
                    [
                        'title' => 'Pedidos Aprovados',
                        'value' => 'R$ ' . number_format($totalAprovados / 100, 2, ',', '.'),
                        'extra' => "($countAprovados)",
                        'percentage' => number_format($percentageAprovados, 2) . '%',
                        'percentage_color' => $percentageAprovados > 0 ? '#4a9f0c' : 
                                        ($percentageAprovados < 0 ? '#d9534f' : '#888888'),
                        'background' => 'bg-white'
                    ],
                    [
                        'title' => 'Pedidos Pendentes',
                        'value' => 'R$ ' . number_format($totalPendentes / 100, 2, ',', '.'),
                        'extra' => "($countPendentes)",
                        'percentage' => number_format($percentagePendentes, 2) . '%',
                        'percentage_color' => $percentagePendentes > 0 ? '#4a9f0c' : 
                                            ($percentagePendentes < 0 ? '#d9534f' : '#888888'),
                        'background' => 'bg-white'
                    ],
                    [
                        'title' => 'Compra 1-Click',
                        'value' => 'R$ 0,00',
                        'extra' => '(0)',
                        'percentage' => '0%',
                        'percentage_color' => '#888888',
                        'background' => 'bg-white'
                    ]
                ],
            'cards03' => [
                [
                    'title' => 'Recuperados',
                    'value' => 'R$ 0,00',
                    'extra' => '(0)',
                    'percentage' => '0%',
                    'percentage_color' => '#888888',
                    'background' => 'bg-white'
                ],
                [
                    'title' => 'Order Bump',
                    'value' => 'R$ ' . number_format($totalBumpValue / 100, 2, ',', '.'),
                    'extra' => "($totalBumpCount)",
                    'percentage' => number_format($percentageBump, 2) . '%',
                    'percentage_color' => $percentageBump > 0 ? '#4a9f0c' : ($percentageBump < 0 ? '#d9534f' : '#888888'),
                    'background' => 'bg-white'
                ],
                [
                    'title' => 'Upsell',
                    'value' => 'R$ 0,00',
                    'extra' => '(0)',
                    'percentage' => '0%',
                    'percentage_color' => '#888888',
                    'background' => 'bg-white'
                ]
            ],
            'cards04' => [
                [
                    'title' => 'Margem de Lucro',
                    'value' => 'R$ 0,00',
                    'percentage' => '0%',
                    'percentage_color' => '#888888',
                    'background' => 'bg-white'
                ],
                [
                    'title' => 'Ticket Médio',
                    'value' => 'R$ ' . $ticketMedioFormatado,
                    'percentage' => number_format($percentageTicket, 2) . '%',
                    'percentage_color' => $percentageTicket > 0 ? '#4a9f0c' : 
                        ($percentageTicket < 0 ? '#d9534f' : '#888888'),
                    'background' => 'bg-white'
                ],
                [
                    'title' => 'Taxas e Impostos',
                    'value' => 'R$ 0,00',
                    'percentage' => '0%',
                    'percentage_color' => '#888888',
                    'background' => 'bg-white'
                ],
                [
                    'title' => 'Custo de Produtos',
                    'value' => 'R$ 0,00',
                    'percentage' => '0%',
                    'percentage_color' => '#888888',
                    'background' => 'bg-white'
                ],
                [
                    'title' => 'CPA',
                    'value' => 'R$ 0,00',
                    'percentage' => '0%',
                    'percentage_color' => '#888888',
                    'background' => 'bg-white'
                ],
                [
                    'title' => 'ROI',
                    'value' => 'R$ 0,00',
                    'percentage' => '0%',
                    'percentage_color' => '#888888',
                    'background' => 'bg-white'
                ],
            ],
            'metaData' => [
                [
                    'metaTitulo' => 'Minha Meta',
                    'editarTexto' => 'Editar Meta',
                    'progresso' => 100,
                    'valorAtual' => "R$ 0,00",
                    'metaTotal' => "R$ 0,00",
                ],
            ],
            'comportamento10Min' => [
                [
                    'tempo' => '10 minutos',
                    'progresso' => $progresso,
                    'etaps' => $etapasFormatadas
                ]
            ],
            'percentagePix' => [
            [
                'status' => [
                    [
                        'nome' => 'Pagos',
                        'valor' => round($pixPercent['Pagos'], 2)
                    ],
                    [
                        'nome' => 'Pendentes',
                        'valor' => round($pixPercent['Pendentes'], 2)
                    ],
                    [
                        'nome' => 'Recusados',
                        'valor' => round($pixPercent['Recusados'], 2)
                    ]
                ],
                'total_vendas' => $formatMoney($totalPixPaid),
                'count_vendas' => $countPixPaid,
            ]
        ],
        'percentageCard' => [
            [
                'status' => [
                    [
                        'nome' => 'Pagos',
                        'valor' => round($cardPercent['Pagos'], 2)
                    ],
                    [
                        'nome' => 'Pendentes',
                        'valor' => round($cardPercent['Pendentes'], 2)
                    ],
                    [
                        'nome' => 'Recusados',
                        'valor' => round($cardPercent['Recusados'], 2)
                    ]
                ],
                'total_vendas' => $formatMoney($totalCardPaid),
                'count_vendas' => $countCardPaid,
            ]
        ],
            'percentageMethods' => [
                [
                    'methods' => [
                        [
                            'nome' => 'Cartão',
                            'valor' => round($cardPercentage, 2),
                            'cor' => '#45c9f3'
                        ],
                        [
                            'nome' => 'Pix',
                            'valor' => round($pixPercentage, 2),
                            'cor' => '#ff0983'
                        ],
                        [
                            'nome' => 'Boleto',
                            'valor' => 0,
                            'cor' => '#18243a'
                        ],
                    ]
                ]
            ],
            'installmentsChart' => [
                [
                    'methods' => [
                        $installmentsCount['1x'],
                        $installmentsCount['2x'],
                        $installmentsCount['3x'],
                        $installmentsCount['4x'],
                        $installmentsCount['5+']
                    ],
                    'labels' => ['1x sem juros', '2x sem juros', '3x sem juros', '4x sem juros', '5x ou mais'],
                    'colors' => ['#3b82f6', '#22c55e', '#f59e0b', '#ef4444', '#8b5cf6']
                ]
            ],
           'comportamentoFunnel' => [
                [
                    'values' => array_values(array_column($etapasFunnel, 'valor')),
                    'labels' => array_values(array_column($etapasFunnel, 'label')),
                    'colors' => ['#81D4FA', '#FF80AB'],
                ]
            ],
        ]);        
    }
    
    private function calculatePercentage($current, $previous)
        {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return (($current - $previous) / $previous) * 100;
        }



}
