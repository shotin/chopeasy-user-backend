<?php

namespace App\Console\Commands;

use App\Models\Due;
use App\Models\DueUser;
use App\Models\Set;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class DueUserReconcile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'due:reconcile-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reconcile dues for created users without dues.';


    // In a custom Artisan Command
    public function handle()
    {
        $users = User::select('id', 'set_id')->get();
        foreach ($users as $user) {
            $applicableDues = Due::applicable($user)->get();

            foreach ($applicableDues as $due) {
                if (!DueUser::where('user_id', $user->id)->where('due_id', $due->id)->exists()) {
                    DueUser::create([
                        'user_id' => $user->id,
                        'due_id' => $due->id,
                        'status' => 'pending',
                    ]);
                }
            }
        }
    }
}
