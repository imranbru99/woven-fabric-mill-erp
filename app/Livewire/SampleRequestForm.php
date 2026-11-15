<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Livewire\Concerns\GuardsPublicForm;
use App\Models\Inquiry;
use App\Models\Lead;
use App\Models\SampleRequest;
use App\Services\NumberSeriesService;
use Livewire\Component;

class SampleRequestForm extends Component
{
    use GuardsPublicForm;

    public string $company_name = '';

    public string $contact_name = '';

    public string $email = '';

    public string $phone = '';

    public string $requirement = '';

    public bool $sent = false;

    public function save(NumberSeriesService $numbers): void
    {
        if (! $this->allowed()) {
            return;
        }
        $this->validate([
            'company_name' => ['required', 'string', 'max:160'],
            'contact_name' => ['nullable', 'string', 'max:160'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'requirement' => ['required', 'string', 'max:2000'],
        ]);

        $lead = Lead::query()->create([
            'number' => $numbers->next(Lead::class),
            'status' => 'new',
            'company_name' => $this->company_name,
            'contact_name' => $this->contact_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'source' => 'website',
        ]);
        $inquiry = Inquiry::query()->create([
            'number' => $numbers->next(Inquiry::class),
            'status' => 'open',
            'lead_id' => $lead->id,
            'subject' => 'Sample request',
            'requirement' => $this->requirement,
        ]);
        SampleRequest::query()->create([
            'number' => $numbers->next(SampleRequest::class),
            'status' => 'requested',
            'inquiry_id' => $inquiry->id,
            'sample_type' => 'handloom',
            'quantity_m' => 2,
        ]);
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.sample-request-form');
    }
}
