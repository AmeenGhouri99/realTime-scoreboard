<!DOCTYPE html>
<html>

<head>
    <title>Real-Time Items</title>
    @livewireStyles
</head>

<body>

    <div>
        <h1>Items</h1>
        @if (session('success'))
            <div>{{ session('success') }}</div>
        @endif

        @livewire('items-list')

        <form action="{{ route('items.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Item Name" required>
            <button type="submit">Add Item</button>
        </form>
    </div>

    @livewireScripts
    {{-- <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script> --}}
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

</body>

</html>
