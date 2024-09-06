@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert
                    alert-{{ $message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}"
                    role="alert"
        >
            @if ($message['important'])
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif

            {!! $message['message'] !!}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}

@if(Session::has('message'))
    <div class="alert alert-success" role="alert">
        <p>{!! Session::get('message') !!}</p>
        <a class="notification-close" href="#"><i class="fa fa-times"></i></a>
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-error" role="alert">
        <p>{!! Session::get('error') !!}</p>
        <a class="notification-close" href="#"><i class="fa fa-times"></i></a>
    </div>
@endif

@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-error" role="alert" >
            <p style="color: red">{{ $error }}</p>
            <a class="notification-close" href="#"><i class="fa fa-times"></i></a>
        </div>
    @endforeach
@endif
