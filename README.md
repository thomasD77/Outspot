## Installation

## 1. Install composer
```
phpV. > 8.0 
composer install
```

## 2. Copy & complete .env
```
cp .env.example .env
add MOLLIE_TEST_API_KEY=YOUR_MOLLIE_KEY
```

## 3. Generate artisan key
```
php artisan key:generate
```

## 4. Migrate
```
php artisan migrate 
```
