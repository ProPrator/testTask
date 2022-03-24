<?php

namespace App\Console\Commands;

use App\Models\EntityStatus;
use App\Models\EntityType;
use App\Models\MoneyTransportInterface;
use App\Models\Prize;
use Illuminate\Console\Command;

class SendMoney extends Command
{
    /**
     * @var MoneyTransportInterface
     */
    private MoneyTransportInterface $transport;

    /**
     * @param MoneyTransportInterface $transport
     */
    public function __construct(MoneyTransportInterface $transport)
    {
        $this->transport = $transport;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(int $count)
    {
        $prizes = Prize::where('status', EntityStatus::NEW)
            ->where('type', EntityType::MONEY)
            ->whith('money')
            ->limit($count)
            ->get();

        //  тут мы должны были получкать карту пользователя)
        $cardNumber = '1312';

        $doneCount = 0;
        foreach ($prizes as $prize) {
            if ($this->transport->send($cardNumber, $prize->money)) {
                $prize->status = EntityStatus::DONE;
                $doneCount++;
            }
        }
        echo "Done $doneCount prize";
    }
}
