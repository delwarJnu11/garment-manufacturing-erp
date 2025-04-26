<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QualityCheckCompleted extends Notification
{
    protected $workOrder;
    protected $orderNumber;

    public function __construct($workOrder, $orderNumber)
    {
        $this->workOrder = $workOrder;
        $this->orderNumber = $orderNumber;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable)
    {
        return [
            'message' => "QC Completed for Work Order #{$this->orderNumber}",
            'work_order_id' => $this->workOrder->id,
            'order_id' => $this->workOrder->order_id,
            'route' => route('packaging.create', [
                'work_order_id' => $this->workOrder->id,
                'order_id' => $this->workOrder->order_id
            ])
        ];
    }
}
