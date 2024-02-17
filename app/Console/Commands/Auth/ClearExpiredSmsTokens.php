<?php

namespace App\Console\Commands\Auth;

use App\Models\ActiveCode;
use Illuminate\Console\Command;

class ClearExpiredSmsTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-expired-sms-tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear expired active code tokens';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ActiveCode::where('expired_at', '<', now())->delete();
    }
}
