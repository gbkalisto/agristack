<h2>Welcome {{ $account->name }}</h2>

<p>Role: {{ $account->role }}</p>

@if ($account->role === 'division')
    <p>Division Dashboard</p>
@endif

@if ($account->role === 'district')
    <p>District Dashboard</p>
@endif

@if ($account->role === 'block')
    <p>Block Dashboard</p>
@endif



{{-- Logout Button --}}
<form method="POST" action="{{ route('account.logout') }}" style="margin-top: 20px;">
    @csrf
    <button type="submit" class="btn btn-danger">
        Logout
    </button>
</form>
