@extends('user/layout.template')

@section('content')

    <section class="title bg-pink-light">
        <div class="container py-5">
            <h2>Shop</h2>
            <div class="hv-garis-pink mt-3"></div>
        </div>
    </section>

    <section class="main-content mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h5 class="mb-2">Filter</h5>
                    <div class="hv-garis mb-4"></div>
                    <form action="{{ url('shop') }}"
                          class="w-75"
                          method="post">
                        <div class="mb-3">
                            <label for="orderby"
                                   class="form-control-label mb-2">Urutkan</label>
                            <select class="form-select"
                                    name="orderBy">
                                {{-- <option value="orderNewest" selected>Urutkan Dari Yang Terbaru</option> --}}
                                <option value="">-- Choose here --</option>
                                <option value="min">Urutkan Dari Harga Terendah</option>
                                <option value="max">Urutkan Dari Harga Tertinggi</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price"
                                   class="form-control-label mb-2">Kisaran Harga</label>
                            <input type="number"
                                   placeholder="Minimal"
                                   class="form-control mb-3"
                                   name="min">
                            <input type="number"
                                   placeholder="Maximal"
                                   class="form-control mb-3"
                                   name="max">
                        </div>
                        <button type="submit"
                                class="btn btn-dark">Submit</button>
                    </form>
                </div>
                <div class="col-md-8 mb-5">
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-3">
                                <div class="card border-0"
                                     style="height: 30rem;">
                                    <a href="{{ url('detail') . '/' . $product->product_id }}">
                                        <div class="img-cart"
                                             style="overflow: hidden;">
                                            <img src="{{ asset('img/produk') . '/' . $product->image }}"
                                                 alt="aa"
                                                 class="img-fluid">
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <a href="{{ url('detail') . '/' . $product->product_id }}">
                                            <h6 class="card-title text-center text-uppercase text-pink-dark">
                                                {{ $product->product_name }}</h6>
                                            <p class="card-text text-center text-muted">
                                                Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- pagination --}}
                        {{-- <section class="pagination my-5"> --}}
                        {{-- <nav aria-label="Pagination Shop"> --}}
                        {{-- <ul class="pagination"> --}}
                        {{-- <li class="page-item disabled"> --}}
                        {{-- <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a> --}}
                        {{-- </li> --}}
                        {{-- <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li> --}}
                        {{-- <li class="page-item"> --}}
                        {{-- <a class="page-link" href="#">2</a> --}}
                        {{-- </li> --}}
                        {{-- <li class="page-item"><a class="page-link" href="#">3</a></li> --}}
                        {{-- <li class="page-item"> --}}
                        {{-- <a class="page-link" href="#">Next</a> --}}
                        {{-- </li> --}}
                        {{-- </ul> --}}
                        {{-- </nav> --}}
                        {{-- </section> --}}


                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
