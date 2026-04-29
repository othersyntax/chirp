<?php

use App\Models\Chirp;
use Illuminate\Database\Eloquent\Collection; 
use Livewire\Volt\Component;

new class extends Component {
    public Collection $chirps; 

    public function mount(): void
    {
        $this->chirps = Chirp::with('user')->latest()
        ->get();
    } 
}; ?>

<div>
    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        @foreach ($chirps as $chirp)
            <div class="p-6 flex space-x-2" wire:key="{{ $chirp->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.0">
                </svg>
                <div class="flex-1">
                    <div class="flex justify-between items-center"><div>
                    <span class="text-gray-800">{{ $chirp->user->name }} :
                    <small class="ml-2 text-sm text-gray-600">{{ $chirp->created_at}}
                </div>
            </div>
            <p class="mt-4 text-lg text-gray-900">{{ $chirp->message }}
        @endforeach
    </div>
</div>
