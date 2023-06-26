<x-app-layout>
  <div class="container mx-auto my-8 flex">
    <div class="flex-1">
        <div class="mb-6 ml-8 xs:ml-0 sm:ml-24 md:ml-0">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Payment Info
            </h2>
        </div>
        <div class="mt-8 max-w-md">
            <form
                action="{{route('payment.process', [$order->id])}}"
                method="POST"
                id="subscribe-form"
            >
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <label class="block" for="card-holder-name">
                        <span class="text-gray-700">Card Holder Name</span>
                        <input
                            id="card-holder-name"
                            type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:bg-zinc-200"
                            value="{{$user->name}}"
                            disabled
                        />
                    </label>
                    <label class="block" for="card-element">
                        <span class="text-gray-700">Credit or debit card</span>
                        <div id="card-element" class="bg-white p-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></div>
                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </label>
                    <div class="stripe-errors"></div>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error) {{ $error }}<br />
                        @endforeach
                    </div>
                    @endif
                    <div class="text-center">
                        <!-- <button
                            type="button"
                            id="card-button"
                            data-secret="{{ $intent->client_secret }}"
                            class="mt-4 w-64 h-12 text-xl text-white bg-indigo-500 hover:bg-indigo-600 justify-center self-end"
                            type="submit"
                        > -->
                        <button
                            type="button"
                            id="card-button"
                            data-secret="{{ $intent->client_secret }}"
                            class="mt-4 w-64 h-12 text-xl text-white bg-indigo-500 hover:bg-indigo-600 justify-center self-end"
                            type="submit"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="flex-1 mx-8">
        <div class="grid grid-cols-1 border rounded-lg bg-gray-200 p-4">
            <div class="border-solid border-b-2 border-black mb-4">Ticket Type</div>
              @foreach ($order->items as $item)
                  <label class="flex items-center justify-between">
                      <span class="text-gray-700">{{ $item->ticketType->name }}</span>
                      <span class="text-gray-500">{{__('$')}}{{ $item->sub_price }}</span>
                      <span class="text-gray-500">{{__('x')}}{{ $item->quantity }}</span>
                      <span class="text-gray-700">
                        {{__('$')}}{{ number_format((float)($item->sub_price * $item->quantity), 2, '.', ''); }}
                      </span>
                  </label>
              @endforeach
            
            <div class="border-solid border-b-2 border-black my-2"></div>
            <label class="flex items-center justify-between">
              <span class="text-gray-700">Total amount:</span>
              <span class="text-gray-700">{{__('$')}}{{ $order->total_amount }}</span>
            </label>
        </div>
    </div>
  </div>
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
</x-app-layout>