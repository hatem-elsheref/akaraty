@component('mail::message')
    Hi , {{$order->user->name}} Your Order From {{$order->owner->name}}
    @if($order->realEstate->category == 'buy')
        to {{'buy '.$order->realEstate->title}} in {{$order->created_at->format('Y-m-d h:i')}} with cost {{$order->total}} {{currency()}}
    @else
        to {{'rent the '.$order->realEstate->title}} in {{$order->created_at->format('Y-m-d h:i')}} for {{$order->months}} Month(s) with cost {{$order->total}} {{currency()}}
    @endif
    Has Been Approved
    <br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
