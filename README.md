## Laravel Filament bug report

From <https://github.com/filamentphp/filament/issues/15557>

## Prepare

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan dusk:chrome-driver
```

## Problem

If you run:

```bash
composer require "filament/filament=3.2.77" -W
php artisan dusk
```

The `fillForm()` does not work as I would expect - the test fails like this:

```
   FAIL  Tests\Browser\TestTest
  ⨯ admin can create test                                                                                                                                                             0.22s
  ─────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────
   FAILED  Tests\Browser\TestTest > admin can create test
  Component has errors: "data.make"
Failed asserting that false is true.

  at vendor/livewire/livewire/src/Features/SupportValidation/TestsValidation.php:109
    105▕     {
    106▕         $errors = $this->errors();
    107▕
    108▕         if (empty($keys)) {
  ➜ 109▕             PHPUnit::assertTrue($errors->isEmpty(), 'Component has errors: "'.implode('", "', $errors->keys()).'"');
    110▕
    111▕             return $this;
    112▕         }
    113▕

      +4 vendor frames
  5   tests/Browser/TestTest.php:18
```

By running pre-prepared `dd()` at [TestTest.php:20](./tests/Browser/TestTest.php)

```
Illuminate\Support\MessageBag^ {#3620
  #messages: array:1 [
    "data.make" => array:1 [
      0 => "The make field is required."
    ]
  ]
  #format: ":message"
} // tests/Browser/TestTest.php:20
```

To fix the problem:

```bash
composer require "filament/filament=3.2.76" -W
php artisan dusk
```

Now the test passes:

```
   PASS  Tests\Browser\TestTest
  ✓ admin can create test                                                                                                                                                             0.29s

  Tests:    1 passed (6 assertions)
  Duration: 0.33s
```
