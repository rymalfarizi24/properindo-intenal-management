# 📚 Artikula: Reading Space

![Dynamic JSON Badge](https://img.shields.io/badge/dynamic/json?url=https%3A%2F%2Fraw.githubusercontent.com%2FLetsgobois24%2Farticle-app%2Frefs%2Fheads%2Fmain%2Fcomposer.json&query=require.laravel%2Fframework&logo=laravel&logoColor=%23FF2D20&label=Laravel&color=%23FF2D20)
![Dynamic JSON Badge](https://img.shields.io/badge/dynamic/json?url=https%3A%2F%2Fraw.githubusercontent.com%2FLetsgobois24%2Farticle-app%2Frefs%2Fheads%2Fmain%2Fcomposer.json&query=require.livewire%2Flivewire&logo=livewire&logoColor=%234E56A6&label=Livewire&color=%234E56A6)
![Supabase](https://img.shields.io/badge/Supabase-3ECF8E?style=flat&logo=supabase&logoColor=white)
![Dynamic JSON Badge](https://img.shields.io/badge/dynamic/json?url=https%3A%2F%2Fraw.githubusercontent.com%2FLetsgobois24%2Farticle-app%2Frefs%2Fheads%2Fmain%2Fpackage.json&query=devDependencies.tailwindcss&logo=tailwindcss&logoColor=%2306B6D4&label=Tailwind%20CSS&color=%2306B6D4)



**Artikula: Reading Space** is a digital article publishing and discovery platform designed to share ideas, expand knowledge, and connect readers through a unified reading space. The platform provides an intuitive experience for readers while offering powerful management and analytics tools for both authors and administrators.

---

## ✨ Features

### 🔍 Article Discovery
- Search articles by keyword
- Filter articles by category
- Browse published articles in an organized interface

### 👤 Authentication & Authorization
- User registration and login
- Secure authentication
- Role-based authorization for **Users** and **Administrators**

### 📝 Article Categories Management (Admin)
- Create article categories
- View category list
- Update category name & color
- Delete categories

### 📊 User Dashboard
- View personal article statistics
- Interactive charts for published articles
- Data tables summarizing published content

### 📈 Admin Dashboard
- View overall article statistics
- Interactive charts for all published articles
- Data tables for platform-wide analytics

### 💬 Feedback System
- Submit suggestions and criticisms through the website
- Easy communication channel between users and administrators

---

## 🛠 Tech Stack

| Technology | Description |
|------------|-------------|
| Laravel 12 | Backend Framework |
| Livewire 3 | Full-stack frontend framework |
| PostgreSQL (Supabase) | Database |
| Tailwind CSS | User Interface Styling |

---

## 📂 Project Structure

```

article-app
│
├── app/
│   │
│   ├── Helpers/
│   │   ├── file.php
│   │   └── number.php
│   │
│   ├── Livewire/
│   │   ├── Components/
│   │   └── Pages/
│   │
│   ├── Services/
│   │
│   └── View/
│   │   └── Components/
│
├── laravel/
│   │
│   ├── app/
│   ├── resources/
│   ├── routes/
│   │   └── web.php
│   ├── database/
│   ├── public/
│   ├── .env
│   ├── .env.production
│   └── Dockerfile
│
├── database/
│   │
│   ├── factories/
│   ├── migrations/
│   ├── seeders/
│   └── database.sqlite
│
├── public/
├── resources/
├── routes/
│   └── web.php
│
├── .env
├── .gitignore
├── composer.json
└── package.json

```

---

## 🚀 Installation

### 1. Clone Repository

```bash
git clone https://github.com/your-username/artikula-reading-space.git
cd artikula-reading-space
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Configure Environment

Copy the environment file.

```bash
cp .env.example .env
```

Update your database configuration with your Supabase PostgreSQL credentials.

```env
DB_CONNECTION=pgsql
DB_HOST=your_host
DB_PORT=5432
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

SUPABASE_URL=your_url
SUPABASE_ANON_KEY=your_key
SUPABASE_SERVICE_ROLE_KEY=your_role_key
SUPABASE_BUCKET=your_bucket
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Database Migration and Seeder

```bash
php artisan migrate
php artisan db:seed
```

### 6. Start Development Server

```bash
php artisan serve
npm run dev
```

---

## 🔐 User Roles

### Administrator

- Manage article categories (CRUD)
- View overall article analytics
- Monitor platform statistics

### User

- Register and log in
- Search and read articles
- Filter articles by category
- Submit feedback
- View personal publishing analytics

---

## 📊 Dashboard Analytics

### User Dashboard

- Number of published articles
- Interactive charts
- Article statistics table

### Admin Dashboard

- Platform-wide publishing statistics
- Interactive charts
- Overall article data table

---

## 🔎 Search & Filtering

Users can quickly discover articles by:

- Keyword search
- Category filtering

This allows readers to efficiently explore relevant content within the platform.

---

## 💡 Feedback

Visitors can send:

- Suggestions
- Criticisms
- General feedback

through a dedicated contact form available on the website.

---

## 📸 Preview

### Home Page
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/a7b88dc6-b69a-41a6-a5d7-83971149ae3a" />

### Blogs Page
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/fac1c606-0316-4cf4-88a4-576cf2df2fe9" />

### Dashboard Admin Page
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/d5bfc1bc-0cf2-419e-88ab-dd5b03ced55c" />


---

## 📄 License

This project is intended for educational and portfolio purposes.

---

## 👨‍💻 Author

**Rayhan Muhammad Alfarizi**

Electrical Engineering Graduate
Diponegoro University

LinkedIn: https://www.linkedin.com/in/rayhan-m-alfarizi/

GitHub: https://github.com/Letsgobois24
