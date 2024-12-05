<div class="info-cliente">
    <div class="info-cliente__photo">
        <img src="{{ $photo }}" alt="Foto de {{ $name }} {{ $lastName }}"
            style="width: 100px; height: 100px; border-radius: 50%;">
    </div>
    <div class="info-cliente__name">
        <h2>{{ $name }} {{ $lastName }}</h2>
    </div>
</div>
@if (session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div style="color: red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif


<style>
    .info-cliente {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 20px 0;
    }

    .info-cliente__photo img {
        border: 2px solid #ccc;
    }

    .info-cliente__name h2 {
        margin: 0;
        font-size: 1.5em;
    }
</style>
