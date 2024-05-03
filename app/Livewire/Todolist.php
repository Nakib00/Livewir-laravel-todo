<?php

namespace App\Livewire;

use App\Models\todo;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Todolist extends Component
{
    use WithPagination;

    // validation rule
    #[Rule('required|min:3|max:50')]
    public $name;

    public $search;
    public $Editingtodoid;
    #[Rule('required|min:3|max:50')]
    public $Editingnewname;

    public function create(){
         // Check the validation
        $validated = $this->validateOnly('name');

         // Save the data in the database
        Todo::create($validated);

         // Clear the input field
        $this->reset('name');

         // Show alert message when data is saved
        session()->flash('success', 'Todo created successfully.');

        // new todo created go to the first page
        $this->resetPage();
    }

    public function delete($todoid){
        try {
            Todo::findOrFail($todoid)->delete();
            session()->flash('success', 'Todo deleted successfully.');
        } catch (Exception $e) {
            session()->flash('error', 'Failed to delete todo!');
        }
    }

    public function toggle($todoid){
        $todo = Todo::find($todoid);
        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function edit($todoid){
        $this->Editingtodoid = $todoid;
        $this->Editingnewname = Todo::find($todoid)->name;
    }

    public function update(){
        $validatedData = $this->validate([
            'Editingnewname' => ['required', 'min:3', 'max:50'],
        ]);

        Todo::find($this->Editingtodoid)->update([
            'name' => $this->Editingnewname,
        ]);

        // edit complite close it
        $this->cancelEdit();
    }

    public function cancelEdit(){
        $this->reset('Editingtodoid','Editingnewname');
    }

    public function render()
    {
        // show todo data and search option
        $todolist = todo::latest()->where('name','like',"%{$this->search}%")->paginate(3);
        return view('livewire.todolist',compact('todolist'));
    }
}
