# Questioner Website

This repository contains the code for a Questioner website, similar to Stack Overflow. The website is built using JavaScript and CSS for the frontend, PHP with the CodeIgniter framework for the backend, and MySQL for the database.

## Features

- User registration and authentication
- Ask questions
- Answer questions
- Upvote and downvote questions and answers
- Comment on questions and answers
- Search for questions and answers
- User profiles

## Prerequisites

To run this project locally, you will need the following:

- PHP 7.2 or higher
- MySQL 5.7 or higher
- CodeIgniter 3.1.11 or higher

## Installation

1. Clone this repository to your local machine using the following command:

   ```
   git clone https://github.com/your-username/questioner.git
   ```

2. Create a MySQL database for the project.

3. Import the database schema by executing the SQL file `database/questioner.sql` in your MySQL database.

4. Configure the database connection by editing the `application/config/database.php` file. Update the `'hostname'`, `'username'`, `'password'`, and `'database'` values to match your MySQL configuration.

5. Start a local PHP development server or configure your web server (e.g., Apache, Nginx) to serve the project files.

6. Open the website in your web browser, and you should be ready to go!

## Usage

Once the project is set up and running, you can access the website by visiting its URL in your web browser. You can then register a new account or log in with an existing account.

From there, you can ask questions, answer questions, upvote and downvote questions and answers, comment on questions and answers, and search for questions and answers using the provided features.

## Contributing

If you would like to contribute to this project, you can follow these steps:

1. Fork this repository.

2. Create a new branch with a descriptive name for your feature or bug fix.

3. Make your changes and commit them to your branch.

4. Push your branch to your forked repository.

5. Open a pull request in this repository, describing your changes and why they should be merged.

6. Wait for the maintainers to review your pull request. Feel free to address any feedback or comments given during the review process.

## License

This project is licensed under the [MIT License](LICENSE).

## Acknowledgments

- The CodeIgniter community for the excellent PHP framework.
- The open-source community for the various libraries and tools used in this project.
- Stack Overflow and similar platforms for inspiring the design and functionality of this Questioner website.
