@extends('layouts.app')

@section('content')
<style>
    /* Custom styles for the card input field */
    .card-input {
        background-color: #f7f7f7;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 20px;
    }

    .card-input label {
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
    }

    .card-input #card-errors {
        color: #ff0000;
        margin-top: 10px;
    }

    .btn-pay {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-pay:hover {
        background-color: #0056b3;
    }
</style>
<div class="container-fluid py-5 mt-5">
            <div class="container py-5">
                <div class="row g-4 mb-5">
                    <div class="col-lg-8 col-xl-12">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="border rounded">
                                    <a href="#">
                                        <img src="{{ asset('img/fruite-item-5.jpg') }}" class="img-fluid rounded" alt="Image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h2>{{ $product->name }}</h2>
                                <p class="lead">{{ $product->description }}</p>
                                <p><strong>Price:</strong> Rs. {{ $product->price }}</p>
                                <form id="payment-form" action="{{ route('stripePayment') }}" method="post" >
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="card-element">Credit or Debit Card</label><br/><br/>
                                        <div id="card-element" class="form-control">
                                        </div>
                                        <div id="card-errors" role="alert"></div>
                                    </div>
                                    <input type="text" name="price" id="price" style="display: none;" value="{{$product->price}}">
                                    <br/>
                                    <button type="submit" class="btn btn-primary btn-block">Pay Now</button>
                                </form>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <h1 class="fw-bold mb-0">Related products</h1>
                <div class="vesitable">
                    <div class="owl-carousel vegetable-carousel justify-content-center">
                    @foreach ($related_prod as $product_data)

                        <div class="border border-primary rounded position-relative vesitable-item">
                            <!-- <div class="vesitable-img">
                                <img src="img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top" alt="">
                            </div> -->
                            <!-- <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div> -->
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4>{{$product_data->name}}</h4>
                                <p>{{$product_data->description}}</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">Rs. {{$product_data->price}} / kg</p>
                                    <a href="{{ route('product_details', ['name' => $product_data->name]) }}" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Buy Now</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe("{{ config('services.stripe.key') }}");
    var elements = stripe.elements();

    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    var card = elements.create('card', { style: style });
    card.mount('#card-element');

    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        form.submit();
    }
</script>

@endsection
