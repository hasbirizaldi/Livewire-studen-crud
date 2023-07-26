<div>

    @if ($update==false)
    <h2 class="text-center fw-bold">Store Student Data</h2>
    <div class="row justify-content-center">
     <div class="col-md-6">
    <div class="container bg-light p-3 rounded shadow">
     
     <form wire:submit.prevent='saveData'>
 
                 <div class="form-group mb-3">
                     <label class="form-label">Name</label>
                     <input class="form-control form-control-sm" type="text" wire:model='name'>
                     @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                 </div>
                 <div class="form-group mb-3">
                     <label class="form-label">Email</label>
                     <input class="form-control form-control-sm" type="text" wire:model='email'>
                     @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                 </div>
                 <div class="form-group mb-3">
                     <label class="form-label">Image</label>
                     <input class="form-control form-control-sm" type="file" wire:model='image'>
                     @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                 </div>
                 <div class="form-group">
                     <button type="submit" class="btn btn-sm btn-primary">Save</button>
                 </div>
             </div>
         </div>
        </form>
    </div>
    <div class="container">
     <div class="mt-3">
         @if (session()->has('message'))
             <div class="alert alert-success">
                 {{ session('message') }}
             </div>
         @endif
     </div>
     <table class="table table-bordered table-striped table-hover mt-4">
         <thead>
             <tr>
                 <th>#</th>
                 <th>Action</th>
                 <th>Name</th>
                 <th>Email</th>
                 <th>Image</th>
             </tr>
         </thead>
         <tbody>
             @forelse ($students as $student)
             <tr>
                 <td>{{ $loop->iteration }}</td>
                 <td>
                     <a wire:click="deleteStudent({{ $student->id }})" class="btn btn-sm btn-danger">Del</a>
                     <a wire:click="editStudent({{ $student->id }})" class="btn btn-sm btn-success">Edit</a>
                 </td>
                 <td>{{ $student->name }}</td>
                 <td>{{ $student->email }}</td>
                 <td>
                     <img src="{{ Storage::url($student['image']) }}" width="200" height="100" alt="">
                 </td>
             </tr>
             @empty
             <tr>
                <td colspan="5">
                 <h5 class="text-danger text-center">No Data Available</h5>
                </td>
             </tr>
             @endforelse
         </tbody>
        </table>
    @else
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 bg-light">
                <h1>Update Student Data</h1>
                <form wire:submit.prevent="updateData">
                    <div class="form-group mb-3">
                        <label class="form-label">Name</label>
                        <input type="hidden" wire:model="s_id" >
                        <input class="form-control form-control-sm" type="text" wire:model='name'>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control form-control-sm" type="text" wire:model='email'>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Image</label>
                        <input class="form-control form-control-sm" type="file" wire:model='imageUp'>
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

   </div>
</div>
