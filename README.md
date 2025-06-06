# 🍽️ Recipe Wall

**Recipe Wall** is a simple PHP + MySQL web application that allows users to register, log in, browse, add and search recipes. It also includes a subscription form and a responsive dark-themed UI built with Bootstrap 5.

🔗 **Live Demo:** [https://recipewall.42web.io](https://recipewall.42web.io)

---

## 🚀 Features

- ✅ User registration & login
- ✅ Add recipes from personal dashboard
- ✅ Browse and search recipes
- ✅ Dark theme and responsive design
- ✅ Newsletter subscription form
- ✅ Error validation and user feedback

---

## 🛠️ Tech Stack

- **PHP 7+**
- **MySQL**
- **Bootstrap 5**
- **Vanilla JavaScript**
- Hosting: [InfinityFree](https://infinityfree.net)

---

## 📁 Project Structure

```
recipe-wall/
├── index.php               # Homepage
├── login.php               # Login page
├── register.php            # Registration page
├── cabine.php              # User dashboard
├── recipes.php             # Recipe list
├── search_recipes.php      # AJAX recipe search
├── send_message.php        # Contact form
├── subscribe.php           # Email subscription
├── include/
│   └── config.php          # DB connection
├── img/                    # Images
├── static/                 # CSS and JS
├── blocks/                 # UI components
└── README.md
```

---

## ⚙️ Local Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/recipe-wall.git
   cd recipe-wall
   ```

2. Create a MySQL database `recipewall` and import the SQL dump (if available)

3. Update the database configuration in `include/config.php`:
   ```php
   $host = "localhost";
   $user = "your_db_user";
   $pass = "your_db_password";
   $dbname = "recipewall";
   ```

4. Run the project using local server (XAMPP, OpenServer, etc.)

---

## 🌐 Live Hosting

The project is deployed on a free hosting service and available here:  
🔗 [https://recipewall.42web.io](https://recipewall.42web.io)

---

## 📬 Feedback

Feel free to use the contact form on the homepage to leave feedback or suggestions.

---

## 📜 License

MIT — free to use and modify.
