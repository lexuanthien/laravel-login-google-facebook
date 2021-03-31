@extends('layouts.app')

@section('title', 'ʟ ᴏ ɴ ᴇ ʟ ʏ')

@section('content')
<div class="vh-100 overflow-auto main">
    <div class="row">
        @foreach ($coins as $key => $coin)
            <div class="col-3">
                <div class="shadow my-2 p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex">
                            <img src="{{ $coin['image'] }}" alt="">
                            <p class="m-0">{{ $coin['name'] }}</p>
                        </div>
                        <p>{{ $coin['current_price'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
@section('script')
    
@endsection
