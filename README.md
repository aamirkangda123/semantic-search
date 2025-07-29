# Semantic Keyword Search (Laravel 12)

This project allows users to import keywords from Excel and perform semantic searches using vector embeddings.

## Setup Instructions

# Laravel Semantic Search

## How to Run

1. Clone or create Laravel project.
2. Copy `.env` and configure DB + OpenAI key.
3. Run:
   - `composer install`
   - `php artisan migrate`
   - Place Excel in `storage/app/`
   - `php artisan import:keywords`
   - `php artisan serve`
4. Visit `/search` to try AI-powered search.

## Dependencies
- Laravel
- Laravel Excel
- OpenAI PHP SDK
