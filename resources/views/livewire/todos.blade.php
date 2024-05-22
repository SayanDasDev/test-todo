<?php

use function Livewire\Volt\{state, with};

state(['title']);
state(['description']);

with([
	'todos' => fn() => auth()->user()->todos,
]);

$add = function () {

	auth()->user()->todos()->create([
		'title' => $this->title,
		'description' => $this->description,
	]);

  $this->title = "";
  $this->description = "";
};


$delete = fn(\App\Models\Todo $todo) => $todo->delete();


?>

<div>
  <form wire:submit='add'>
    <div class="flex flex-col gap-2">
      <x-text-input wire:model="title" placeholder="Add a title..." />
      <x-text-input wire:model="description" placeholder="Add a description (optional)" />
    </div>
    <x-primary-button class="mt-2" type='submit'>Add</x-primary-button>
  </form>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-4">
    @foreach($todos as $todo)
    <div class="flex">
      <div class="mb-2 flex-1">
        <h2 class="text-xl font-bold">{{ $todo->title }}</h2>
        <h4 class="text-opacity-80">{{ $todo->description }}</h4>
      </div>
      <x-secondary-button wire:click='delete({{ $todo->id }})' class="!text-2xl">X</x-secondary-button>
    </div>
    @endforeach
  </div>
</div>
