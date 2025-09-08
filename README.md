# Laravel Multi-Tenant SaaS (User with Multiple Companies)

This project is a minimal backend for a **multi-tenant SaaS** where a user can:
- Register, login, and logout (via **Laravel Breeze** + Sanctum).
- Create, update, delete, and list multiple companies under their account.
- Switch between companies; all data is scoped to the **active company**.
- Policies enforce data isolation (users cannot access another user’s companies).

---

## Features
- **Authentication**: Handled by Laravel Breeze with Sanctum for API tokens.
- **Multi-company ownership**: Each user can manage multiple companies.
- **Company switching**: Users set an *active company*, stored on their user profile.
- **Authorization policies**: Ensure users can only access their own companies.
- **REST API**: CRUD endpoints for companies + active company switching.
- **Web routes**: Breeze’s built-in authentication and views.

---

## API Endpoints

###  Authentication (Laravel Breeze + Sanctum)
- **POST** `/api/register` — Register a new user  
- **POST** `/api/login` — Login and receive an auth token  
- **POST** `/api/logout` — Logout 

---

###  Companies
- **GET** `/api/companies` — List user’s companies  
- **POST** `/api/companies` — Create a new company  
- **GET** `/api/companies/{company}` — Show company details  
- **PUT** `/api/companies/{company}` — Update a company  
- **DELETE** `/api/companies/{company}` — Delete a company  
- **POST** `/api/companies/{company}/switch` — Set as active company  

---

###  Test Endpoint
- **GET** `/api/test` → `{ "status": "API working!" }`  

---

## Web Routes (Laravel Breeze)
- `/register` — Register form (view)  
- `/login` — Login form (view)  
- `/dashboard` — Dashboard (requires authentication)  
- `/profile` — Profile management (edit/update/delete)  
- `/companies` — Company CRUD (resource controller)  
- `/companies/{company}/switch` — Switch active company (web route)  

---

## Authorization Policies

### CompanyPolicy
- **view(User $user, Company $company)** — A user can view their own companies  
- **update(User $user, Company $company)** — A user can update their own companies  
- **delete(User $user, Company $company)** — A user can delete their own companies  

Registered automatically in `AuthServiceProvider`.  

Controllers can authorize like this:

```php
$this->authorize('update', $company);

##  Quick Install

```bash
git clone https://github.com/gaurav-21609/Multi-Tenant-SaaS.git \
&& cd laravel-multitenant-saas \
&& composer install \
&& npm install && npm run build \
&& cp .env.example .env \
&& php artisan key:generate \
&& php artisan migrate \
&& php artisan serve


