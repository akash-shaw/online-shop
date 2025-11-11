# MerchHub - Online Merch Store

## Table of Contents
- [MerchHub - Online Merch Store](#merchhub---online-merch-store)
  - [Table of Contents](#table-of-contents)
  - [Introduction](#introduction)
  - [Features](#features)
  - [Technologies Used](#technologies-used)
  - [Pages](#pages)
    - [Home](#home)
    - [About Us](#about-us)
    - [Shop](#shop)
    - [Contact Us](#contact-us)
    - [Cart](#cart)
    - [Checkout](#checkout)
    - [Orders](#orders)
    - [Admin Dashboard](#admin-dashboard)
    - [Admin Products](#admin-products)
    - [Admin Orders](#admin-orders)
    - [Admin Users](#admin-users)
    - [Admin Messages](#admin-messages)
  - [Database](#database)
  - [Usage](#usage)
  - [Quick Start (XAMPP)](#quick-start-xampp)
  - [Quick Start (Docker Compose)](#quick-start-docker-compose)
  - [Environment Variables](#environment-variables)
  - [Tech Stack](#tech-stack)
  - [Contributing](#contributing)
  - [License](#license)
  - [Contact](#contact)
  - [Contributing](#contributing-1)

## Introduction
MerchHub is an online merchandise store for apparel, accessories, collectibles, and lifestyle products. Users can browse, search, and purchase items while administrators manage inventory, orders, users, and messages through an admin dashboard.

## Features

- User authentication (customer & admin roles)
- Product browsing & search
- Cart & checkout (Cash on delivery + configurable payment methods)
- PDF invoice generation (TCPDF)
- Order tracking & payment status
- Customer reviews section
- Featured brands showcase
- Contact form & admin message center
- Admin dashboard (products, orders, users, messages)
- Environment-based configuration (.env)


## Technologies Used
- HTML
- CSS
- PHP
- MySQL

## Pages

### Home
Hero banner highlighting latest merch drops and featured collections.

### About Us
Store mission, customer reviews, and featured brands/community partners.

### Shop
List of all merchandise items with pricing and images.

### Contact Us
Form to reach support for order questions, sizing, shipping, or general inquiries.

### Cart
This page shows the items a customer has selected to purchase, including quantity, price, and subtotal.

### Checkout
This page allows customers to enter their shipping information and choose a payment method  and confirm the order.

### Orders
Order list with payment status and invoice download (PDF). Optional payment integrations.

### Admin Dashboard
This page provides an overview of key website metrics and allows you to manage products, orders, users, and messages.

### Admin Products
Add/edit products (name, image, price, etc.).

### Admin Orders
This page allows you to view all orders.

### Admin Users
View and manage registered users; remove accounts.

### Admin Messages
Messages sent via contact form for support.

## Database
MySQL stores products, users, cart items, orders, and messages. Schema provided in `sql/merch_store.sql` and auto-initialized in Docker.

## Usage
Customers browse merch, add items to cart, checkout, and view orders. Admins manage catalog and operations.

## Quick Start (XAMPP)
Prerequisites: XAMPP for Windows (Apache + MySQL).

1. Start Apache and MySQL from the XAMPP Control Panel.
2. Copy this project folder into `C:\\xampp\\htdocs\\` (or use a symlink/VirtualHost).
3. Create the MySQL database named `merch_store`.
4. Import the schema using phpMyAdmin:
  - Open `http://localhost/phpmyadmin`.
  - Create database `merch_store` (utf8mb4).
  - Import `sql/merch_store.sql` from this repo.
5. Configure environment (optional):
  - Copy `.env.example` to `.env` and, if needed, set DB credentials to your XAMPP MySQL (default user: `root`, empty password).
  - Or edit `config.php` defaults if you prefer.
6. Visit the site in your browser:
  - If the folder name is `online-shop`: `http://localhost/online-shop/`
7. Admin login: `admin@example.com` / `admin`.

## Quick Start (Docker Compose)
Prerequisites: Docker Desktop installed.

1. Run:
  ```bash
  docker compose up --build
  ```
2. Open the app at: `http://localhost:8080`
3. phpMyAdmin at: `http://localhost:8081` (user: `root`, password: `example`).
4. Admin login: `admin@example.com` / `admin`.

To stop:
```bash
docker compose down
```

## Environment Variables
Defined in `.env.example` and consumed by `config.php`:
- `DB_HOST`
- `DB_USER`
- `DB_PASS`
- `DB_NAME`
- `STORE_NAME`

## Tech Stack
- PHP 8 + MySQL
- TCPDF for PDF invoice generation
- Docker (optional dev environment)
- Plain CSS/JS (no build step)

## Contributing
Fork, branch, commit, and open PRs. Keep changes focused; include any schema updates in `sql/`.

## License
Original project fork; ensure compliance with upstream license. (Add a license file if absent.)

## Contact
For help open an issue or use the contact form in the app.

## Contributing 
Contributions to the Boi Mela website are welcome. If you'd like to contribute, please fork the repository, make your changes, and submit a pull request. Ensure your code follows the established coding standards and includes appropriate documentation where necessary.
