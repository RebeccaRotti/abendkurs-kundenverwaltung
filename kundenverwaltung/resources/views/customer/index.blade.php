<x-app-layout>
  <x-slot name="header">
    <h2>
      {{ __('Kundenverwaltung') }}
    </h2>
  </x-slot>
  <div class="py-3 my-4">
    {{-- next Time: add Company & Customer --}}
    <div class="row row-cols-1 row-cols-md-3 g-4">
      @foreach($companies as $company)
        <div class="col">
          <div class="card">
            <h3 class="bg-secondary text-white p-3">{{ $company->companyname }}</h3>
            <div class="card-body">
              <p class="card-text">
                {{ $company->address }}<br>
                {{ $company->note }}
              </p>
              @foreach($company->customers as $customer)
                <p class="card-text">
                  {{ $customer->forename }} {{ $customer->lastname }}<br>
                  {{ $customer->email }}<br>
                  {{ $customer->function }}<br>
                  {!! $customer->note ?? '<small>empty</small>' !!}<br>
                  <small>{{ $customer->created_at }} / {{ $customer->updated_at }}</small>
                </p>
              @endforeach
            </div>
            <div class="card-footer small">
              <p class="m-0">{{ $company->created_at ?? 'no date' }} / {{ $company->updated_at }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</x-app-layout>