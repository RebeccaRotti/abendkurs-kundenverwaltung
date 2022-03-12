<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          Kunde editieren
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ route('editCustomer') }}">

        <div class="modal-body">
          @csrf
            <input type="hidden" name="customer_id" value="{{ $customer->id}}">
            <div class="row mb-3">
              <label for="inputForename" class="col-form-label col-sm-12 col-md-4">Vorname</label>
              <div class="col-sm-12 col-md-8">
                <input type="text" id="inputForename" name="editForename" class="form-control" required value="{{ $customer->forename }}">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputLastname" class="col-form-label col-sm-12 col-md-4">Familienname</label>
              <div class="col-sm-12 col-md-8">
                <input type="text" id="inputLastname" name="editLastname" class="form-control" required value="{{ $customer->lastname }}">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail" class="col-form-label col-sm-12 col-md-4">E-Mail Adresse</label>
              <div class="col-sm-12 col-md-8">
                <input type="text" id="inputEmail" name="editEmail" class="form-control" required value="{{ $customer->email }}">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputFunction" class="col-form-label col-sm-12 col-md-4">Funktion</label>
              <div class="col-sm-12 col-md-8">
                <input type="text" id="inputFunction" name="editFunction" class="form-control" value="{{ $customer->function }}">
              </div>
            </div>
            <div class="form-floating mb-3">
              <textarea id="inputCustomerNote" name="editCustomerNote" class="form-control" placeholder="Notiz">{{ $customer->note }}</textarea>
              <label for="inputCustomerNote">Notiz</label>
            </div>
            <div class="form-floating mb-3">
              <select class="form-select" required name="editCompany" id="inputCompany">
                @foreach($companies as $company)
                  <option value="{{ $company->id }}" @if($customer->company_id == $company->id) selected @endif >{{ $company->companyname }}</option>
                @endforeach
              </select>
              <label for="inputCompany">Firma</label>
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <x-button>Änderungen speichern</x-button>
        </div>
      </form>
    </div>
  </div>
</div>