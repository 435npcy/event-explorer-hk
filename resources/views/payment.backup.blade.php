<x-app-layout>
  <div class="container mx-auto my-8">
    <div class="mb-6 ml-8 xs:ml-0 sm:ml-24 md:ml-0">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Payment Info</h2>
    </div>
    <div class="mt-8 max-w-md">
            <div class="grid grid-cols-1 gap-6">
              <label class="block">
                <span class="text-gray-700">Full name</span>
                <input type="text" class="
                    mt-1
                    block
                    w-full
                    rounded-md
                    border-gray-300
                    shadow-sm
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                  " placeholder="">
              </label>
              <label class="block">
                <span class="text-gray-700">Email address</span>
                <input type="email" class="
                    mt-1
                    block
                    w-full
                    rounded-md
                    border-gray-300
                    shadow-sm
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                  " placeholder="john@example.com">
              </label>
              <label class="block">
                <span class="text-gray-700">When is your event?</span>
                <input type="date" class="
                    mt-1
                    block
                    w-full
                    rounded-md
                    border-gray-300
                    shadow-sm
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                  ">
              </label>
              <label class="block">
                <span class="text-gray-700">What type of event is it?</span>
                <select class="
                    block
                    w-full
                    mt-1
                    rounded-md
                    border-gray-300
                    shadow-sm
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                  ">
                  <option>Corporate event</option>
                  <option>Wedding</option>
                  <option>Birthday</option>
                  <option>Other</option>
                </select>
              </label>
              <label class="block">
                <span class="text-gray-700">Additional details</span>
                <textarea class="
                    mt-1
                    block
                    w-full
                    rounded-md
                    border-gray-300
                    shadow-sm
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                  " rows="3"></textarea>
              </label>
              <div class="block">
                <div class="mt-2">
                  <div>
                    <label class="inline-flex items-center">
                      <input type="checkbox" class="
                          rounded
                          border-gray-300
                          text-indigo-600
                          shadow-sm
                          focus:border-indigo-300
                          focus:ring
                          focus:ring-offset-0
                          focus:ring-indigo-200
                          focus:ring-opacity-50
                        " checked="">
                      <span class="ml-2">Email me news and special offers</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
    </div>
  </div>
    <div class="flex max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">
      <form action="{{route('payment.process', [$order->id])}}" method="POST" id="subscribe-form">
        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="subscription-option">
                <label for="plan-silver">
                  <span class="plan-price">Total amount:</span>
                </label>
                <label for="plan-silver">
                  <span class="plan-price">${{ $order->total_amount }}</span>
                </label>
              </div>
            </div>
          </div>
        </div>
        <label for="card-holder-name">Card Holder Name</label>
        <input id="card-holder-name" type="text" value="{{$user->name}}" disabled>
        @csrf
        <div class="form-row">
          <label for="card-element">Credit or debit card</label>
          <div id="card-element" class="form-control"> </div>
          <!-- Used to display form errors. -->
          <div id="card-errors" role="alert"></div>
        </div>
        <div class="stripe-errors"></div>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
          {{ $error }}<br>
          @endforeach
        </div>
        @endif
        <div class="form-group text-center">
          <button type="button" id="card-button" data-secret="{{ $intent->client_secret }}"
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">SUBMIT</button>
        </div>
      </form>
      <script src="https://js.stripe.com/v3/"></script>
      <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
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
        var card = elements.create('card', { hidePostalCode: true, style: style });
        card.mount('#card-element');
        console.log(document.getElementById('card-element'));
        card.addEventListener('change', function (event) {
          var displayError = document.getElementById('card-errors');
          if (event.error) {
            displayError.textContent = event.error.message;
          } else {
            displayError.textContent = '';
          }
        });
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret; cardButton.addEventListener('click', async (e) => {
          console.log("attempting");
          const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
            payment_method: {
              card: card,
              billing_details: { name: cardHolderName.value }
            }
          }
          ); if (error) {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
          }
          else {
            paymentMethodHandler(setupIntent.payment_method);
          }
        });
        function paymentMethodHandler(payment_method) {
          var form = document.getElementById('subscribe-form');
          var hiddenInput = document.createElement('input');
          hiddenInput.setAttribute('type', 'hidden');
          hiddenInput.setAttribute('name', 'payment_method');
          hiddenInput.setAttribute('value', payment_method);
          form.appendChild(hiddenInput);
          form.submit();
        }
      </script>
      </div>
</x-app-layout>