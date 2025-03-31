<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PurchaseNotification implements ShouldBroadcast // Adicione a interface aqui
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function broadcastOn()
    {
        // Use o external_reference para criar um canal único para cada pedido
        return new Channel('webhooks_' . $this->order->external_reference); // Canal público dinâmico
    }


    public function broadcastAs()
    {
        return 'purchase';
    }

    public function broadcastWith()
    {
        return [
            'external_reference' => $this->order->external_reference,
            'status' => $this->order->status,
        ];
    }
}

