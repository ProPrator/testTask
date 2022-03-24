<?php
/**
 * @var $prize \App\Models\Prize
 */
?>
<div>
    Congratulation you win {{ $prize->getPrizeDetailsDescription() }} {{ $prize->type }}
    <br>
    You can refuse a prize
    <a href="/raffle/refuse/{{ $prize->id }}">refuse</a>
</div>
@if($prize->type == \App\Models\EntityType::MONEY)
    <div>
        Do you want to change your money to bonus with coefficient {{ \App\Models\ConversionCoefficient::VALUE }} <br>
        <a href="/raffle/convert/{{ $prize->id }}">change</a> <br>
        <hr>
        or you want to take this money to your card <br>


        <form method="POST" action="/money/send">
            @csrf
            <div>
                <input type="hidden" name="moneyId" value="{{ $prize->money->id }}">
            </div>
            <div>
                <label>Enter your card number </label>>

                <input name="cardNumber" type="text" />
            </div>

            <div class="flex justify-end mt-4">
                <input type="submit">
            </div>
        </form>
    </div>
@endif



