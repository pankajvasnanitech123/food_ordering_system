<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Food Ordering System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        @php
            $waiterRoleId   = config('constants.user_types.waiter');
            $cashierRoleId  = config('constants.user_types.cashier');
            $adminRoleId  = config('constants.user_types.admin');
        @endphp
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            @if(auth()->user()->user_role_id == $waiterRoleId)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('items') }}">Items</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('orders') }}">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            </li>
        </ul>
    </div>
</nav>