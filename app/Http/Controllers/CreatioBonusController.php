<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ABMLoyaltyService;

class CreatioBonusController extends Controller
{
    public function index(Request $request)
    {
        $bonus_result = [];

        if ($request->has('number')) {
            $abmLoyalty = new ABMLoyaltyService($request->number);
            $bonus_result = ['message' => 'Такого номера (карты / телефона) нет в базе.'];

            if ($abmLoyalty->ok()) {
                $bonus_result = [
                    'name' => $abmLoyalty->getUserName(),
                    'birthday' => $abmLoyalty->getUserBirthday(),
                    'balance' => (int)$abmLoyalty->getBalance(),
                    'available' => (int)$abmLoyalty->getAvailableBalance(),
                    'blocked' => (int)$abmLoyalty->getBlockedBalance(),
                ];
            }
        }

        return view('creatio.bonuses', ['bonus_result' => $bonus_result]);
        //2900000550872
        //77757378004
    }
}
