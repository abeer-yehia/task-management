<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="container">
                <div class="card">
                    <div class="card-header border-blue text-primary">
                        Add A New Task

                    </div>
                    <div class="card-body">
                        <form action="{{ route('tasks.store') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="project_name" class="form-label">Project Name</label>
                                <select name="project_name" id="project_name" class="form-control {{ $errors->has('project_name') ? 'is-invalid' : '' }}">
                                    <option value="">Select a project</option>
                                    @foreach ($projects as $project)
                                    <option value="{{$project->id}}" {{ old('project_name')==$project->id ? 'selected' : '' }}>{{$project->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('project_name'))
                                <div class="invalid-feedback">{{$errors->first('project_name')}}</div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="task_name" class="form-label">Task Title</label>
                                <input type="text" name="task_name" class="form-control {{ $errors->has('task_name') ? 'is-invalid' : '' }}" id="task_name" placeholder="Task name" value="{{ old('task_name') }}" />
                                @if($errors->has('task_name'))
                                <div class="invalid-feedback">{{$errors->first('task_name')}}</div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" rows="4" placeholder="Enter task description">{{ old('description') }}</textarea>
                                @if($errors->has('description'))
                                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="priority" class="form-label">Priority</label>
                                <select name="priority" id="priority" class="form-control {{ $errors->has('priority') ? 'is-invalid' : '' }}">
                                    <option value="">Select a priority</option>
                                    @foreach (\App\Enums\Priority::cases() as $priority)
                                        <option value="{{ $priority->value }}" 
                                            {{ old('priority') === $priority->value ? 'selected' : '' }}>
                                            {{ $priority->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('priority'))
                                    <div class="invalid-feedback">{{ $errors->first('priority') }}</div>
                                @endif
                            </div>
                           
                            <div class="mb-3">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" name="due_date" class="form-control {{ $errors->has('due_date') ? 'is-invalid' : '' }}" id="due_date" placeholder="Due Date" value="{{ old('due_date') }}" />
                                @if($errors->has('due_date'))
                                <div class="invalid-feedback">{{$errors->first('due_date')}}</div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-sm float-right">Save</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
