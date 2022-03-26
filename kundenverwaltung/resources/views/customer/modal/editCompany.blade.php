<div class="modal fade" id="editModal"
     tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Company ändern
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('editCompany') }}">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="companyID" value="{{ $company->id }}">
                    <div class="row mb-3">
                        <label for="inputCompanyname" class="col-form-label col-sm-12 col-md-4">Companyname</label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" id="inputCompanyname" name="inputCompanyname" class="form-control" required value="{{ $company->companyname }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputAddress" class="col-form-label col-sm-12 col-md-4">Adresse</label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" id="inputAddress" name="inputAddress" class="form-control" value="{{ $company->address }}">
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="inputNote" id="inputNote">{{ $company->note }}</textarea>
                        <label for="inputNote">Notiz</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <x-button>Änderung speichern</x-button>
                </div>
            </form>
        </div>
    </div>
</div>
