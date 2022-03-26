<x-app-layout>
  <x-slot name="header">
    <h2>
      {{ __('Kundenverwaltung') }}
    </h2>
  </x-slot>
  <div class="py-3 my-4">
    {{-- next Time: add Company & Customer --}}

    <div class="pb-5 mb-5">
      <ul class="nav nav-tabs border-0" role="tablist">

        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="company-tab" data-bs-toggle="tab" data-bs-target="#addCompanyTab" type="button"
          role="tab" aria-selected="true">Add Company</button>
        </li>

        <li class="nav-item" role="presentation">
          <button class="nav-link" id="customer-tab" data-bs-toggle="tab" data-bs-target="#addCustomerTab" type="button"
          role="tab" aria-selected="false">Add Customer</button>
        </li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="addCompanyTab" role="tabpanel" aria-labelledby="company-tab">

          <form class="card p-4" method="POST" action="{{ route('addCompany') }}">
            @csrf
            <div class="row mb-3">
              <label for="inputCompanyname" class="col-form-label col-sm-12 col-md-4">Company Name</label>
              <div class="col-sm-12 col-md-8">
                <input type="text" id="inputCompanyname" name="inputCompanyname" class="form-control" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputAddress" class="col-form-label col-sm-12 col-md-4">Adresse</label>
              <div class="col-sm-12 col-md-8">
                <input type="text" id="inputAddress" name="inputAddress" class="form-control">
              </div>
            </div>

            <div class="form-floating">
              <textarea class="form-control" name="inputNote" placeholder="Notiz" id="floatingNote"></textarea>
              <label for="floatingNote">Note</label>
            </div>
            <div class="mt-3">
              <button type="submit" class="btn btn-dark d-block me-0 ms-auto">Speichern</button>
            </div>
          </form>

        </div>

        <div class="tab-pane" id="addCustomerTab" role="tabpanel" aria-labelledby="customer-tab">
          <form class="card p-4" method="POST" action="{{ route('addCustomer') }}">

            @csrf
            <div class="row mb-3">
              <label for="inputForename" class="col-form-label col-sm-12 col-md-4">Vorname</label>
              <div class="col-sm-12 col-md-8">
                <input type="text" id="inputForename" name="inputForename" class="form-control" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputLastname" class="col-form-label col-sm-12 col-md-4">Familienname</label>
              <div class="col-sm-12 col-md-8">
                <input type="text" id="inputLastname" name="inputLastname" class="form-control" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail" class="col-form-label col-sm-12 col-md-4">E-Mail Adresse</label>
              <div class="col-sm-12 col-md-8">
                <input type="text" id="inputEmail" name="inputEmail" class="form-control" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputFunction" class="col-form-label col-sm-12 col-md-4">Funktion</label>
              <div class="col-sm-12 col-md-8">
                <input type="text" id="inputFunction" name="inputFunction" class="form-control">
              </div>
            </div>
            <div class="form-floating mb-3">
              <textarea id="inputCustomerNote" name="inputCustomerNote" class="form-control" placeholder="Notiz"></textarea>
              <label for="inputCustomerNote">Notiz</label>
            </div>
            <div class="form-floating mb-3">
              <select class="form-select" required name="inputCompany" id="inputCompany">
                @foreach($companies as $company)
                  <option value="{{ $company->id }}">{{ $company->companyname }}</option>
                @endforeach
              </select>
              <label for="inputCompany">Firma</label>
            </div>

            <div class="mt-3">
              <button type="submit" class="btn btn-dark d-block me-0 ms-auto">Speichern</button>
            </div>
          </form>
        </div>
      </div>
    </div>



    <div class="row row-cols-1 row-cols-md-3 g-4">
      @foreach($companies as $company)
        <div class="col">
          <div class="card">

            <div class="d-flex justify-content-between bg-secondary text-white p-3">
                <h3>{{ $company->companyname }}</h3>
                <x-buttonEdit onclick="editCompany({{ $company->id }})"></x-buttonEdit>
            </div>

            <div class="card-body">
              <p class="card-text">
                {{ $company->address }}<br>
                {{ $company->note }}
              </p>

              @foreach($company->customers as $customer)
                <div class="card-text">
                  <div class="d-flex justify-content-between bg-dark text-white d-block p-1">
                    <span>
                      {{ $customer->forename }} {{ $customer->lastname }}
                    </span>
                    <x-buttonEdit onclick="editCustomer({{$customer->id}})"></x-buttonEdit>
                  </div>
                  <p>
                      {{ $customer->email }}<br>
                      {{ $customer->function }}<br>
                      {!! $customer->note ?? '<small>empty</small>' !!}<br>
                      <small>{{ $customer->created_at }} / {{ $customer->updated_at }}</small>
                  </p>
                    <x-buttonDelete onclick="deleteCustomer({{ $customer->id }})"></x-buttonDelete>
                </div>
              @endforeach

            </div>
            <div class="card-footer d-flex justify-content-between small">
              <p class="m-0">{{ $company->created_at ?? 'no date' }} / {{ $company->updated_at }}</p>
                @if(!($company->customers()->exists()) && !($company->projects()->exists()))
                    <x-buttonDelete onclick="deleteCompany({{ $company->id }})"></x-buttonDelete>
                @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <script>

      function deleteCustomer(customer_id) {
          $.ajax({
              method: 'POST',
              url: '{{ route('modalDeleteCustomer') }}',
              data: {
                  '_token': '{{ csrf_token() }}',
                  customer_id: customer_id
              },
              success: function(data) {
                  $('#modalContainer').html(data);
                  $('#deleteModal').modal('show');
              },
              error: function(data) {
                  console.log(data);
              }
          });
      }
      function deleteCompany(company_id) {
          $.ajax({
              method: 'POST',
              url: '{{ route('modalDeleteCompany') }}',
              data: {
                  '_token': '{{ csrf_token() }}',
                  company_id: company_id
              },
              success: function(data) {
                  $('#modalContainer').html(data);
                  $('#deleteModal').modal('show');
              },
              error: function(data) {
                  console.log(data);
              }
          });
      }

      function editCompany(company_id) {
          $.ajax({
              method: 'POST',
              url: '{{ route('modalEditCompany') }}',
              data: {
                  '_token': '{{ csrf_token() }}',
                  company_id: company_id
              },
              success: function(data) {
                  $('#modalContainer').html(data);
                  $('#editModal').modal('show');
              },
              error: function(data) {
                  console.log(data);
              }
          });
      }

    function editCustomer(customer_id) {

      $.ajax({
        method: 'POST',
        url: '{{ route('modalEditCustomer') }}',
        data: {
          "_token": "{{ csrf_token() }}",
          customer_id: customer_id
        },
        success: function(data) {
          $('#modalContainer').html(data);
          $('#editModal').modal('show');
        },
        error: function(data) {
          console.log(data);
        }
      });
    }
  </script>


</x-app-layout>
