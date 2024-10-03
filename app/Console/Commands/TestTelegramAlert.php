<?php

namespace App\Console\Commands;

use App\Services\TelegramService;
use Illuminate\Console\Command;

class TestTelegramAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Telegram alert system';

    /**
     * Execute the console command.
     */
    public function handle(TelegramService $telegramService)
    {
        $telegramService->sendMessage("🔔 This is a test alert from PiPulse!");
        $this->info('Test alert sent. Check your Telegram!');
    }
}
