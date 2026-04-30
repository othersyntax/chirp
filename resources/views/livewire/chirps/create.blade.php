<?php

use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Volt\Component;

new class extends Component {
    #[Validate('required|string|max:255', message:['required'=>'Sila lengkapkan ruangan', 'max'=>'Jangan panjang sangat'])]
    public string $message='';

    #[Validate('image|max:2048', message:['image'=>'Sila pilih gambar', 'max'=>'Saiz hanya 2MB sahaja'])] // 2MB Max
    public $photo;

    use WithFileUploads;
 

    public function store(): void
    {
        $validated = $this->validate();
        $filepath = $this->photo->store('photos', 'public');

        $validated['path'] = $filepath;

        auth()->user()->chirps()->create($validated);
        $this->message = '';
        
        $this->dispatch('chirp-created'); 
    }
}; ?>

<div>
    <form wire:submit="store">
        <input type="file" 
            wire:model="photo"
            class="mt-4">
        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
        <textarea
            wire:model="message"
            placeholder="{{ __('What\'s on your mind?') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        ></textarea>  
        <x-input-error :messages="$errors->get('message')" class="mt-2" />        
        <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
    </form>
</div>
