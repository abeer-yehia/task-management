<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="container">
                <div class="card">
                    <div class="card-header border-blue text-primary">
                        Project Details

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Code</th>
                                <td>{{$project->code}}</td>

                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{$project->name}}</td>

                            </tr>
                            <tr>
                                <th>Created By</th>
                                <td>{{$project->createdBy->name}}</td>

                            </tr>
                            {{-- <tr>
                                <th>Created At</th>
                                <td>{{$project->created_at}}</td>

                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{$project->updated_at}}</td>

                            </tr> --}}
                        </table>

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Name</th>
                                    <th>Due Date</th>
                                    {{-- <th>Created At</th> --}}
                                    {{-- <th>Updated At</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $project->tasks as $task )
                                <tr>
                                    <td>{{$task->priority}}</td>
                                    <td>{{$task->status}}</td>
                                    <td>{{$task->title}}</td>
                                    <td>{{$task->due_date}}</td>
                                    {{-- <td>{{$task->created_at}}</td> --}}
                                    {{-- <td>{{$task->updated_at}}</td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
