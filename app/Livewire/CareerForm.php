<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Livewire\Concerns\GuardsPublicForm;
use App\Models\JobApplication;
use App\Models\JobOpening;
use Illuminate\Support\Collection;
use Livewire\Component;

class CareerForm extends Component
{
    use GuardsPublicForm;

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $cover_letter = '';

    public ?int $job_opening_id = null;

    public bool $sent = false;

    public function save(): void
    {
        if (! $this->allowed()) {
            return;
        }
        $this->validate([
            'name' => ['required', 'string', 'max:160'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'cover_letter' => ['required', 'string', 'max:4000'],
            'job_opening_id' => ['nullable', 'integer'],
        ]);

        JobApplication::query()->create([
            'job_opening_id' => $this->job_opening_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'cover_letter' => $this->cover_letter,
            'status' => 'received',
        ]);
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.career-form', [
            'openings' => $this->openings(),
        ]);
    }

    /** @return Collection<int, JobOpening> */
    private function openings(): Collection
    {
        if (! \Illuminate\Support\Facades\Schema::hasTable('job_openings')) {
            return collect();
        }

        return JobOpening::query()->where('is_published', true)->orderBy('title')->get();
    }
}
