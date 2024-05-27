<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\wallet;
use Closure;

class OnlineMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->online();
        $this->addCoins();

        return $next($request);
    }

    private function online()
    {
        $users = DB::table(config('session.table'))
            ->distinct()
            ->select(['users.id', 'users.name', 'users.email'])
            ->whereNotNull('user_id')
            ->leftJoin('users', config('session.table') . '.user_id', '=', 'users.id')
            ->count();

        view()->share('users', $users);
    }
    public function addCoins()
    {
        $userId = session()->get("userId");
        $walletAmount = Wallet::join('users', 'users.id', '=', 'wallets.userId')
                                ->where('users.id', $userId)
                                ->sum('walletAmount');

        $formattedWalletAmount = number_format($walletAmount);
        view()->share('formattedWalletAmount', $formattedWalletAmount);
    }
}
