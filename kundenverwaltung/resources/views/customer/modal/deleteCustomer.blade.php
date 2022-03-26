<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Kunde löschen
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('deleteCustomer') }}">
                @csrf
                <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                <div class="modal-body">
                    <div class="p-5 text-center bg-danger text-white">
                        <p>Eintrag {{ $customer->forename }} wirklich löschen</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <x-button>Eintrag löschen</x-button>
                </div>
            </form>
        </div>
    </div>
</div>
