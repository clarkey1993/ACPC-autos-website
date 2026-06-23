<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarImageController;
use App\Http\Controllers\Admin\EnquiryController as AdminEnquiryController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\CarListingController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\ProfileController;
use App\Models\Car;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', function () {
    $settings = SiteSetting::query()->first();

    $pages = [
        ['loc' => route('home'), 'lastmod' => now()],
        ['loc' => route('about'), 'lastmod' => now()],
        ['loc' => route('contact'), 'lastmod' => now()],
        ['loc' => route('warranty'), 'lastmod' => now()],
        ['loc' => route('privacy'), 'lastmod' => now()],
        ['loc' => route('terms'), 'lastmod' => now()],
        ['loc' => route('cookies'), 'lastmod' => now()],
        ['loc' => route('faq'), 'lastmod' => now()],
    ];

    if ($settings && $settings->enable_dedicated_cars_page) {
        $pages[] = ['loc' => route('cars.index'), 'lastmod' => now()];
    }

    $cars = Car::query()
        ->select(['slug', 'updated_at'])
        ->orderByDesc('updated_at')
        ->get();

    return response()
        ->view('seo.sitemap', compact('pages', 'cars'))
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('seo.sitemap');

Route::get('/robots.txt', function () {
    $content = implode("\n", [
        'User-agent: *',
        'Allow: /',
        'Disallow: /admin',
        '',
        'Sitemap: ' . route('seo.sitemap'),
    ]) . "\n";

    return response($content, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
})->name('seo.robots');

Route::get('/language/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'es'], true)) {
        $locale = 'en';
    }

    session(['locale' => $locale]);

    return redirect()->back();
})->name('locale.switch');

Route::get('/', [CarListingController::class, 'home'])->name('home');
Route::get('/cars', [CarListingController::class, 'index'])->name('cars.index');
Route::get('/cars/{slug}', [CarListingController::class, 'show'])->name('cars.show');
Route::post('/cars/{car:slug}/enquiries', [EnquiryController::class, 'store'])->name('enquiries.store');
Route::get('/about-us', [PublicPageController::class, 'about'])->name('about');
Route::get('/contact-us', [PublicPageController::class, 'contact'])->name('contact');
Route::post('/contact-us', [PublicPageController::class, 'submitContact'])->name('contact.submit');
Route::get('/warranty', [PublicPageController::class, 'warranty'])->name('warranty');
Route::get('/privacy-policy', [PublicPageController::class, 'privacyPolicy'])->name('privacy');
Route::get('/terms-and-conditions', [PublicPageController::class, 'termsAndConditions'])->name('terms');
Route::get('/cookie-policy', [PublicPageController::class, 'cookiePolicy'])->name('cookies');
Route::get('/faq', [PublicPageController::class, 'faq'])->name('faq');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/site-settings', [SiteSettingController::class, 'edit'])->name('site-settings.edit');
    Route::put('/site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');
    Route::resource('cars', CarController::class);
    Route::delete('/car-images/{id}', [CarImageController::class, 'destroy'])->name('car-images.destroy');
    Route::post('/cars/{car}/images/reorder', [CarImageController::class, 'reorder'])->name('car-images.reorder');
    Route::get('/enquiries', [AdminEnquiryController::class, 'index'])->name('enquiries.index');
    Route::get('/enquiries/{enquiry}', [AdminEnquiryController::class, 'show'])->name('enquiries.show');
    Route::patch('/enquiries/{enquiry}/read', [AdminEnquiryController::class, 'markAsRead'])->name('enquiries.read');
    Route::delete('/enquiries/{enquiry}', [AdminEnquiryController::class, 'destroy'])->name('enquiries.destroy');
});

require __DIR__.'/auth.php';
