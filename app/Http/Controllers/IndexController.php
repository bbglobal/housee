<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Http\Request;
use App\Models\onlinePlay;
use App\Models\PlayRoom;
use App\Models\Porfile;
use App\Models\RoomId;
use App\Models\Ticket;
use App\Models\wallet;
use App\Models\Power;
use App\Models\User;
use App\Models\Withdraw;
use App\View\Components\Powers;
use Livewire\Attributes\Validate;
use Vonage\Meetings\Room;
use Validator;

class IndexController extends Controller
{
    public function index()
    {
        return view("frontend.index");
    }

    public function tickets()
    {
        $userId = Auth::user()->id;
        $tickets = Ticket::where("userId", $userId)->get();
        $data = compact("tickets");

        return view("frontend.tickets", $data);
    }

    public function ticketsPower()
    {
        $userId = Auth::user()->id;
        $tickets = Ticket::where("userId", $userId)->get();
        $data = compact("tickets");
        return view("frontend.power-tickets", $data);
    }

    public function ticketsRoom()
    {
        $userId = Auth::user()->id;
        $tickets = Ticket::where("userId", $userId)->get();
        $data = compact("tickets");
        return view("frontend.room-ticket", $data);
    }

    public function addTickets(Request $request, $ticketValue)
    {
        $userId = Auth::user()->id;
        $quantity = $request['q'];
        Wallet::where('userId', $userId)
            ->decrement('walletAmount', $ticketValue * $quantity);


        for ($i = 0; $i < $quantity; $i++) {
            $ticket = new Ticket;
            $ticket->userId = $userId;
            $ticket->ticketValue = $ticketValue;
            $ticket->save();
        }

        return redirect()->back();
    }

    public function powers()
    {
        $userId = Auth::user()->id;
        $powers = Power::where("userId", $userId)->get();
        $data = compact("powers");
        return view("frontend.power")->with($data);
    }

    public function addPowers(Request $request, $powerName)
    {
        $userId = Auth::user()->id;
        $totalPrice = $request->query('q');
        Wallet::join('users', 'users.id', '=', 'wallets.userId')
            ->distinct()
            ->where('users.id', $userId)
            ->decrement('walletAmount', $totalPrice);

        $power = new Power;
        $power->userId = $userId;
        $power->power = $powerName;
        $power->save();
        return redirect("powers");
    }

    public function start(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $ticket = $request->query('q');

        for ($i = 0; $i < $ticket; $i++) {
            Ticket::where('userId', $userId)
                ->where('ticketValue', '=', $id)
                ->first()
                ->delete();
        }

        $data = compact("id", 'ticket');
        return view("frontend.start")->with($data);
    }

    public function startPower(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $ticket = $request->query('q');

        for ($i = 0; $i < $ticket; $i++) {
            Ticket::where('userId', $userId)
                ->where('ticketValue', '=', $id)
                ->first()
                ->delete();
        }

        $data = compact("id", 'ticket');
        return view("frontend.power-start")->with($data);
    }

    public function startRoom(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $ticket = $request->query('q');

        for ($i = 0; $i < $ticket; $i++) {
            Ticket::where('userId', $userId)
                ->where('ticketValue', '=', $id)
                ->first()
                ->delete();
        }

        $data = compact("id", 'ticket');

        return view("frontend.startRoom")->with($data);
    }

    public function getRoomData($roomId)
    {
        $playCount = PlayRoom::where('roomId', $roomId)->count();
        session(['playCount' => $playCount]);
        return response()->json(['playCount' => $playCount]);
    }

    public function getGameDate($id)
    {
        $onlineCount = onlinePlay::where('gameId', $id)->count();
        session(['onlineCount' => $onlineCount]);
        return response()->json(['onlineCount' => $onlineCount]);
    }

    public function main($ticket)
    {
        $data = compact('ticket');
        return view("frontend.main")->with($data);
    }

    public function playWithPowers()
    {
        return view("frontend.play-with-powers");
    }

    public function playInRoom()
    {
        $roomIds = RoomId::all();

        return view("frontend.create-room", ['roomIds' => $roomIds]);
    }

    public function addRoomId(Request $request)
    {
        $userId = Auth::user()->id;
        $roomId = new RoomId;
        $roomId->userId = $userId;
        $roomId->roomid = $request['room_id'];
        $roomId->save();
        return redirect("/room-ticket");
    }

    public function checkRoom($roomId)
    {
        $room = RoomId::where('roomId', $roomId)->exists();

        return response()->json(['exists' => $room]);
    }

    public function joinRoom($ticket)
    {
        $data = compact('ticket');
        return view("frontend.room")->with($data);
    }

    public function addCoins()
    {
        return view('frontend.add-coins');
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'coins' => 'required'
        ]);

        $userId = Auth::user()->id;

        $withDrawRequest = new Withdraw;
        $withDrawRequest->walletId = $userId;
        $withDrawRequest->upiId = $request['upiId'];
        $withDrawRequest->via = $request['via'];
        $withDrawRequest->accountNumber = $request['accountNumber'];
        $withDrawRequest->accountTitle = $request['accountTitle'];
        $withDrawRequest->coins = $request['coins'];
        $withDrawRequest->save();

        Wallet::where('userId', $userId)
            ->decrement('walletAmount', $request['coins']);

        return redirect()->back()->with("success", "Your request has been submited, You'll have your coins in 12 hours");
    }

    public function winner($id)
    {
        $wallet = wallet::find($id);

        if (is_null($wallet)) {
            return redirect()->back()->with("error", "Sorry You might have done something wrong");
        } else {
            $wallet->walletAmount = $id;
            $wallet->save();
            return redirect("/")->with("success", "You Won");
        }
    }

    public function profile($id)
    {
        $user = User::where('users.id', $id)->first();

        $tickets = Ticket::selectRaw('COUNT(ticketValue) as ticket_count, ticketValue')
            ->where('userId', $id)
            ->groupBy('ticketValue')
            ->get();

        $powers = Power::selectRaw('COUNT(power) as power_count, power')
            ->where('userId', $id)
            ->groupBy('power')
            ->get();


        $data = compact('user', 'powers', 'tickets');

        return view('frontend.profile')->with($data);
    }

    public function changeProfile(Request $request, $id)
    {
        $userAvatar = User::where("id", $id)->first();

        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'contact' => 'required|max:15',
        ]);

        $user = User::find($id);
        if ($request['avatar'] != "") {
            $avatar = $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move('assets/img', $avatar);
        } else {
            $avatar = $userAvatar->avatar;
        }
        $user->avatar = url('/') . "/assets/img/" . $avatar;
        $user->name = $request['username'];
        $user->contact = $request['contact'];
        $user->save();

        return redirect()->back()->with("success", "profile updated successfully");
    }

    public function phonePe($coins)
    {
        $data = array(
            'merchantId' => 'PGTESTPAYUAT',
            'merchantTransactionId' => 'MT7850590068188104',
            'merchantUserId' => 'MUID123',
            'amount' => $coins * 100,
            'redirectUrl' => route('response'),
            'redirectMode' => 'POST',
            'callbackUrl' => route('response'),
            'mobileNumber' => '9999999999',
            'paymentInstrument' =>
            array(
                'type' => 'PAY_PAGE',
            ),
        );

        $encode = base64_encode(json_encode($data));

        $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
        $saltIndex = 1;

        $string = $encode . '/pg/v1/pay' . $saltKey;
        $sha256 = hash('sha256', $string);

        $finalXHeader = $sha256 . '###' . $saltIndex;

        $url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay";

        $response = Curl::to($url)
            ->withHeader('Content-Type:application/json')
            ->withHeader('X-VERIFY:' . $finalXHeader)
            ->withData(json_encode(['request' => $encode]))
            ->post();

        $rData = json_decode($response);

        return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);
    }

    public function response(Request $request)
    {
        $input = $request->all();

        $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
        $saltIndex = 1;

        $finalXHeader = hash('sha256', '/pg/v1/status/' . $input['merchantId'] . '/' . $input['transactionId'] . $saltKey) . '###' . $saltIndex;

        $response = Curl::to('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/' . $input['merchantId'] . '/' . $input['transactionId'])
            ->withHeader('Content-Type:application/json')
            ->withHeader('accept:application/json')
            ->withHeader('X-VERIFY:' . $finalXHeader)
            ->withHeader('X-MERCHANT-ID:' . $input['transactionId'])
            ->get();

        $walletData = (json_decode($response));

        $userId = Auth::user()->id;
        $wallet = new wallet;
        $wallet->userId = $userId;
        $wallet->transactionId =  $walletData->data->transactionId;
        $wallet->walletAmount =  $walletData->data->amount / 100;
        $wallet->save();

        return redirect("/add-coins");
    }
}
