<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Helpers\CurrencyControlValidation;
use App\Helpers\Message;
use App\Helpers\OrderControlValidation;
use App\Helpers\WalletControlValidation;
use App\Http\Controllers\Controller;
use App\Http\Requests\setOrder;
use App\Models\Currency;
use App\Models\Wallet;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ClientOrderController extends Controller
{
    protected $user;
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->middleware(function (Request $request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
        $this->orderRepository = $orderRepository;
    }

    public function setTransferCurrency(setOrder $setOrder)
    {
        $success = true;
        $data = [];
        DB::beginTransaction();
        try {
            /* بررسی سه شرط ذکر شده */
            $check = OrderControlValidation::fullCheck($setOrder->address, $setOrder->currency, $setOrder->transaction_volume);

            if ($check == 'true') {

                /* محاسبه میزان فی */
                $calculate = OrderControlValidation::calculateFee($setOrder->currency, $setOrder->transaction_volume);

                $order_details = ['user_id' => $this->user->id,
                    'currency_id' => $setOrder->currency,
                    'amount' => $calculate['total'],
                    'fee' => $calculate['division'],
                ];

                /* عملیات ذخیره سازی */
                $data = $this->orderRepository->setOrders($order_details);


                $calculateBalance = OrderControlValidation::calculateWalletBalance($setOrder->address, $setOrder->transaction_volume);

                /* بروزرسانی دارایی کیف پول */
                Wallet::query()->where('address', '=', $setOrder->address)->update([
                    'balance' => $calculateBalance
                ]);
            } else {
                $success = false;
            }

            DB::commit();
        } catch (\Exception $exception) {
            $success = false;
            DB::rollBack();
            return $exception->getMessage();
        }

        if ($success) {
            return Message::message($data, true);
        } else {
            return Message::message([], false);
        }
    }
}
