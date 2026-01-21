# TemanJalanObin - E-Commerce & Event Platform

> A comprehensive Laravel-based e-commerce and event management platform featuring real-time shipping calculation and secure payment integration.

## 🛠 Tech Stack

*   **Language:** PHP 7.x / 8.x
*   **Framework:** Laravel 7.x
*   **Frontend:** Vue.js, Bootstrap 4, jQuery, Laravel Mix
*   **Database:** MySQL
*   **Integrations:**
    *   **RajaOngkir API:** Real-time shipping cost calculation (Domestic & International).
    *   **Google Recaptcha:** Spam protection for forms.
    *   **PHPMailer:** Custom email handling for contact and event forms.
    *   **PayPal:** Payment gateway integration.

## ✨ Key Features

*   **Robust E-Commerce System:** Complete flow from product browsing to shopping cart management and secure checkout.
*   **Dynamic Shipping Costs:** Automatically calculates shipping fees based on user location (Province/City/District) using the RajaOngkir API.
*   **User Management:** Secure authentication system with profile management, multiple address books, and password recovery.
*   **Event Registration:** Specialized module for handling event sign-ups with automated email confirmations.
*   **Content Management:** Integrated system for managing news, articles, and video content (YouTube integration).
*   **Order Tracking:** Users can view order history and track shipping status.

## 🚀 Setup & Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/yourusername/temanjalanobin.git
    cd temanjalanobin
    ```

2.  **Install Dependencies:**
    ```bash
    composer install
    npm install && npm run dev
    ```

3.  **Environment Configuration:**
    Copy the example environment file and configure your database and API keys.
    ```bash
    cp .env.example .env
    ```
    *Update `.env` with your Database credentials, `RAJAONGKIR_API_KEY`, and `RECAPTCHA_SECRET_KEY`.*

4.  **Generate App Key:**
    ```bash
    php artisan key:generate
    ```

5.  **Run Migrations:**
    ```bash
    php artisan migrate
    ```

6.  **Start the Server:**
    ```bash
    php artisan serve
    ```

## ⚠️ Disclaimer

This is a sanitized version of a private repository for portfolio demonstration purposes. Some proprietary business logic and sensitive configurations have been removed or obfuscated to ensure security and privacy.
