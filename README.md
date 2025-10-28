# Course Creator - Laravel LMS Platform

A modern **Learning Management System (LMS)** built with **Laravel 12**, where instructors can create courses with **video uploads**, **modules**, **contents**, **feature images**, and more.

## Features

- Create courses with title, summary, price, level, category
- Upload **Feature Video** (up to 100MB)
- Upload **Multiple Feature Images** (up to 2MB each)
- Dynamic **Modules** and **Contents** (YouTube, Vimeo, Upload, Direct)
- Form Request Validation
- Responsive UI with CSS & JS
- File upload using `FileHandler` trait
- Database transactions for data integrity

## Requirements

| Requirement        | Version     |
|--------------------|-------------|
| PHP                | >= 8.2      |
| Laravel            | = 12     |
| Composer           | Latest      |
| MySQL / MariaDB    | 5.7+        |
| Node.js & npm      | (Optional)  |

## Installation Guide

### 1. Clone the Repository
```bash
HTTPS: git clone https://github.com/gsshohel1314/course-creator-app.git
SSH: git clone git@github.com:gsshohel1314/course-creator-app.git
cd course-creator-app
```

### 2. Install Dependencies
```bash
composer install
npm install && npm run build (optional)
```

### 3. Copy .env File
```bash
cp .env.example .env
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Configure Database in .env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=course_creator
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Run Migrations
```bash
php artisan migrate
```

### 7. Serve the Application
```bash
php artisan serve
```

## PHP ini Settings for File Uploads

This project involves uploading videos (up to 100MB), so the settings in the php.ini file must be configured correctly.

## Required php.ini Settings

```bash
upload_max_filesize = 100M
post_max_size = 150M
memory_limit = 256M
```

## How to Update php.ini (Linux Operating System)

### 1. Locate your php.ini file
```bash
php --ini
```

### 2. Edit the file
```bash
sudo nano /etc/php/8.1/apache2/php.ini
sudo nano /etc/php/8.1/cli/php.ini
```

### 3. Update the values
```bash
upload_max_filesize = 100M
post_max_size = 150M
memory_limit = 256M
```

### 4. Restart web server
```bash
sudo systemctl restart apache2
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
