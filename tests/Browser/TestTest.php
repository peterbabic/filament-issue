<?php

use App\Filament\Resources\TestResource\Pages\CreateTest;
use App\Models\Test;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Livewire\Livewire;

uses(DatabaseTruncation::class);

test('admin can create test', function () {

  $response = Livewire::test(CreateTest::class)
    ->assertFormExists()
    ->fillForm([
      'make' => 'Test',
    ])
    ->call('create')
    ->assertHasNoFormErrors(); // comment this to see more

  // dd($response->errors()); // also then uncomment this

  expect(Test::count())->toBe(1);

  $test = Test::first();
  expect($test)
    ->make->toBe('Test');
});
