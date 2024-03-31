<?php

namespace App\Console\Commands;

use App\Mail\DailyEmail;
use App\Models\Article;
use App\Models\Subscribes;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MailDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mail-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo "hey";
        $twentyFourHoursAgo = Carbon::now()->subHours(24);
        $todaysArticles = Article::whereBetween('created_at', [$twentyFourHoursAgo, Carbon::now()])->get();
        $articles = $todaysArticles->toArray();
        $mailbook = Subscribes::all();
        foreach ($mailbook as $key => $value) {
            Mail::to("$value->email")->send(new DailyEmail($articles));
        }
    }
}
