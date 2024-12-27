<div class="photo-scroller-container">
    <div class="photo-scroller">
        @foreach ($products as $product)
            <div class="photo-card">
                <img src="{{ $product['foto'] }}" alt="{{ $product['nombre'] }}" />
                <p>{{ $product['nombre'] }}</p>
            </div>
        @endforeach
    </div>
</div>

<style>
    .photo-scroller-container {
        overflow: hidden;
        width: 100%;
        height: 250px;
        position: relative;
    }

    .photo-scroller {
        display: flex;
        gap: 10px;
        animation: scroll 10s linear infinite;
    }

    .photo-card {
        flex: 0 0 auto;
        width: 200px;
        height: 250px;
        text-align: center;
        border-radius: 10px;
        overflow: hidden;
        background: #f9f9f9;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .photo-card img {
        width: 100%;
        height: 70%;
        object-fit: cover;
    }

    .photo-card p {
        margin: 0;
        padding: 5px;
        font-size: 16px;
        color: #333;
    }

    @keyframes scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-100%);
        }
    }
</style>
