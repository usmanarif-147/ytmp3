<?php

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\FooterLinksController;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\FooterSection\CookiePolicy\CookiePolicyPages;
use App\Http\Livewire\Admin\FooterSection\CookiePolicy\CreateCookiePolicy;
use App\Http\Livewire\Admin\FooterSection\CookiePolicy\EditCookiePolicy;
use App\Http\Livewire\Admin\FooterSection\CopyrightAct\CopyrighActPages;
use App\Http\Livewire\Admin\FooterSection\CopyrightAct\CreateCopyrighAct;
use App\Http\Livewire\Admin\FooterSection\CopyrightAct\EditCopyrighAct;
use App\Http\Livewire\Admin\FooterSection\LegalDisclaimer\CreateLegalDisclaimer;
use App\Http\Livewire\Admin\FooterSection\LegalDisclaimer\EditLegalDisclaimer;
use App\Http\Livewire\Admin\FooterSection\LegalDisclaimer\LegalDisclaimerPages;
use App\Http\Livewire\Admin\FooterSection\PrivacyPolicy\CreatePrivacyPolicy;
use App\Http\Livewire\Admin\FooterSection\PrivacyPolicy\EditPrivacyPolicy;
use App\Http\Livewire\Admin\FooterSection\PrivacyPolicy\PrivacyPolicyPages;
use App\Http\Livewire\Admin\FooterSection\TermsOfUse\CreateTermsOfUse;
use App\Http\Livewire\Admin\FooterSection\TermsOfUse\EditTermsOfUse;
use App\Http\Livewire\Admin\FooterSection\TermsOfUse\TermsOfUsePages;
use App\Http\Livewire\Admin\Language\Create;
use App\Http\Livewire\Admin\Language\Edit;
use App\Http\Livewire\Admin\Language\Languages;
use App\Http\Livewire\Admin\Page\CreatePage;
use App\Http\Livewire\Admin\Page\EditPage;
use App\Http\Livewire\Admin\Page\Pages;
use App\Http\Livewire\Admin\PageContent\DynamicMeta\AddDynamicMeta;
use App\Http\Livewire\Admin\PageContent\DynamicMeta\EditDynamicMeta;
use App\Http\Livewire\Admin\PageContent\Faq\AddFaq;
use App\Http\Livewire\Admin\PageContent\Faq\EditFaq;
use App\Http\Livewire\Admin\PageContent\Feature\AddFeature;
use App\Http\Livewire\Admin\PageContent\Feature\EditFeature;
use App\Http\Livewire\Admin\PageContent\Help\AddHelp;
use App\Http\Livewire\Admin\PageContent\Help\EditHelp;
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
     * Page Dynamic Meta Details Routes
     */
    Route::get('add/dynamic-meta-details/{pageId}', AddDynamicMeta::class)->name('add.dynamic.page.meta');
    Route::get('edit/dynamic-meta-details/{pageId}', EditDynamicMeta::class)->name('edit.dynamic.page.meta');

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

    /**
     * Manage Footer Pages
     */
    Route::get('terms-of-use/pages', TermsOfUsePages::class)->name('termofusepages');
    Route::get('terms-of-use/create-page', CreateTermsOfUse::class)->name('create.termofuse.page');
    Route::get('terms-of-use/edit-page/{id}', EditTermsOfUse::class)->name('edit.termofuse.page');

    Route::get('privacy-policy/pages', PrivacyPolicyPages::class)->name('privacypolicypages');
    Route::get('privacy-policy/create-page', CreatePrivacyPolicy::class)->name('create.privacypolicy.page');
    Route::get('privacy-policy/edit-page/{id}', EditPrivacyPolicy::class)->name('edit.privacypolicy.page');

    Route::get('legal-disclaimer/pages', LegalDisclaimerPages::class)->name('legaldisclaimerpages');
    Route::get('legal-disclaimer/create-page', CreateLegalDisclaimer::class)->name('create.legaldisclaimerpages.page');
    Route::get('legal-disclaimer/edit-page/{id}', EditLegalDisclaimer::class)->name('edit.legaldisclaimerpages.page');

    Route::get('copy-right/pages', CopyrighActPages::class)->name('copyrightpages');
    Route::get('copy-right/create-page', CreateCopyrighAct::class)->name('create.copyrightpages.page');
    Route::get('copy-right/edit-page/{id}', EditCopyrighAct::class)->name('edit.copyrightpages.page');

    Route::get('cookie-policy/pages', CookiePolicyPages::class)->name('cookiepolicypages');
    Route::get('cookie-policy/create-page', CreateCookiePolicy::class)->name('create.cookiepolicypages.page');
    Route::get('cookie-policy/edit-page/{id}', EditCookiePolicy::class)->name('edit.cookiepolicypages.page');


    // logs
    // Route::get('logs', Logs::class);

    // profile
    Route::post('/changePassword', [AdminProfileController::class, 'changePassword'])->name('profile.change.password');
    Route::post('/changeEmail', [AdminProfileController::class, 'changeEmail'])->name('profile.change.email');

    // Footer Section Links
    Route::get('/getYtmLink', [FooterLinksController::class, 'getYtmLink'])->name('get.ytm.link');
    Route::get('/getYadLink', [FooterLinksController::class, 'getYadLink'])->name('get.yad.link');
    Route::post('/setYtmLink', [FooterLinksController::class, 'setYtmLink'])->name('set.ytm.link');
    Route::post('/setYadLink', [FooterLinksController::class, 'setYadLink'])->name('set.yad.link');
});
