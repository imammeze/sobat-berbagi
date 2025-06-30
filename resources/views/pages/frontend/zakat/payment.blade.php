@php
    $categoryZakat = request()->segment(1);
    $category = '';

    if ($categoryZakat == 'zakat-maal') {
        $category = "Zakat Maal";
    } else {
        $category = "Zakat Fitrah";
    }
@endphp

<x-layouts.frontend title="{{$category }}">
    <div class="container mt-5 vh-100">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="text-center">
                            Pembayaran {{ $category }}
                        </h3>
                        <hr>
                        <p class="text-center">
                            Anda akan membayar zakat sebesar
                        </p>
                        <h4 class="text-center">
                            Rp. {{ number_format($zakat->amount) }}
                        </h4>
                        <p class="text-center text-muted">
                            *kode unik akan diikutsertakan dalam donasi anda
                        </p>
                        <p class="text-center mb-3">
                            Silahkan lakukan transfer ke rekening berikut sesuai dengan nominal yang tertera
                        </p>
                        <div class="card mb-3 payment-method-card">
                            <div class="card-body d-flex gap-3 align-items-center">
                                <img src="{{ $paymentMethod->logo }}" alt="{{ $paymentMethod->name }}" width="100"
                                    class="rounded-2">
                                <div class="information">
                                    <h4 class="card-title mb-0">
                                        {{ $paymentMethod->name }}
                                    </h4>
                                    <p class="card-text">
                                        {{ $paymentMethod->number }} an {{ $paymentMethod->owner }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Doa Zakat {{ $category }}
                                </h5>
                                <p class="card-text">
                                   @if ($categoryZakat == 'zakat-maal')
                                   Nawaitu an ukhrija zakatadz dzahabi/zakatal fidhdhati/zakatal mali'an nafsi fardan lillahi ta'ala
                                    @else
                                    Nawaitu an ukhrija zakaatal fithri 'an nafsii fardhan lillaahi ta'aalaa.
                                    @endif
                                </p>
                            </div>
                        </div>
                        <form action="{{ route($categoryZakat . '.payment.store', $zakat->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="payment_method_id" value="{{ $paymentMethod->id }}">
                            <x-input.file label="Bukti Pembayaran" name="proof" />
                            <button type="submit" class="btn btn-primary btn-block w-100">Bayar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.frontend>
