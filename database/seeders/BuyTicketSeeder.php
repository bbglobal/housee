<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BuyTicket;

class BuyTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $buy = new BuyTicket;
        $buy->image = 'ticket-1.svg';
        $buy->ticket = '5';
        $buy->save();

        $buy = new BuyTicket;
        $buy->image = 'ticket-2.svg';
        $buy->ticket = '10';
        $buy->save();

        $buy = new BuyTicket;
        $buy->image = 'ticket-3.svg';
        $buy->ticket = '20';
        $buy->save();

        $buy = new BuyTicket;
        $buy->image = 'ticket-4.svg';
        $buy->ticket = '50';
        $buy->save();
    }
}
