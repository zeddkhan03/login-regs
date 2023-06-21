# login-regs
User Register &amp; login system using PHP.

# User Login and Register System

This is a simple user login and registration system implemented in PHP. It provides basic functionality to allow users to create an account, log in, and log out.

## Features

- User registration: Users can create a new account by providing their full name, username, email, and password.
- User login: Existing users can log in using their email or username and password.
- Session management: The system manages user sessions to keep users authenticated throughout their browsing session.
- User interface: The interface provides a header with navigation links, a login and registration popup, and a welcome message for logged-in users.

## Installation

1. Clone the repository to your local machine.
2. Set up a local web server environment (e.g., XAMPP, WAMP, or MAMP).
3. Import the database schema provided in the `database.sql` file to set up the necessary database structure.
4. Update the `connection.php` file with your database credentials.
5. Launch the application in your web browser.

## Usage

1. Access the application in your web browser by navigating to the appropriate URL.
2. The header contains navigation links for home, blog, contact, and about pages.
3. If you are not logged in, you will see the "LOGIN" and "REGISTER" buttons.
4. Clicking on the "LOGIN" button will open a popup where you can enter your credentials.
5. Clicking on the "REGISTER" button will open a popup where you can create a new account.
6. After successful login, the header will display your username and a "Log Out" link.
7. Logged-in users will see a welcome message on the page.
8. Clicking on the "Log Out" link will log you out and redirect you to the login page.

## Customization

- You can modify the styling of the application by editing the `style.css` file.
- Additional functionality and pages can be added by extending the existing codebase.

## License

This project is licensed under the [MIT License](LICENSE).

## Contributing

Contributions are welcome! If you have any improvements or new features to add, please feel free to submit a pull request.

## Acknowledgements

- This project was created as a learning exercise and may not be suitable for production environments.
- The project structure and code organization were inspired by best practices and common web development patterns.
- Special thanks to the developers and contributors of the technologies and libraries used in this project.

