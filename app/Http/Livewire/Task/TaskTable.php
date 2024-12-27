<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header,PowerGrid, PowerGridComponent, PowerGridEloquent,PowerGridFields};
use App\Enums\Priority;

final class TaskTable extends PowerGridComponent
{
    use ActionButton;

    public bool $multiSort = true;

    // public string $sortField = 'tasks.due_date';
    public string $sortField = 'priority';

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Task>
     */
    public function datasource(): Builder
    {
        Task::where('due_date', '<', Carbon::now())
        ->where('status', '!=', 'Completed')
        ->update(['status' => 'Overdue']);
        $query = Task::query()->with(['project', 'createdBy']);

        $query->when($this->sortField, function ($query) {
            if ($this->sortField === 'priority') {
                $sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
                $query->orderByRaw("FIELD(priority, 'Low', 'Medium', 'High') " . $sortDirection);
            }
            if ($this->sortField === 'due_date') {
                $sortDirection = $this->sortDirection === 'asc' ? 'asc' : 'desc';
                $query->orderBy('due_date', $sortDirection);
            }
        });

        $query->orderBy('updated_at', 'desc');
    
        return  $query ;
        
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            'project',
            'createdBy'
        ];
    }
    // public function fields(): PowerGridFields
    // {
    //     return PowerGrid::fields()
    //         ->add('id')
    //         ->add('dish_name', fn ($dish) => $dish->name)
    //         ->add('diet', fn ($dish) => \App\Enums\Status::from($dish->diet)->labels());
    // }
    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('created_by', function (Task $model) {
                return strtolower(e($model->createdBy->name));
            })
            ->addColumn('project_id', function (Task $model) {
                return strtolower(e($model->project->name));
            })
            ->addColumn('priority_label', function (Task $model) {
                $priority = $model->priority->value;  // Get the string value of the enum
                return $priority;
            })
            ->addColumn('status_label', function (Task $model) {
                $status = $model->status->value;  // Get the string value of the enum
                $class = $status === 'Overdue' ? ' text-danger' : ''; 
                $icon = $status === 'Overdue' ? '<i class="fas fa-exclamation-triangle"></i>' : ''; 
                $strikethrough = $status === 'Completed' ? 'text-success text-decoration-line-through' : '';
                return "<span class='{$class}{$strikethrough}'>{$icon} {$status}</span>";
            })
            ->addColumn('name')
            ->addColumn('due_date', fn (Task $model) => Carbon::parse($model->due_date)->format('d/m/Y'))
            ;
    }

    

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [


            Column::make('CREATED BY', 'created_by'),

            Column::make('PROJECT', 'project_id'),

            Column::make('TITLE', 'title')
                ->searchable()
                ->makeInputText(),
            Column::make('PRIORITY', 'priority_label','priority')
            ->sortable()
            ->makeInputText(),

            Column::make('DUE DATE', 'due_date')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),
            Column::make('STATUS', 'status_label','status')
            ->makeInputText(
                ),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Task Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('btn btn-outline-primary btn-sm float-right mb-2')
                ->route('tasks.edit', ['task' => 'id'])
                ->target('_self'),

            Button::make('destroy', 'Delete')
            ->class('btn btn-outline-danger btn-sm float-right')
                ->route('tasks.destroy', ['task' => 'id'])
                ->method('delete')
                ->emit('task-destroy', ['task' => 'id'])
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Task Action Rules.
     *
     * @return array<int, RuleActions>
     */
    public function actionRules(): array
    {
        return [
            Rule::button('destroy')
            // ->when(fn($task) => $task->status !== 'Completed')
            ->when(fn($task) => true)
                ->setAttribute('onclick',  'deleteTaskWithConfirmation(event)')
        ];
    }
   

   
    
}
