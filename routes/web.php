<?php

use App\Http\Controllers\SitemapController;
use App\Livewire\Admin\About as AboutSettings;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Features\Index as FeaturesIndex;
use App\Livewire\Admin\Footer as FooterSettings;
use App\Livewire\Admin\Hero as HeroSettings;
use App\Livewire\Admin\Leads\Index as LeadsIndex;
use App\Livewire\Admin\Messages\Index as MessagesIndex;
use App\Livewire\Admin\Navigation\Index as NavigationIndex;
use App\Livewire\Admin\Pricing\Index as PricingIndex;
use App\Livewire\Admin\Projects\Index as ProjectsIndex;
use App\Livewire\Admin\Services\Index as ServicesIndex;
use App\Livewire\Admin\SocialLinks\Index as SocialLinksIndex;
use App\Livewire\Admin\Testimonials\Index as TestimonialsIndex;
use App\Livewire\Admin\Websites\Index as WebsitesIndex;
use App\Livewire\Public\About;
use App\Livewire\Public\Archive;
use App\Livewire\Public\Gallery;
use App\Livewire\Public\Home;
use App\Livewire\Public\PrivacyPolicy;
use App\Livewire\Public\ProjectDetail;
use App\Livewire\Public\ServiceDetail;
use App\Livewire\Public\TermsOfService;
use App\Livewire\Public\ThreeDGallery;
use App\Livewire\Public\ThreeDViewer;
use App\Http\Controllers\InvoiceController;
use App\Livewire\Admin\OrderForm;
use App\Livewire\Admin\OrderList;


use App\Livewire\Public\ThreeShowcase;
use App\Livewire\Public\Websites;

use App\Livewire\Public\Works;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/3d-showcase', ThreeShowcase::class)->name('showcase.3d');
Route::get('/works', Works::class)->name('works');
Route::get('/gallery', Gallery::class)->name('gallery');
Route::get('/3d-gallery', ThreeDGallery::class)->name('three-d.gallery');
Route::get('/3d-gallery/{slug}', ThreeDViewer::class)->name('three-d.show');
Route::get('/websites', Websites::class)->name('websites');
Route::get('/archive', Archive::class)->name('archive');
Route::get('/works/{slug}', ProjectDetail::class)->name('works.show');
Route::get('/services/{slug}', ServiceDetail::class)->name('services.show');
Route::get('/about', About::class)->name('about');
Route::get('/privacy-policy', PrivacyPolicy::class)->name('privacy-policy');
Route::get('/terms-of-service', TermsOfService::class)->name('terms-of-service');
Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/invoice/{order}', [InvoiceController::class, 'show'])->name('invoice');

Route::get('/redis-check', function () {
    return Redis::connection()->ping();
});


Route::get('dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('hero', HeroSettings::class)->name('hero');
    Route::get('about', AboutSettings::class)->name('about');
    Route::get('services', ServicesIndex::class)->name('services');
    Route::get('services/create', App\Livewire\Admin\Services\Create::class)->name('services.create');
    Route::get('services/{id}/edit', App\Livewire\Admin\Services\Edit::class)->name('services.edit');
    
    Route::get('projects', ProjectsIndex::class)->name('projects');
    Route::get('projects/create', App\Livewire\Admin\Projects\Create::class)->name('projects.create');
    Route::get('projects/{id}/edit', App\Livewire\Admin\Projects\Edit::class)->name('projects.edit');
    Route::get('features', FeaturesIndex::class)->name('features');
    Route::get('pricing', PricingIndex::class)->name('pricing');
    Route::get('testimonials', TestimonialsIndex::class)->name('testimonials');
    Route::get('footer', FooterSettings::class)->name('footer');
    Route::get('social-links', SocialLinksIndex::class)->name('social-links');
    Route::get('navigation', NavigationIndex::class)->name('navigation');
    Route::get('messages', MessagesIndex::class)->name('messages');
    Route::get('leads', LeadsIndex::class)->name('leads');
    Route::get('websites', WebsitesIndex::class)->name('websites');
    Route::get('websites/create', App\Livewire\Admin\Websites\Create::class)->name('websites.create');
    Route::get('websites/{id}/edit', App\Livewire\Admin\Websites\Edit::class)->name('websites.edit');
    Route::get('gallery', App\Livewire\Admin\Gallery\Index::class)->name('gallery');

    Route::get('three-d', App\Livewire\Admin\ThreeD\Index::class)->name('three-d.index');
    Route::get('three-d/create', App\Livewire\Admin\ThreeD\Create::class)->name('three-d.create');
    Route::get('three-d/{id}/edit', App\Livewire\Admin\ThreeD\Edit::class)->name('three-d.edit');
    
    Route::get('music', App\Livewire\Admin\Music\Index::class)->name('music.index');
    Route::get('music/create', App\Livewire\Admin\Music\Create::class)->name('music.create');
    Route::get('music/{music}/edit', App\Livewire\Admin\Music\Edit::class)->name('music.edit');

    Route::get('/order-form', OrderForm::class)->name('order-form');
    Route::get('/orders', OrderList::class)->name('orders.index');

});

Route::get('/websites/{slug}', function ($slug) {
    $website = \App\Models\Website::where('slug', $slug)->firstOrFail();
    return view("websites.{$slug}", ['website' => $website]);
})->name('websites.show');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
