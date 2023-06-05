@include('header')

{{-- {{ $projects }} --}}

<div class="row mb-5">

    <div class="col-4">
        <button type="button" name="" id="" class="btn btn-primary" class="btn btn-primary"
            data-bs-toggle="modal" data-bs-target="#create_project">Add Project</button>
        @isset($project)
            <a class="btn btn-danger" href="{{ route('delete_project', $project) }}" role="button">Delete This Project</a>
            <button type="button" name="" id="" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#create_task">Add Task</button>
        @endisset
    </div>

    <div class="col-4 align-self-center">
        <div class="form-group">
            <label for=""></label>
            <select class="form-control" name="project" id="project" onchange="change()">
                @if (!isset($project))
                    <option value="" selected disabled>Select</option>
                    @foreach ($projects as $data)
                        <option value="{{ $data['project_id'] }}">{{ $data['project_name'] }}</option>
                    @endforeach
                @else
                    <option value="" disabled>Select</option>
                    @foreach ($projects as $data)
                        @if ($data['project_id'] == $project)
                            <option value="{{ $data['project_id'] }}" selected>{{ $data['project_name'] }}</option>
                        @else
                            <option value="{{ $data['project_id'] }}">{{ $data['project_name'] }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-4">

        <div class="card mb-4">

            @isset($tasks)
                @php
                    $i = 1;
                @endphp
                <ul id="sortable-list" class="list-group list-group-flush">
                    @foreach ($tasks as $data)
                        <li data-id="{{ $data->task_id }}" class="list-group-item">
                            <div class="card-body" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right"
                                data-bs-html="true" title=""
                                data-bs-original-title="<span>Created at : {{ $data->created_at }}</span>">

                                <div class="row card-text">
                                    <div class="col">
                                        {{ $data->task_name }}
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-icon btn-outline-primary"
                                            id="{{ $data->task_id }}" onclick="edit(this.id)">
                                            <span class="tf-icons bx bx-edit"></span>
                                        </button>
                                    </div>
                                    <div class="col-2">
                                        <a type="button" href="{{ route('delete', $data->task_id) }}"
                                            class="btn btn-icon btn-outline-danger">
                                            <span class="tf-icons bx bx-trash"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        @php
                            $i++;
                        @endphp
                    @endforeach
                </ul>
            @endisset

        </div>
    </div>

</div>

<div class="modal fade" id="edit_task" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="{{ route('update') }}" method="post">
                        @csrf
                        <input type="hidden" name="task_id" id="task_id" value="">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Task</label>
                            <input type="text" name="task_name" id="task_name" class="form-control">
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="create_task" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Create Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="{{ route('create') }}" method="post">
                        @csrf
                        @isset($project)
                            <input type="hidden" name="project_id" value="{{ $project }}">
                        @endisset
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Task</label>
                            <input type="text" name="task_name" id="nameBasic" class="form-control">
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="create_project" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Create Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('create_project') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Project Name</label>
                            <input type="text" name="project_name" class="form-control" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>

@include('footer')
