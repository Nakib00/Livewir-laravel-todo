<?php

namespace App\Livewire;
use App\Models\newuser;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class User extends Component
{
    use WithFileUploads;

    // validation rule
    #[Rule('required|min:3|max:50')]
    public $fname;
    #[Rule('required|min:3|max:50')]
    public $lname;
    #[Rule('required|email')]
    public $email;
    #[Rule('required|image|mimes:jpeg,png,jpg,gif|max:2048')]
    public $image;

    public function create(){
         // Validate all fields
        $validatedData = $this->validate();

        // image path
        if($this->image){
            $filepath = $this->image->store('upload','public');
            $validatedData['image'] = $filepath;
        }

        // Save the data in the database
        Newuser::create($validatedData);

         // Clear the input field
        $this->reset(['fname', 'lname', 'email', 'image']);

        // Show alert message when data is saved
        session()->flash('success', 'User created successfully.');
    }

    public function render()
    {
        $users = Newuser::latest()->paginate(3);
        return view('livewire.user',compact('users'));
    }
}
