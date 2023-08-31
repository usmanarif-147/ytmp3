<?php

use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Language\Create;
use App\Http\Livewire\Admin\Language\Edit;
use App\Http\Livewire\Admin\Language\Languages;
use App\Http\Livewire\Admin\Page\CreatePage;
use App\Http\Livewire\Admin\Page\EditPage;
use App\Http\Livewire\Admin\Page\Pages;
use App\Http\Livewire\Admin\PageContent\Faq\AddFaq;
use App\Http\Livewire\Admin\PageContent\Faq\EditFaq;
use App\Http\Livewire\Admin\PageContent\Feature\AddFeature;
use App\Http\Livewire\Admin\PageContent\Feature\EditFeature;
use App\Http\Livewire\Admin\PageContent\Help\AddHelp;
use App\Http\Livewire\Admin\PageContent\Help\EditHelp;
use App\Http\Livewire\Admin\PageContent\Meta\AddMeta;
use App\Http\Livewire\Admin\PageContent\Meta\EditMeta;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:admin')->group(function () {

    Route::get('dashboard', Dashboard::class);
    Route::get('manage-languages', Languages::class)->name('languages');
    Route::get('create', Create::class)->name('create.language');
    Route::get('edit/{id}', Edit::class)->name('edit.language');


    /**
     * Pages Routes
     */
    Route::get('pages', Pages::class)->name('pages');
    Route::get('create-page', CreatePage::class)->name('create.page');
    Route::get('edit-page/{id}', EditPage::class)->name('edit.page');

    /**
     * Page Meta Details Routes
     */
    Route::get('add/meta-details/{pageId}', AddMeta::class)->name('add.page.meta');
    Route::get('edit/meta-details/{pageId}', EditMeta::class)->name('edit.page.meta');

    /**
     * Page Help Routes
     */
    Route::get('add/help/{pageId}', AddHelp::class)->name('add.page.help');
    Route::get('edit/help/{pageId}', EditHelp::class)->name('edit.page.help');

    /**
     * Page Feature Routes
     */
    Route::get('add/feature/{pageId}', AddFeature::class)->name('add.page.feature');
    Route::get('edit/feature/{pageId}', EditFeature::class)->name('edit.page.feature');

    /**
     * Page Faq Routes
     */
    Route::get('add/faqs/{pageId}', AddFaq::class)->name('add.page.faqs');
    Route::get('edit/faqs/{pageId}', EditFaq::class)->name('edit.page.faqs');

    // logs
    // Route::get('logs', Logs::class);

    // profile
    // Route::post('/changePassword', [ProfileController::class, 'changePassword'])->name('profile.change.password');
});