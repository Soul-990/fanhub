<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Explore;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CharactersController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AdminMediaController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AdminMerchandiseController;
use App\Http\Controllers\AdminChatbotFaqController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FanArtController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PublicContentController;
use App\Http\Controllers\PublicCharacterController;
use App\Http\Controllers\PublicArticleController;
use App\Http\Controllers\PublicMediaController;
use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\PublicMerchandiseController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatbotController;

/*
|--------------------------------------------------------------------------
| Public Web Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Authentication Scaffolding
Auth::routes();

// Default auth redirect route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Explore Fandom Universe
Route::get('/explore', [Explore::class, 'index'])->name('explore');
Route::get('/explore/filter/{cat}', [Explore::class, 'filter']);

// Content Details
Route::get('/content/{id}', [PublicContentController::class, 'show'])->name('content.detail');

// Characters Directory & Profile
Route::get('/characters', [PublicCharacterController::class, 'index'])->name('characters.all');
Route::get('/characters/{id}', [PublicCharacterController::class, 'show'])->name('characters.detail');

// Articles & Lore
Route::get('/articles', [PublicArticleController::class, 'index'])->name('articles.all');
Route::get('/articles/{id}', [PublicArticleController::class, 'show'])->name('articles.detail');

// Media Center
Route::get('/media', [PublicMediaController::class, 'index'])->name('media.all');

// Events & Conventions
Route::get('/events', [PublicEventController::class, 'index'])->name('events.all');

// Merchandise Showcase (SRS: Display / Discovery only)
Route::get('/merchandise', [PublicMerchandiseController::class, 'index'])->name('merchandise.all');

// Pre-scripted FAQ Chatbot API
Route::post('/api/chatbot/ask', [ChatbotController::class, 'ask'])->name('api.chatbot.ask');


/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Bookmarks
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks/toggle/{id?}', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');

    // Ratings & Reviews
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Feedback Submission
    Route::get('/feedback-submit', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback-submit', [FeedbackController::class, 'store'])->name('feedback.store');

    // Fan Art Submission
    Route::get('/fanart-submit', [FanArtController::class, 'create'])->name('fanart.create');
    Route::post('/fanart-submit', [FanArtController::class, 'store'])->name('fanart.store');
});


/*
|--------------------------------------------------------------------------
| Admin Portal Routes (Restricted by Role 1 via AdminMiddleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [HomeController::class, 'index']);

    // Categories Management
    Route::get('/category-show-all', [CategoryController::class, 'index'])->name('cat');
    Route::get('/category-add', [CategoryController::class, 'create'])->name('addcat');
    Route::post('/category/add-category', [CategoryController::class, 'store']);
    Route::get('/category-edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/category/save-changes/{id}', [CategoryController::class, 'update']);
    Route::get('/category-delete/{id}', [CategoryController::class, 'destroy']);

    // Content Management
    Route::get('/content-show-all', [ContentController::class, 'index'])->name('content');
    Route::get('/content-add', [ContentController::class, 'create'])->name('addcontent');
    Route::post('/content/add-content', [ContentController::class, 'store']);
    Route::get('/content-edit/{id}', [ContentController::class, 'edit']);
    Route::post('/content/save-changes/{id}', [ContentController::class, 'update']);
    Route::get('/content-delete/{id}', [ContentController::class, 'destroy']);

    // Character Profiles Management
    Route::get('/character-show-all', [CharactersController::class, 'index'])->name('character');
    Route::get('/character-add', [CharactersController::class, 'create'])->name('addcharacter');
    Route::post('/character/add-character', [CharactersController::class, 'store']);
    Route::get('/character-edit/{id}', [CharactersController::class, 'edit']);
    Route::post('/character/save-changes/{id}', [CharactersController::class, 'update']);
    Route::get('/character-delete/{id}', [CharactersController::class, 'destroy']);

    // Genres Management
    Route::resource('genres', GenreController::class);
    Route::get('/genres/delete/{id}', [GenreController::class, 'destroy']);

    // Media Center Management
    Route::prefix('admin/media')->name('admin.media.')->group(function () {
        Route::get('/', [AdminMediaController::class, 'index'])->name('index');
        Route::get('/create', [AdminMediaController::class, 'create'])->name('create');
        Route::post('/', [AdminMediaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminMediaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminMediaController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminMediaController::class, 'destroy'])->name('destroy');
        Route::get('/delete/{id}', [AdminMediaController::class, 'destroy']);
    });

    // Articles & Lore Management
    Route::prefix('admin/articles')->name('admin.articles.')->group(function () {
        Route::get('/', [AdminArticleController::class, 'index'])->name('index');
        Route::get('/create', [AdminArticleController::class, 'create'])->name('create');
        Route::post('/', [AdminArticleController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminArticleController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminArticleController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminArticleController::class, 'destroy'])->name('destroy');
        Route::get('/delete/{id}', [AdminArticleController::class, 'destroy']);
        Route::get('/approve/{id}', [AdminArticleController::class, 'approve'])->name('approve');
        Route::get('/reject/{id}', [AdminArticleController::class, 'reject'])->name('reject');
    });

    // Events & Meetups Management
    Route::prefix('admin/events')->name('admin.events.')->group(function () {
        Route::get('/', [AdminEventController::class, 'index'])->name('index');
        Route::get('/create', [AdminEventController::class, 'create'])->name('create');
        Route::post('/', [AdminEventController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminEventController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminEventController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminEventController::class, 'destroy'])->name('destroy');
        Route::get('/delete/{id}', [AdminEventController::class, 'destroy']);
    });

    // Merchandise Showcase Management
    Route::prefix('admin/merchandise')->name('admin.merchandise.')->group(function () {
        Route::get('/', [AdminMerchandiseController::class, 'index'])->name('index');
        Route::get('/create', [AdminMerchandiseController::class, 'create'])->name('create');
        Route::post('/', [AdminMerchandiseController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminMerchandiseController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminMerchandiseController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminMerchandiseController::class, 'destroy'])->name('destroy');
        Route::get('/delete/{id}', [AdminMerchandiseController::class, 'destroy']);
    });

    // Chatbot FAQs Management
    Route::prefix('admin/faqs')->name('admin.faqs.')->group(function () {
        Route::get('/', [AdminChatbotFaqController::class, 'index'])->name('index');
        Route::get('/create', [AdminChatbotFaqController::class, 'create'])->name('create');
        Route::post('/', [AdminChatbotFaqController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminChatbotFaqController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminChatbotFaqController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminChatbotFaqController::class, 'destroy'])->name('destroy');
        Route::get('/delete/{id}', [AdminChatbotFaqController::class, 'destroy']);
    });

    // User Moderation
    Route::get('/users-show-all', [UserController::class, 'index'])->name('users');
    Route::get('/user-ban/{id}', [UserController::class, 'ban'])->name('userban');
    Route::get('/user-unban/{id}', [UserController::class, 'unban'])->name('userunban');

    // Community Fan Art Moderation
    Route::get('/fanart-show-all', [FanArtController::class, 'index'])->name('fanart');
    Route::get('/fanart-approve/{id}', [FanArtController::class, 'approve'])->name('fanartapprove');
    Route::get('/fanart-disapprove/{id}', [FanArtController::class, 'disapprove'])->name('fanartdisapprove');
    Route::get('/fanart-delete/{id}', [FanArtController::class, 'destroy'])->name('fanartdelete');

    // User Feedback Management
    Route::get('/feedback-show-all', [FeedbackController::class, 'index'])->name('feedback');
    Route::get('/feedback-resolve/{id}', [FeedbackController::class, 'resolve'])->name('feedbackresolve');
    Route::get('/feedback-reopen/{id}', [FeedbackController::class, 'reopen'])->name('feedbackreopen');
    Route::get('/feedback-delete/{id}', [FeedbackController::class, 'destroy'])->name('feedbackdelete');
});