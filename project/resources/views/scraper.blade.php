<x-layout>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-5 wrapper">
            @foreach($data as $key => $value)
                <div class="card text-center mt-4">
                    <h5 class="card-header">{{ $key }}</h5>
                    <div class="card-body">
                        <p class="card-text">{{ $value }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</body>
</x-layout>