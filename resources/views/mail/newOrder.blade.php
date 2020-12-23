@component('mail::message')
    Hi , {{$order->owner->name}} You Have Anew Order From {{$order->user->name}}
    @if($order->realEstate->category == 'buy')
    to {{'buy '.$order->realEstate->title}} in {{$order->created_at->format('Y-m-d h:i')}} with cost {{$order->total}} {{currency()}}
    @else
    to {{'rent the '.$order->realEstate->title}} in {{$order->created_at->format('Y-m-d h:i')}} for {{$order->months}} Month(s) with cost {{$order->total}} {{currency()}}
    @endif
    <br>
Thanks , {{ config('app.name') }}
@endcomponent
