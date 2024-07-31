## INSTALLING

### 1. Clone this repo
```bash
git clone https://github.com/arisurya7/employee-management.git
```

### 2. Change directory
```bash
cd employee-management
```

### 3. Create and `Setup` .env file (DB)
```bash
cp .env.example .env
```

### 4. Install Composer
```bash
composer install
```

### 5. Generate key
```bash
php artisan key:generate
```

### 6. Migrate database
```bash
php artisan migrate:fresh --seed
```

### 7. Run application
```bash
php artisan serve
```
