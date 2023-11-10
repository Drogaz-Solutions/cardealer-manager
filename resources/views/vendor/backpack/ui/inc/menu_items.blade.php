{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

@if(backpack_user()->is_admin)
<x-backpack::menu-item title="Cardealers" icon="la la-car" :link="backpack_url('cardealer')" />
@endif

<x-backpack::menu-item title="Voertuigen" icon="la la-car-alt" :link="backpack_url('car')" />
<x-backpack::menu-item title="Gebruikers" icon="la la-users" :link="backpack_url('user')" />