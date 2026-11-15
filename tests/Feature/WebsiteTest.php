<?php

use App\Livewire\CareerForm;
use App\Livewire\RfqForm;
use App\Livewire\SampleRequestForm;
use App\Models\Inquiry;
use App\Models\JobApplication;
use Livewire\Livewire;

it('publishes the mill site and files sample, price and job requests', function () {
    $this->get('/')->assertOk()->assertSee('Dhaka Woven Mills');
    $this->get('/?lang=bn')->assertOk()->assertSee('ঢাকা ওভেন মিলস');
    $this->get('/about')->assertOk();
    $this->get('/fabrics')->assertOk();
    $this->get('/machinery')->assertOk();
    $this->get('/news')->assertOk();
    $this->get('/careers')->assertOk();
    $this->get('/sitemap.xml')->assertOk();
    $this->get('/robots.txt')->assertOk()->assertSee('Sitemap:');
    $this->get('/admin/login')->assertOk();
    $this->get('/buyer/login')->assertOk();
    $this->get('/supplier/login')->assertOk();
    $this->get('/floor/login')->assertOk();

    Livewire::test(SampleRequestForm::class)
        ->set('company_name', 'Atlas Shirts')
        ->set('email', 'buyer@atlas.test')
        ->set('requirement', '40x40 poplin, 5000 m')
        ->call('save')
        ->assertHasNoErrors()
        ->assertSet('sent', true);

    expect(Inquiry::query()->where('subject', 'Sample request')->exists())->toBeTrue();

    Livewire::test(RfqForm::class)
        ->set('company_name', 'Atlas Shirts')
        ->set('email', 'buyer@atlas.test')
        ->set('requirement', 'Bottom weight twill')
        ->call('save')
        ->assertSet('sent', true);

    Livewire::test(SampleRequestForm::class)
        ->set('website_url', 'https://spam.test')
        ->set('company_name', 'Spam')
        ->set('email', 'spam@spam.test')
        ->set('requirement', 'ignore')
        ->call('save')
        ->assertSet('sent', false);

    Livewire::test(CareerForm::class)
        ->set('name', 'Rina Akter')
        ->set('email', 'rina@mill.test')
        ->set('cover_letter', 'Three years on air-jet looms.')
        ->call('save')
        ->assertSet('sent', true);

    expect(JobApplication::query()->where('email', 'rina@mill.test')->exists())->toBeTrue();
});
