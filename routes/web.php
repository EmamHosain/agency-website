<?php

use App\Livewire\AboutUs;
use App\Livewire\BlogDetails;
use App\Livewire\BlogPage;
use App\Livewire\FaqPage;
use App\Livewire\HomePage;
use App\Livewire\MemberPage;
use App\Livewire\ServiceDetails;
use App\Livewire\ServicePage;
use Illuminate\Support\Facades\Route;


Route::get('/', HomePage::class)->name('homePage');
Route::get('/services', ServicePage::class)->name('servicePage');
Route::get('/service-detials/{id}', ServiceDetails::class)->name('serviceDetails');
Route::get('/members', MemberPage::class)->name('members');
Route::get('/about-us', AboutUs::class)->name('about_us');
Route::get('/blog', BlogPage::class)->name('blog_page');
Route::get('/blog-details', BlogDetails::class)->name('blog_details');
Route::get('/faq',FaqPage::class )->name('faq_page');