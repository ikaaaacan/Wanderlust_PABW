@extends('layouts.ptw_master')

@section('content')

    <h2 class="welcome-text">
        Welcome back, <strong>{{ $user->nama }}</strong>
    </h2>

    <div class="cards-container">
        
        <div class="card card-large">
            <h3>Properties</h3>
            <div class="number">{{ $totalProperties }}</div>
        </div>

        <div class="card card-large">
            <h3>Total Tickets Sold</h3>
            <div class="number">{{ $totalTicketsSold }}</div>
        </div>

        <div class="card card-revenue">
            <h3>Revenue</h3>
            <div class="number">
                Rp. {{ number_format($totalRevenue, 0, ',', '.') }}
            </div>
        </div>

        <div class="card card-visitors">
            <h3>Visitors</h3>
            <div class="number">
                {{ $totalVisitors }} visitors
            </div>
        </div>

    </div>

@endsection