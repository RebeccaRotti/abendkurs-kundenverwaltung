<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          Projekt editieren
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ url('/project', ['id' => $project->id]) }}">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <div class="my-4">
                <x-label for="editTitle" :value="__('Titel')" />
                <x-input id="editTitle" name="editTitle" type="text" required value="{{ $project->title }}" />
            </div>
            <div class="form-floating my-4">
                <textarea id="editDescription" name="editDescription" class="form-control" placeholder="Beschreibung" required>{{ $project->description }}</textarea>
                <label for="editDescription">Beschreibung</label>
            </div>
            <div class="my-4">
                <x-label for="editRelease" :value="__('Release')" />
                <x-input id="editRelease" name="editRelease" type="date" value="{{ $project->release }}" />
            </div>
            <div class="form-floating my-4">
                <select class="form-select" required name="editState" id="editState">
                    @foreach($states as $state)
                        <option value="{{ $state->id }}" @if($state->id == $project->state_id) selected @endif>{{ $state->state }}</option>
                    @endforeach
                </select>
                <label for="editState">Status</label>
            </div>
            <div class="form-floating my-4">
                <select class="form-select" required name="editCompany" id="editCompany">
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" @if($company->id == $project->company_id) selected @endif>{{ $company->companyname }}</option>
                    @endforeach
                </select>
                <label for="editCompany">Firma</label>
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
