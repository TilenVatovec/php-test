# Simple PHP and React Application

## Project Description

This project demonstrates a basic web application using PHP as the backend and React as the frontend. The application creates a multi level dropdown conected to categories.
## Setup

1. Place both `my-app` and `php-test` folders in your XAMPP `htdocs` directory.
2. Set up a MySQL server with the following configuration:
   - Database name: `test-php`
   - Username: `phpT`
   - Password: `phpT`
   - Host: `localhost`

3. Start the Apache server to run the PHP backend.

4. Navigate to the `my-app` directory and run:

`npm install` 
`npm run start`


## Important Notes

- Database credentials are hardcoded in the `ApiEndpoints.php` file for simplicity. You may need to update these if your credentials differ.
- Ensure that CORS headers are properly set in your PHP files to allow cross-origin requests from your React application.


## Development Considerations

- For development purposes, you may need to configure CORS settings in your PHP files to allow requests from your local React development server.
- Consider moving database credentials to environment variables for better security in production environments.

## Running the Application

Start your XAMPP Apache server to serve the PHP backend.

Open a terminal in the `my-app` directory and run `npm start` to start the React development server.

Your application should now be accessible at `http://localhost:3000`.

---
