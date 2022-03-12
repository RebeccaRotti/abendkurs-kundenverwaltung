<x-app-layout>
  <x-slot name="header">
    <h2>{{ __('Projektverwaltung') }}</h2>
  </x-slot>

  <div class="py-3">

    {{-- ToDo: Button für Modal um neues Projekt anzulegen --}}
    <!-- Button trigger modal -->
        <x-modalButton data-bs-target="#addProject" class="d-block mx-auto">
            <i class="fas fa-plus"></i>
        </x-modalButton>


    {{-- ToDo: Modal mit Form für neues Projekt --}}
    <!-- Modal -->
        <div class="modal fade" id="addProject" tabindex="-1" aria-labelledby="modalAddState" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddState">Status hinzufügen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('project.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="my-4">
                                <x-label for="addTitle" :value="__('Titel')" />
                                <x-input id="addTitle" name="addTitle" type="text" required />
                            </div>
                            <div class="form-floating my-4">
                                <textarea id="addDescription" name="addDescription" class="form-control" placeholder="Beschreibung" required></textarea>
                                <label for="addDescription">Beschreibung</label>
                            </div>
                            <div class="my-4">
                                <x-label for="addRelease" :value="__('Release')" />
                                <x-input id="addRelease" name="addRelease" type="date" />
                            </div>
                            <div class="form-floating my-4">
                                <select class="form-select" required name="addState" id="addState">
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->state }}</option>
                                    @endforeach
                                </select>
                                <label for="addState">Status</label>
                            </div>
                            <div class="form-floating my-4">
                                <select class="form-select" required name="addCompany" id="addCompany">
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->companyname }}</option>
                                    @endforeach
                                </select>
                                <label for="addCompany">Firma</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    {{-- ToDo: Ausgabe der Projekte (entweder Tabelle oder Cards) --}}
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
            @foreach($projects as $project)
                <div class="col">
                    <div class="card">
                        <div class="d-flex justify-content-between bg-secondary text-white p-3">
                            <h3 class="">{{ $project->title }}</h3>
                            <x-buttonEdit onclick="editProject({{ $project->id }})"></x-buttonEdit>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                {{ $project->description }}
                            </p>
                            <div class="card-text">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Firma</td>
                                            <td>{{ $project->company->companyname }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>{{ $project->state->state }}</td>
                                        </tr>
                                        <tr>
                                            <td>Release</td>
                                            <td>{{ $project->release }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-text">
                                <h5>Ansprechpersonen</h5>
                                @foreach($project->company->customers as $customer)
                                    <ul>
                                        <li>{{ $customer->forename }} {{ $customer->lastname }}</li>
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer small">
                            <p class="m-0">{{ $project->created_at ?? 'no date' }} / {{ $project->updated_at }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

  </div>
    <script>

        function editProject(id) {
            $.ajax({
                method: "GET",
                url: 'project/' + id,
                success: function (data) {
                    $('#modalContainer').html(data);
                    $('#editModal').modal('show');
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

    </script>
</x-app-layout>
