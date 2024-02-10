<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
class Update extends Component
{
    use WithFileUploads;
    public $name;
    public $username;
    public $email;
    public $password;
    public $mobile;
    public $image;
    public $display_image;

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->username = $user->username;
        $this->mobile = $user->mobile;
        $this->email = $user->email;
        $this->display_image = auth()->user()->image;

    }
    public function update()
    {
        $rules = [
            'name' => ['required', 'string', 'max:25'],
            'username' => ['string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id],
            'mobile' => ['regex:/^[0-9]{7,20}$/'],
            'password' => ['required', Rules\Password::defaults()],
        ];

        if ($this->image) {
            $rules['image'] = ['image', 'max:2048', 'mimes:png,jpg,jpeg'];
        }

        $this->validate($rules);
        if ($this->image) {

            $imageName = "Image_" . Str::random(10) . '.' . $this->image->getClientOriginalExtension();


            $this->image->storeAs('admin/images', $imageName);
            $this->display_image = $imageName;
            if (auth()->user()->image)
               if (File::exists(public_path('storage/admin/images/'.auth()->user()->image)))
                   File::delete(public_path('storage/admin/images/'.auth()->user()->image));

            $this->image = $imageName;
        } else {

            $this->image = auth()->user()->image;
        }


        $id = auth()->user()->id;
        User::find($id)->update([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'image' => $this->image,
            'password' => Hash::make($this->password),
        ]);
        $this->reset('password');
        $this->dispatch('resetFile');
        session()->flash('success', 'Your informations has been updated successfully.');
    }

    public function placeholder()
    {
        return view('loading');
    }
    public function render()
    {
        return view('livewire.admin.update');
    }
}
