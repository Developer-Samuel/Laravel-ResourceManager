## About Project

This project is a **User Management System** built with **Laravel**, **Vue.js**, and **Tailwind CSS**. It provides users with the ability to **log in**, **sign up**, and perform basic **CRUD** (Create, Read, Update, Delete) operations on a **Resource** using Laravel as the backend and Vue.js for the frontend.

## Features

- User authentication (Login/Sign up)
- CRUD operations for managing user resources
- Responsive UI built with Tailwind CSS
- Routing and page management handled by Inertia.js
- Seamless integration between frontend (Vue.js) and backend (Laravel) without traditional API endpoints
- SQLite as the database for easy setup and development

## Technologies Used

- **Laravel**: Backend framework for handling requests, routing, and database management.
- **Vue.js**: Frontend framework used to build the user interface and handle dynamic interactions.
- **Inertia.js**: Handles routing between pages, providing a single-page application (SPA) experience without the need for an API. It enables direct communication between Vue.js and Laravel.
- **Tailwind CSS**: A utility-first CSS framework for building custom designs without writing custom CSS.
- **SQLite**: A lightweight relational database used for easy setup and local development.

## Requirements

- PHP >= 8.x
- Composer
- Node.js (which includes NPM)
- Laravel 11.x (or higher)
- Vue.js
- Tailwind

## Project Setup

To get started, follow these steps:

**1. Create the environment file:**
   - Copy the contents of `.env.example` to a new file named `.env`.

**2. Install dependencies:**
   - Run the following commands in your terminal:
     - `composer update`
     - `php artisan key:generate`
     - `npm install`
       
**3. Run the project:**
   - Start the Laravel server by running:
     - `php artisan serve`
   - Start the development server for Vue.js by running:
     - `npm run dev`
       
**4. The project is now ready to use.**

## SQLite Database Management

Since this project uses SQLite as the database, you can easily manage and visualize your SQLite database with the following tools:

- **SQLite Viewer Extension for VS Code**: A VS Code extension that allows you to open and interact with SQLite databases directly within the editor. You can find it in the Extensions Marketplace for VS Code.
  - [SQLite Viewer Extension for VS Code](https://marketplace.visualstudio.com/items?itemName=alexcvzz.vscode-sqlite)

- **DB Browser for SQLite**: A desktop application for managing SQLite databases. It provides a user-friendly interface to open, browse, and modify SQLite database files.
  - [Download DB Browser for SQLite](https://sqlitebrowser.org/dl)

## License

This project is licensed under the **Samuel Šteiner License**.

- **Free for personal and educational use.**
- **Not allowed for commercial use or redistribution as a part of any product.**
- **May not be used as a base for proprietary projects.**

If you'd like to contribute or use it for commercial purposes, please contact the author.

---

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
