<?php

namespace App\Jobs;

use App\Services\Api\WhatsappService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendWhatsAppNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $number;
    protected $message;

    /**
     * Create a new job instance.
     */
    public function __construct(?string $number, string $message)
    {
        $this->number = $number;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $whatsapp = new WhatsappService();

        $whatsapp->sendMessage($this->number, $this->message);
    }
}
