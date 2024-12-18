<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasirku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    #jumbotron {
        background: linear-gradient(to right, #4a90e2, #50c9c3);
        color: white;
        padding: 80px 0;
        margin-top: 50px;
        margin-bottom: 50px;
        height: 450px;
    }

    .navbar {
        background: linear-gradient(to right, #4a90e2, #50c9c3);
        color: white;
    }

    footer {
        background: linear-gradient(to right, #4a90e2, #50c9c3);
        color: white;
    }

    /* styles.css */
    #backToTop {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        font-size: 16px;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: opacity 0.3s;
    }
</style>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Kasirku</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Harga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Faq</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kritik-saran">Kritik Dan Saran</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('register') }}">Register</a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('dashboard') }}">Dashboard</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="jumbotron" class="bg-light text-center">
        <div class="container">
            <h1 class="display-4">Welcome to Kasirku</h1>
            <p class="lead">Your trusted solution for your business</p>
            <a href="#features" class="btn btn-primary btn-lg">Learn More</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <h2 class="text-center">Fitur</h2>
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="text-capitalize">Apa itu Kasirku</h4>
                    <p class="text-justify">Kasirku adalah aplikasi atau sistem berbasis teknologi yang dirancang untuk
                        membantu pelaku usaha, terutama UMKM (Usaha Mikro, Kecil, dan Menengah), dalam mengelola
                        transaksi penjualan secara efisien. Aplikasi ini berfungsi sebagai point of sale (POS) yang
                        menggantikan metode manual seperti pencatatan transaksi di buku kas atau kalkulator. Dengan
                        Kasirku, proses bisnis dapat menjadi lebih modern, cepat, dan akurat.</p>
                </div>
                <div class="col-lg-4">
                    <h4>Fitur Aplikasi Kasirku</h4>
                    <ul class="list-group">
                        <li class="list-group-item">Pengelolaan Laporan Yang lebih terstrukur</li>
                        <li class="list-group-item">Manajemen stok barang dan inventaris</li>
                        <li class="list-group-item">Analisis bisnis dengan laporan penjualan otomatis</li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="bg-light py-5">
        <div class="container text-center">
            <h2 class="mb-4">Harga</h2>
            <div class="row">
                @foreach ($paketmembers as $paketmember)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $paketmember->durasi }}</h5>
                                <p class="card-text">{{ number_format($paketmember->harga, 3, '.', '') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- back to top --}}
    <button id="backToTop" class="btn btn-primary">&UpArrow;</button>
    {{-- back to top --}}

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">Faq</h2>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach ($faqs as $index => $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse{{ $index }}" aria-expanded="false"
                                aria-controls="flush-collapse{{ $index }}">
                                {{ $faq->pertanyaan }}
                            </button>
                        </h2>
                        <div id="flush-collapse{{ $index }}" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{ $faq->jawaban }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- kritik-saran Section -->
    <section id="kritik-saran" class="bg-light py-5">
        <div class="container">
            <h2 class="mb-4 text-center">Kritik Dan Saran</h2>
            <form action="{{ url('addsaran') }}" method="post">
                @if (session('status'))
                    <script>
                        alert("Terima Kasih Atas Kritik - Saranya")
                    </script>
                @endif

                @if ($errors->any())
                    <script>
                        alert("masih ada yang kosong", window.location.assign("/#kritik-saran"))
                    </script>
                @endif

                <!-- Create Post Form -->
                @csrf
                <div class="mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        name="nama">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Alamat Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Kritik/Saran</label>
                    <textarea class="form-control @error('kritik_saran') is-invalid @enderror" id="exampleFormControlTextarea1"
                        name="kritik_saran" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-light py-4 py-3 text-center">
        <div class="container">
            <p>&copy; Kasirku @php echo date("Y");@endphp All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    const backToTopButton = document.getElementById("backToTop");

    window.addEventListener("scroll", () => {
        if (window.scrollY > 300) {
            backToTopButton.style.display = "block";
        } else {
            backToTopButton.style.display = "none";
        }
    });

    backToTopButton.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
</script>

</html>
