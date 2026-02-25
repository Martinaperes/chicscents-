# ScentCepts | Luxury Fragrance E-commerce

ScentCepts is a premium e-commerce platform designed for high-end fragrance retail, specifically tailored for the Kenyan market. It features a sophisticated administrative dashboard, a rich customer storefront, and a seamless WhatsApp-integrated checkout flow.

## 🌟 Key Features

### **Customer Experience**
- **Premium Storefront**: A high-aesthetic interface with smooth animations, curated typography, and luxury color palettes.
- **Dynamic Product Browsing**: Filterable perfume collections with detailed descriptions, scent profiles, and notes.
- **Integrated Cart System**: Secure session-based cart management.
- **WhatsApp Checkout**: A unique, high-conversion checkout flow that generates a pre-formatted order summary and redirects customers to WhatsApp for final confirmation and payment coordination.

### **Admin Intelligence Dashboard**
- **Command Center**: Real-time business metrics including Gross Revenue, Total Orders, and Client Identity tracking.
- **Advanced Order Management**: 
  - High-visibility "Flow Status" tracking (Pending, Processing, Shipped, Delivered).
  - Manual Payment reconciliation and status updates.
  - Detailed Order Manifests with product images and customer routing info.
- **Inventory Hub**: Full CRUD operations for fragrances and brands with automatic low-stock alerting.

## 🛠 Tech Stack

- **Framework**: [Laravel 11](https://laravel.com/)
- **Frontend**: Tailwind CSS, Vanilla JS, Blade Templating
- **Database**: SQLite / MySQL (Eloquent ORM)
- **Icons**: Google Material Symbols
- **Typography**: Playfair Display & Inter

## 🚀 Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM

### Installation

1. **Clone the repository**
   ```bash
   git clone [repository-url]
   cd chic-scents-ke
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Migration**
   ```bash
   php artisan migrate
   ```

5. **Symlink Storage**
   ```bash
   php artisan storage:link
   ```

6. **Launch Development Server**
   ```bash
   php artisan serve
   ```
   Open another terminal and run:
   ```bash
   npm run dev
   ```

## 📦 Project Structure

- `app/Http/Controllers`: Core business logic (Checkout, Admin, Product handlers).
- `app/Models`: Database schemas and relationships (Order, Perfume, Brand).
- `resources/views`: Blade templates for storefront and admin dashboard.
- `routes/web.php`: Application routing.

## 📱 Checkout Workflow
The system utilizes a **Hybrid-WhatsApp Workflow**:
1. User provides delivery details in the checkout form.
2. The system persists the order to the database.
3. User is redirected to a success page.
4. An automated trigger opens WhatsApp with the **Seller Number (0716052342)** and a rich-text order summary.
5. Admin confirms payment manually in the dashboard after receiving funds.

---
*Created by ScentCepts Development Team · © 2026*
