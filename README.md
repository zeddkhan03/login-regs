# 💻 User Login and Register System with Referral Code

This is a simple user login and registration system implemented in PHP. It provides basic functionality to allow users to create an account, log in, and log out. It also includes a referral code feature where users can earn referral points by inviting others to join.

## ✨ Features

- 📝 **User Registration**: Users can create a new account by providing their full name, username, email, and password.
- 🔐 **User Login**: Existing users can log in using their email or username and password.
- 🔄 **Session Management**: The system manages user sessions to keep users authenticated throughout their browsing session.
- 🎁 **Referral Code**: Users can enter a referral code during registration to earn referral points.
- 📈 **Referral Points**: Each user has a referral points counter that increases when their referral code is used.
- 🌐 **Referral Link**: Users can share their referral link to invite others to join.

## ⚙️ Installation

1. Clone the repository to your local machine.
2. Set up a local web server environment (e.g., XAMPP, WAMP, or MAMP).
3. Import the database schema provided in the `database.sql` file to set up the necessary database structure.
4. Update the `connection.php` file with your database credentials.
5. Launch the application in your web browser.

## 🚀 Usage

1. Access the application in your web browser by navigating to the appropriate URL.
2. The header contains navigation links for home, blog, contact, and about pages.
3. If you are not logged in, you will see the "🔑 LOGIN" and "📝 REGISTER" buttons.
4. Clicking on the "🔑 LOGIN" button will open a popup where you can enter your credentials.
5. Clicking on the "📝 REGISTER" button will open a popup where you can create a new account.
6. During registration, users can enter a referral code if they have one.
7. After successful login, the header will display your username and a "🚪 Log Out" link.
8. Logged-in users will see a welcome message on the page.
9. The user's referral code, referral points, and referral link will be displayed on their profile page.
10. Users can share their referral link with others to earn referral points.
11. Referral points are automatically updated when someone registers using their referral link or code.
12. Clicking on the "🚪 Log Out" link will log you out and redirect you to the login page.

## 🎨 Customization

- You can modify the styling of the application by editing the `style.css` file.
- Additional functionality and pages can be added by extending the existing codebase.

## 📄 License

This project is licensed under the [MIT License](LICENSE).

## 🤝 Contributing

Contributions are welcome! If you have any improvements or new features to add, please feel free to submit a pull request.

## 🙏 Acknowledgements

- This project was created as a learning exercise and may not be suitable for production environments.
- The project structure and code organization were inspired by best practices and common web development patterns.
- Special thanks to the developers and contributors of the technologies and libraries used in this project.
