<?php
/**
 * @var $prize \App\Models\Prize
 */
?>
congratulation you win {{ $prize->getPrizeDetailsDescription() }} {{ $prize->type }}

@if($prize->type == \App\Models\EntityType::MONEY)
    Do you want to change your money to bonus with coefficient {{ \App\Models\ConversionCoefficient::VALUE }}
    <a href="/raffle/convert">change</a>
@endif



