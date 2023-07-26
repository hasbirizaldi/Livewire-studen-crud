<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class StoreStudent extends Component
{
    public $name, $email,$image, $s_id, $update = false, $imageUp;

    use WithFileUploads;

    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'image' => 'required',
    ];
    public function resetData(){

        $this->reset(['name', 'email']);
    }
    public function saveData(){

        $this->validate();
        
        $student = new Student();

        $student->name = $this->name;
        $student->email = $this->email;

        $imageName = $this->image->store('photos', 'public');
        $student->image = $imageName;
        $student->save();
        $this->resetData();
        $this->mount();

        session()->flash('message', 'Data Successfully Added');
    }

    public function mount(){

        $this->student = Student::latest()->get();
    }

    public function deleteStudent($id){
        $student = Student::find($id);

        $gambar = Student::where('id',$id);
        // unlink($gambar);
        $student->delete();
        $this->mount();
        session()->flash('message', 'Data Successfully Deleted');
    }

    public function editStudent($id){
        
        $student = Student::find($id);
        $this->s_id = $student->id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->image = $student->image;

        $this->update = true;
    }

    public function updateData(){

        $this->validate();

        $data = Student::find($this->s_id);
        $data->name = $this->name;
        $data->email = $this->email;

        if($this->imageUp){

            $imageName = $this->imageUp->store('photos', 'public');
            $data->image = $imageName;
        }

        $data->save();
        $this->imageUp = '';
        $this->mount();
        session()->flash('message', 'Data Successfully Deleted');

        $this->update = false;

    }

    public function render()
    {
        $this->student;
        return view('livewire.store-student', [
            'students'=>  $this->student
        ]);
    }
}