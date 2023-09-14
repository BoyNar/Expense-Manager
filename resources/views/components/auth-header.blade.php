
@php
    $generalsetting = \App\Models\GeneralSetting::first();
@endphp

<div class="login-brand">
    @if($generalsetting->logo != null)
    <img src="{{ asset('storage/'.$generalsetting->logo) }}"
        alt="logo"
        width="100"
        class="shadow-light" >
    @else
        <img src="{{ asset('img/stisla-fill.svg') }}"
        alt="logo"
        width="100"
        class="shadow-light rounded-circle">
    @endif
</div>
