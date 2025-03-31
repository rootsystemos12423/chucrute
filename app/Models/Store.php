<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

    protected $table = 'users_checkout_stores';

    protected $fillable = [
        'user_id', 'name', 'currency', 'settings',
    ];

    public function checkouts()
    {
        return $this->hasMany(Checkout::class); // Um store pode ter muitos checkouts
    }

    public function shipping()
    {
        return $this->hasMany(Shipping::class); // Um store pode ter muitos checkouts
    }

    public function customizations()
    {
        return $this->hasOne(CheckoutCustomizationSetting::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::created(function ($store) {
            // Criar os métodos de pagamento com desconto 0
            $paymentMethods = ['credit_card', 'pix', 'bank_slip'];

            foreach ($paymentMethods as $method) {
                CheckoutsPaymentDiscount::create([
                    'store_id' => $store->id,
                    'payment_method' => $method,
                    'discount_percentage' => 0.00
                ]);
            }
        });

        static::created(function ($store) {
             Shipping::create([
                    'store_id' => $store->id,
                    'name' => 'Frete Grátis',
                    'price' => 0.00,
                    'min_delivery_days' => 5,
                    'max_delivery_days' => 7,
                    'status' => 'active',
                ]);
        });
        static::created(function ($store) {
            CheckoutCustomizationSetting::create([
                'store_id' => $store->id,
                'settings' => json_encode([
                    'cabecalho_cor_cabecalho' => '#ff0000', // Cor alterada
                    'cabecalho_cor_elementos' => '#00ff00', // Cor alterada
                    'cabecalho_logo_position' => 'Esquerda',
                    'cabecalho_anuncio_text' => null,
                    'cabecalho_cronometro_text' => 'Oferta termina em',
                    'cabecalho_cronometro_time' => '3',
                    'cabecalho_bar_color' => '#0000ff', // Cor alterada
                    'cabecalho_text_color' => '#ffffff',
                    'cabecalho_cronometro_color' => '#ffc926',
                    'rodape_cor_rodape' => '#f0f0f0', // Cor alterada
                    'rodape_cor_text' => '#555555', // Cor alterada
                    'rodape_atendimento' => '0',
                    'rodape_position_mobile' => 'left',
                    'rodape_show_payment_icon' => '1',
                    'rodape_show_security_badge' => '1',
                    'rodape_show_store_name' => '1',
                    'rodape_show_site_adress' => '1',
                    'rodape_show_business_adress' => '1',
                    'rodape_show_cnpj_details' => '1',
                    'rodape_cnpj' => '00.000.000/0001-00',
                    'rodape_razao_social' => 'Loja Online Ltda',
                    'resume_cart_show' => 'always_open',
                    'appearance_title_color' => '#111111', // Cor alterada
                    'appearance_description_color' => '#222222', // Cor alterada
                    'appearance_steps_color' => '#999999',
                    'appearance_totalvalue_color' => '#44c485',
                    'appearance_tag_color' => '#ff00ff', // Cor alterada
                    'appearance_number_color' => '#ffffff',
                    'appearance_tag_color_second' => '#00ffff', // Cor alterada
                    'appearance_number_color_second' => '#ffffff',
                    'appearance_progress_bar_color' => '#36b376',
                    'appearance_number_color_third' => '#ffffff',
                    'appearance_button_color' => '#ff8800', // Cor alterada
                    'appearance_text_color' => '#ffffff',
                    'appearance_button_color_second' => '#c4c4c4',
                    'appearance_text_color_second' => '#000000',
                    'appearance_text_color_third' => '#000000',
                    'appearance_tag_color_third' => '#000000',
                    'appearance_number_color_fourth' => '#ffffff',
                    'appearance_tipografy_primary' => 'work_sans',
                    'appearance_tipografy_second' => 'rubik',
                    'appearance_formats' => 'arredondado',
                    'orderbump_bg_color' => '#ffffff',
                    'orderbump_border_color' => '#d1d1d1',
                    'orderbump_button_color' => '#000000',
                    'cabecalho_logo_path' => null, // Sem logo no início
                ], JSON_UNESCAPED_UNICODE) // Garante que caracteres especiais sejam salvos corretamente
            ]);
        });        
    }
}
